<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog\Product;

final class Price
{
    private int $price;

    public function __construct(int $price)
    {
        if ($price <= 0) {
            InvalidProduct::invalidPrice($price);
        }

        $this->price = $price;
    }
}
