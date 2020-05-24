<?php

declare(strict_types = 1);

namespace GOG\Application\Command\Handler;

use GOG\Application\Command\UpdateProduct;
use GOG\Domain\CatalogRepository;

final class UpdateProductHandler
{
    private CatalogRepository $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function __invoke(UpdateProduct $command): void
    {
        $this->catalogRepository->get()->select($command->id())->update($command->name(), $command->price());
    }
}
