<?php

declare(strict_types = 1);

namespace GOG\Application\Dao;

use ArrayObject;
use GOG\Application\Data\Product;
use GOG\Application\Value\Page;

interface ProductDao
{
    public const LIMIT = 3;

    public function getById(int $id): Product;

    /**
     * @return ArrayObject<int, Product>
     */
    public function getPage(Page $page): ArrayObject;

    public function save(Product ...$products): void;
}
