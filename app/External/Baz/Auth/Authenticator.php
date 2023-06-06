<?php

namespace App\External\Baz\Auth;

use App\External\Baz\Auth\Responses\Failure;
use App\External\Baz\Auth\Responses\Success;
use App\External\Baz\Auth\Responses\IResponse;

class Authenticator
{
    /**
     * On success returns Success otherwise Failure.
     */
    public function auth(string $login, string $password): IResponse
    {
        if (
            preg_match("/^BAZ_.*/", $login, $matches) &&
            $password === "foo-bar-baz"
        ) {
            return new Success();
        }

        return new Failure();
    }
}
