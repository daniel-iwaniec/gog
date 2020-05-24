<?php

declare(strict_types = 1);

namespace GOG\Application;

interface DaoLocator
{
    /**
     * @return mixed
     */
    public function get(string $name);
}
