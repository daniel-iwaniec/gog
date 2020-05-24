<?php

declare(strict_types = 1);

namespace GOG\Web\Action;

use GOG\Application\Command;
use GOG\Application\CommandBus;
use Symfony\Component\HttpFoundation\Request;

final class UpdateProduct
{
    public function __invoke(int $id, ?string $name, Request $request, CommandBus $commandBus): void
    {
        $commandBus->execute(
            new Command\UpdateProduct($id, (string) $request->get('name'), (int) $request->get('price'))
        );
    }
}
