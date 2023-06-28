<?php

declare(strict_types=1);

namespace MempoolSpace\Exception;

class MempoolSpaceException extends \RuntimeException
{
    public function __construct(string $message, int $code, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
