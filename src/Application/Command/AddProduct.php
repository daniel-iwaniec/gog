<?php

declare(strict_types = 1);

namespace GOG\Application\Command;

use GOG\Domain\Catalog\Product\Name;
use GOG\Domain\Catalog\Product\Price;

final class AddProduct
{
    private Name $name;

    private Price $price;

    public function __construct(string $name, int $price)
    {
        $this->name = new Name($name);
        $this->price = new Price($price);
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function price(): Price
    {
        return $this->price;
    }
}
