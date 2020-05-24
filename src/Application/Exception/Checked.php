<?php

declare(strict_types = 1);

namespace GOG\Application\Exception;

use LogicException;
use Throwable;

class Checked extends LogicException
{
    public static function wrap(Throwable $exception): Checked
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
