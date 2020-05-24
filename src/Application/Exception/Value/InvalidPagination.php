<?php

declare(strict_types = 1);

namespace GOG\Application\Exception\Value;

use GOG\Application\Exception\Unchecked;

final class InvalidPagination extends Unchecked
{
    public static function invalidPage(int $page): self
    {
        throw new self("Page $page is invalid");
    }

    public static function invalidLimit(int $limit): self
    {
        throw new self("Limit $limit is invalid");
    }

    public static function invalidOffset(int $offset): self
    {
        throw new self("Offset $offset is invalid");
    }
}
