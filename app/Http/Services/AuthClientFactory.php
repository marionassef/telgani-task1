<?php

namespace App\Http\Services;

use App\External\Bar\Auth\LoginService;
use App\External\Baz\Auth\Authenticator;
use App\External\Baz\Auth\Responses\IResponse;
use App\External\Foo\Auth\AuthWS;
use Illuminate\Support\Facades\Log;

class AuthClientFactory
{
    /**
     * @throws \ErrorException
     */
    public static function create(string $login): object
    {
        if (preg_match("/^BAR_.*/", $login, $matches)) {
            return new LoginService();
        } elseif (preg_match("/^BAZ_.*/", $login, $matches)) {
            return new Authenticator();
        } elseif (preg_match("/^FOO_.*/", $login, $matches)) {
            return new AuthWS();
        } else {
            throw new \ErrorException('Invalid Client.');
        }
    }
}

