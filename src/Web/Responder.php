<?php

declare(strict_types = 1);

namespace GOG\Web;

use Symfony\Component\HttpFoundation\Response;
use Throwable;

interface Responder
{
    public function respond(object $catalog): Response;

    public function respondToException(Throwable $exception): Response;
}
