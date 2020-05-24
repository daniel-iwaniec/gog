<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog;

use GOG\Domain\Catalog\Product\Id;
use GOG\Domain\Catalog\Product\Name;
use GOG\Domain\Catalog\Product\Price;

final class Product
{
    private Id $id;

    private Name $name;

    private Price $price;

    public function __construct(Name $name, Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function update(?Name $name, ?Price $price): void
    {
        if ($name) {
            $this->name = $name;
        }

        if ($price) {
            $this->price = $price;
        }
    }
}
