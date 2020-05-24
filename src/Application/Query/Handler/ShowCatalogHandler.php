<?php

declare(strict_types = 1);

namespace GOG\Application\Query\Handler;

use GOG\Application\Dao\ProductDao;
use GOG\Application\DaoLocator;
use GOG\Application\Data;
use GOG\Application\Exception\Query\EmptyCatalogPage;
use GOG\Application\Query\Dto\Catalog;
use GOG\Application\Query\Dto\Product;
use GOG\Application\Query\ShowCatalog;

final class ShowCatalogHandler
{
    private ProductDao $productDao;

    public function __construct(DaoLocator $daoLocator)
    {
        $this->productDao = $daoLocator->get(Data\Product::class);
    }

    /**
     * @throws EmptyCatalogPage
     */
    public function __invoke(ShowCatalog $query): Catalog
    {
        $catalog = new Catalog();
        foreach ($this->productDao->getPage($query->page()) as $product) {
            $dto = new Product();
            $dto->id = (int) $product->id;
            $dto->name = $product->name;
            $dto->price = number_format($product->price / 100, 2, '.', '');

            $catalog->products->append($dto);
        }

        if ($catalog->products->count() === 0) {
            throw EmptyCatalogPage::self($query->page());
        }

        return $catalog;
    }
}
