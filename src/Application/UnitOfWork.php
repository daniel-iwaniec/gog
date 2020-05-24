<?php

declare(strict_types = 1);

namespace GOG\Application;

use Closure;

final class UnitOfWork
{
    /** @var array<int, Closure> */
    private array $closures = [];

    public function onFlush(Closure ...$closures): void
    {
        $this->closures = array_merge($this->closures, $closures);
    }

    public function flush(): void
    {
        foreach ($this->closures as $closure) {
            $closure();
        }
    }
}
