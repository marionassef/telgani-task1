<?php

namespace App\External\Foo\Exceptions;

use Exception;

class AuthenticationFailedException extends Exception
{
    protected $message = "Authentication failed";
}
