<?php

declare(strict_types = 1);

namespace GOG\Web\Responder\Common;

use GOG\Web\CommonResponder;
use GOG\Web\Responder\Mixin\ExceptionResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JsonResponder implements CommonResponder
{
    use ExceptionResponder;

    public function matches(Request $request): bool
    {
        return $request->isXmlHttpRequest();
    }

    public function respond(object $data): JsonResponse
    {
        return new JsonResponse($data);
    }
}
