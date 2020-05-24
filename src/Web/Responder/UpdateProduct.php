<?php

declare(strict_types = 1);

namespace GOG\Web\Responder;

use GOG\Web\Responder;
use GOG\Web\Responder\Mixin\ExceptionResponder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UpdateProduct implements Responder
{
    use ExceptionResponder;

    public function respond(object $catalog): JsonResponse
    {
        return new JsonResponse(['success' => true, 'message' => 'Product updated']);
    }
}
