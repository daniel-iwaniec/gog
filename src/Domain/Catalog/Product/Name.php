<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog\Product;

final class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if ($name === '') {
            throw InvalidProduct::invalidName($name);
        }

        $this->name = $name;
    }
}
