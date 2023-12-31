<?php

namespace app\core\exception;

class TimeOutException extends \Exception
{
    protected $message = 'Timeout Request. Please login to access it';
    protected $code = 402;
}