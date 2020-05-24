<?php

declare(strict_types = 1);

namespace GOG\Web\Action;

use GOG\Application\Query;
use GOG\Application\Query\Dto\Catalog;
use GOG\Application\QueryBus;
use Symfony\Component\HttpFoundation\Request;

final class ShowCatalog
{
    public function __invoke(Request $request, QueryBus $queryBus): Catalog
    {
        return $queryBus->execute(new Query\ShowCatalog((int) $request->get('page', 1)));
    }
}
