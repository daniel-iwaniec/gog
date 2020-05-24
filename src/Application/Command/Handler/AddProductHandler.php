<?php

declare(strict_types = 1);

namespace GOG\Application\Command\Handler;

use GOG\Application\Command\AddProduct;
use GOG\Domain\Catalog\Product;
use GOG\Domain\CatalogRepository;

final class AddProductHandler
{
    private CatalogRepository $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function __invoke(AddProduct $command): void
    {
        $this->catalogRepository->get()->add(new Product($command->name(), $command->price()));
    }
}
