<?php

declare(strict_types = 1);

namespace GOG\Application\Middleware;

use GOG\Application\UnitOfWork;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

final class UnitOfWorkMiddleware implements MiddlewareInterface
{
    private UnitOfWork $unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $envelope = $stack->next()->handle($envelope, $stack);

        $this->unitOfWork->flush();

        return $envelope;
    }
}
