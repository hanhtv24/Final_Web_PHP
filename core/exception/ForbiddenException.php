<?php

namespace app\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page. Please login to access it';
    protected $code = 403;
}