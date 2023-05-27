<?php

namespace App\Http\Services;

use App\External\Baz\Auth\Responses\Success;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ThirdPartyClientsAdapter
{
    /**
     * @param $response
     * @return JsonResponse
     * @throws Exception
     */
    public function processResponse($response): JsonResponse
    {
        // Adapt the response based on the specific third-party response
        if ($response === true) {
            return response()->json([
                'status' => 'success',
                'token' => $this->generateToken(),
            ]);
        } elseif ($response instanceof Success) {
            return response()->json([
                'status' => 'success',
                'token' => $this->generateToken(),
            ]);
        } elseif ($response === null) {
            return response()->json([
                'status' => 'success',
                'token' => $this->generateToken(),
            ]);
        } else {
            return response()->json([
                'status' => 'failure',
            ]);
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generateToken(): string
    {
        //TODO implement some JWT library like Passport to generate the token
        return Str::random(50);
    }
}
