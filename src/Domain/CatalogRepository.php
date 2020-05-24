<?php

declare(strict_types = 1);

namespace GOG\Domain;

interface CatalogRepository
{
    public function get(): Catalog;
}
