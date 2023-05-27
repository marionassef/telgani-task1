<?php

namespace App\Http\Services;


use ErrorException;
use Exception;
use External\Foo\Exceptions\AuthenticationFailedException;
use Illuminate\Http\JsonResponse;

class AuthService
{
    /**
     * @throws AuthenticationFailedException
     * @throws ErrorException
     * @throws Exception
     */
    public function login($requestData): JsonResponse
    {
        $authClient = AuthClientFactory::create($requestData['login'], $requestData['password']);
        $thirdPartyAdapterResponse = new ThirdPartyAdapter();
        return $thirdPartyAdapterResponse->processResponse($authClient);
    }
}
