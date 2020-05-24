<?php

declare(strict_types = 1);

namespace GOG\Application\Exception\Dao;

use GOG\Application\Exception\Unchecked;

class CouldNotCreateReference extends Unchecked
{
    public static function self(string $data, int $id): self
    {
        throw new self("Could not create $data reference for id $id");
    }
}
