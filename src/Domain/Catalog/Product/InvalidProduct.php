<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog\Product;

use RuntimeException;

final class InvalidProduct extends RuntimeException
{
    public static function invalidId(int $id): self
    {
        throw new self("Id $id is invalid");
    }

    public static function invalidName(string $name): self
    {
        throw new self("Name $name is invalid");
    }

    public static function invalidPrice(int $price): self
    {
        throw new self("Price $price is invalid");
    }
}
