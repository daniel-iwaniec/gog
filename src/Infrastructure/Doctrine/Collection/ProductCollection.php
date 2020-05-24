<?php

declare(strict_types = 1);

namespace GOG\Infrastructure\Doctrine\Collection;

use GOG\Domain\Catalog\Product;
use GOG\Domain\Catalog\Product\Id;
use GOG\Domain\Catalog\Product\Name;
use GOG\Domain\Catalog\Product\Price;
use GOG\Domain\Catalog\ProductCollection as Port;
use GOG\Infrastructure\Doctrine\Dao\ProductDao;

final class ProductCollection implements Port
{
    private ProductDao $productDao;

    /** @var array<int, Product> */
    private array $added = [];

    /** @var array<int, Id> */
    private array $removed = [];

    /** @var array<int, Product> */
    private array $managed = [];

    public function __construct(ProductDao $productDao)
    {
        $this->productDao = $productDao;
    }

    public function add(Product $product): void
    {
        $this->added[] = $product;
    }

    public function remove(Id $id): void
    {
        $this->removed[] = $id;
    }

    public function get(Id $id): Product
    {
        $idValue = adm($id)->id();
        if (isset($this->managed[$idValue])) {
            return $this->managed[$idValue];
        }

        $data = $this->productDao->getById($idValue);
        $this->managed[$idValue] = adm(Product::class)
            ->id(adm(Id::class)->id($idValue)())
            ->name(adm(Name::class)->name($data->name)())
            ->price(adm(Price::class)->price($data->price)())($data);

        return $this->managed[$idValue];
    }
}
