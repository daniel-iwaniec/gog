<?php

declare(strict_types = 1);

namespace GOG\Application\Command\Handler;

use GOG\Application\Command\RemoveProduct;
use GOG\Domain\CatalogRepository;

final class RemoveProductHandler
{
    private CatalogRepository $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function __invoke(RemoveProduct $command): void
    {
        $this->catalogRepository->get()->remove($command->id());
    }
}
