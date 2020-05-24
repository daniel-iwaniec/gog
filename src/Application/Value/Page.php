<?php

declare(strict_types = 1);

namespace GOG\Application\Value;

use GOG\Application\Exception\Value\InvalidPagination;

final class Page
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 1) {
            throw InvalidPagination::invalidPage($value);
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function offset(Limit $limit): Offset
    {
        return new Offset(($this->value - 1) * $limit->value());
    }
}
