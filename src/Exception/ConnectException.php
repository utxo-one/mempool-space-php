<?php

declare(strict_types=1);

namespace MempoolSpace\Exception;

class ConnectException extends MempoolSpaceException
{
    public function __construct(string $curlErrorMessage, int $curlErrorCode)
    {
        parent::__construct($curlErrorMessage, $curlErrorCode);
    }
}
