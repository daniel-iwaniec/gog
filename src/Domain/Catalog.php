<?php

declare(strict_types = 1);

namespace GOG\Domain;

use GOG\Domain\Catalog\Product;
use GOG\Domain\Catalog\Product\Id;
use GOG\Domain\Catalog\ProductCollection;

final class Catalog
{
    private ProductCollection $products;

    public function add(Product $product): void
    {
        $this->products->add($product);
    }

    public function remove(Id $id): void
    {
        $this->products->remove($id);
    }

    public function select(Id $id): Product
    {
        return $this->products->get($id);
    }
}
