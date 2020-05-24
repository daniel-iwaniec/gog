<?php

declare(strict_types = 1);

namespace GOG\Web\Action;

use GOG\Application\Command;
use GOG\Application\CommandBus;
use Symfony\Component\HttpFoundation\Request;

final class AddProduct
{
    public function __invoke(Request $request, CommandBus $commandBus): void
    {
        $commandBus->execute(new Command\AddProduct((string) $request->get('name'), (int) $request->get('price')));
    }
}
