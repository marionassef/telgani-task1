<?php

namespace App\Http\Services;

use App\External\Bar\Auth\LoginService;
use App\External\Baz\Auth\Authenticator;
use App\External\Foo\Auth\AuthWS;
use Illuminate\Support\Facades\Log;

class AuthClientFactory
{
    /**
     * @throws \ErrorException|\External\Foo\Exceptions\AuthenticationFailedException
     */
    public static function create(string $login, string $password)
    {
        if (preg_match("/^BAR_.*/", $login, $matches)) {
            $authClient = new LoginService();
            return $authClient->login($login, $password);
        } elseif (preg_match("/^BAZ_.*/", $login, $matches)) {
            $authClient = new Authenticator();
            return $authClient->auth($login, $password);
        } elseif (preg_match("/^FOO_.*/", $login, $matches)) {
            try{
                $authClient = new AuthWS();
                return $authClient->authenticate($login, $password);
            }catch (\Exception $exception){
                Log::debug('Third party error:' .$exception->getMessage());
                return false;
            }
        } else {
            throw new \ErrorException('Invalid Client.');
        }
    }
}

