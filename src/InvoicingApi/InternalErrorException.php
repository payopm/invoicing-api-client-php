<?php

namespace Payopm\InvoicingApi;

use Exception;

class InternalErrorException extends \LogicException
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}