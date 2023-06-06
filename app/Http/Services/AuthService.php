<?php

namespace App\Http\Services;


use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @throws ErrorException
     * @throws Exception
     */
    public function login(array $requestData): JsonResponse
    {
        $client = AuthClientFactory::create($requestData['login']);
        try {
            $thirdPartyClientAdapter = new ClientsAdapter();
            $authClient = $thirdPartyClientAdapter->processClient($client, $requestData['login'], $requestData['password']);
        } catch (Exception $exception) {
            Log::debug($exception);
            return response()->json([
                'status' => 'failure',
            ], 401);
        }
        $thirdPartyAdapterResponse = new ThirdPartyClientsAdapter();
        $clientResponse = $thirdPartyAdapterResponse->processResponse($authClient);
        return $this->validateClientResponse($clientResponse);
    }

    /**
     * @return string
     */
    private function generateToken(): string
    {
        return Str::random(40);
    }

    /**
     * @param $clientResponse
     * @return JsonResponse
     */
    private function validateClientResponse($clientResponse): JsonResponse
    {
        if ($clientResponse) {
            return response()->json([
                'status' => 'success',
                'token' => $this->generateToken(),
            ]);
        }
        return response()->json([
            'status' => 'failure',
        ], 401);
    }
}
