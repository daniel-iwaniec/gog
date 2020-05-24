<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog;

use GOG\Domain\Catalog\Product\Id;

interface ProductCollection
{
    public function add(Product $product): void;

    public function remove(Id $id): void;

    public function get(Id $id): Product;
}
