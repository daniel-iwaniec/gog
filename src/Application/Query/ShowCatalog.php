<?php

declare(strict_types = 1);

namespace GOG\Application\Query;

use GOG\Application\Value\Page;

final class ShowCatalog
{
    private Page $page;

    public function __construct(int $page)
    {
        $this->page = new Page($page);
    }

    public function page(): Page
    {
        return $this->page;
    }
}
