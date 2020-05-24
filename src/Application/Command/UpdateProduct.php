<?php

declare(strict_types = 1);

namespace GOG\Application\Command;

use GOG\Application\Exception\Command\EmptyUpdate;
use GOG\Domain\Catalog\Product\Id;
use GOG\Domain\Catalog\Product\InvalidProduct;
use GOG\Domain\Catalog\Product\Name;
use GOG\Domain\Catalog\Product\Price;

final class UpdateProduct
{
    private Id $id;

    private ?Name $name = null;

    private ?Price $price = null;

    public function __construct(int $id, string $name, int $price)
    {
        $this->id = new Id($id);

        try {
            $this->name = new Name($name);
        } catch (InvalidProduct $exception) {
            $this->name = null;
        }

        try {
            $this->price = new Price($price);
        } catch (InvalidProduct $exception) {
            $this->price = null;
        }

        if (!$this->name && !$this->price) {
            throw EmptyUpdate::self();
        }
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): ?Name
    {
        return $this->name;
    }

    public function price(): ?Price
    {
        return $this->price;
    }
}
