<?php

declare(strict_types = 1);

namespace GOG\Web;

use Symfony\Component\HttpFoundation\Request;

interface CommonResponder extends Responder
{
    public function matches(Request $request): bool;
}
