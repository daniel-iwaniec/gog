<?php

declare(strict_types = 1);

namespace GOG\Web\Action;

use GOG\Application\Command;
use GOG\Application\CommandBus;

final class RemoveProduct
{
    public function __invoke(int $id, CommandBus $commandBus): void
    {
        $commandBus->execute(new Command\RemoveProduct($id));
    }
}
