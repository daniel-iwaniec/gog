<?php

declare(strict_types = 1);

namespace GOG\Application\Command;

use GOG\Domain\Catalog\Product\Id;

final class RemoveProduct
{
    private Id $id;

    public function __construct(int $id)
    {
        $this->id = new Id($id);
    }

    public function id(): Id
    {
        return $this->id;
    }
}
