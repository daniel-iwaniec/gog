<?php

declare(strict_types = 1);

namespace GOG\Web\Responder\Mixin;

use GOG\Application\Exception\Displayable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

trait ExceptionResponder
{
    public function respondToException(Throwable $exception): Response
    {
        $message = 'Error occurred';
        if ($exception instanceof Displayable) {
            $message = $exception->getMessage();
        }

        return new JsonResponse(['success' => false, 'message' => $message]);
    }
}
