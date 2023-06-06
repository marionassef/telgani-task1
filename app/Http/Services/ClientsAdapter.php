<?php

namespace App\Http\Services;

use App\External\Bar\Auth\LoginService;
use App\External\Baz\Auth\Authenticator;
use App\External\Baz\Auth\Responses\IResponse;
use App\External\Foo\Auth\AuthWS;
use App\External\Foo\Exceptions\AuthenticationFailedException;

class ClientsAdapter
{
    /**
     * @param object $client
     * @param string $login
     * @param string $password
     * @return IResponse
     * @throws AuthenticationFailedException
     * @throws \ErrorException
     */
    public function processClient(object $client, string $login, string $password): IResponse|bool
    {
        // Adapt the response based on the specific third-party response
        if ($client instanceof LoginService) {
            return $client->login($login, $password);
        } elseif ($client instanceof Authenticator) {
            return $client->auth($login, $password);
        } elseif ($client instanceof AuthWS) {
            $client->authenticate($login, $password);
            return true;
        }
        throw new \ErrorException('Invalid Client');
    }
}



