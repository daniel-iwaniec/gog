<?php

declare(strict_types = 1);

namespace GOG\Application\Exception;

use RuntimeException;
use Throwable;

class Unchecked extends RuntimeException
{
    public static function wrap(Throwable $exception): Unchecked
    {
        if ($exception instanceof static) {
            return $exception;
        }

        return new static($exception->getMessage(), $exception->getCode(), $exception);
    }

    final protected function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
