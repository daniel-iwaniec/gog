<?php

declare(strict_types = 1);

namespace GOG\Application\Exception\Command;

use GOG\Application\Exception\Unchecked;

class EmptyUpdate extends Unchecked
{
    public static function self(): self
    {
        throw new self('Product should be updated with either name or price');
    }
}
