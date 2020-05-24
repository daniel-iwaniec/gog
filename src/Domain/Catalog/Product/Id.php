<?php

declare(strict_types = 1);

namespace GOG\Domain\Catalog\Product;

final class Id
{
    private int $id;

    public function __construct(int $id)
    {
        if ($id < 1) {
            throw InvalidProduct::invalidId($id);
        }

        $this->id = $id;
    }
}
