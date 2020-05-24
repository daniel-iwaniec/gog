<?php

declare(strict_types = 1);

namespace GOG\Application\Exception\Query;

use GOG\Application\Exception\Checked;
use GOG\Application\Exception\Displayable;
use GOG\Application\Value\Page;

class EmptyCatalogPage extends Checked implements Displayable
{
    public static function self(Page $page): self
    {
        throw new self("Page {$page->value()} is empty");
    }
}
