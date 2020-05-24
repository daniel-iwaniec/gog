<?php

declare(strict_types = 1);

namespace GOG\Infrastructure\Doctrine\Repository;

use GOG\Application\Data\Product;
use GOG\Application\UnitOfWork;
use GOG\Domain\Catalog;
use GOG\Domain\CatalogRepository as Port;
use GOG\Infrastructure\Doctrine\Collection\ProductCollection;
use GOG\Infrastructure\Doctrine\Dao\ProductDao;
use GOG\Infrastructure\Doctrine\DaoLocator;

final class CatalogRepository implements Port
{
    private UnitOfWork $unitOfWork;

    private ProductDao $productDao;

    public function __construct(UnitOfWork $unitOfWork, DaoLocator $daoLocator)
    {
        $this->unitOfWork = $unitOfWork;
        $this->productDao = $daoLocator->get(Product::class);
    }

    public function get(): Catalog
    {
        $catalog = adm(Catalog::class)->products(new ProductCollection($this->productDao))();

        $this->unitOfWork->onFlush(
            function () use ($catalog) { $this->add($catalog); },
            function () use ($catalog) { $this->remove($catalog); },
            function () use ($catalog) { $this->update($catalog); }
        );

        return $catalog;
    }

    private function add(Catalog $catalog): void
    {
        $products = [];
        foreach (adm(adm($catalog)->products())->added() as $newProduct) {
            $product = new Product();
            $product->name = adm(adm($newProduct)->name())->name();
            $product->price = adm(adm($newProduct)->price())->price();
            $products[] = $product;
        }

        $this->productDao->save(...$products);
    }

    private function remove(Catalog $catalog): void
    {
        $removed = array_map(
            fn ($id) => adm($id)->id(),
            adm(adm($catalog)->products())->removed()
        );

        $this->productDao->remove(...$removed);
    }

    private function update(Catalog $catalog): void
    {
        $products = [];
        foreach (adm(adm($catalog)->products())->managed() as $managedProduct) {
            $product = adm()->data($managedProduct);
            $product->name = adm(adm($managedProduct)->name())->name();
            $product->price = adm(adm($managedProduct)->price())->price();
            $products[] = $product;
        }

        $this->productDao->save(...$products);
    }
}
