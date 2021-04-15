<?php

namespace DishCheng\Ssbooking\Exceptions;

use Exception;
use Throwable;

class SSBookingException extends Exception
{
    const ERROR_TITLE='【SSB BOOK ERROR】';

    public function __construct($message="", $code=0, Throwable $previous=null)
    {
        parent::__construct(self::ERROR_TITLE.$message, $code, $previous);
    }
}
