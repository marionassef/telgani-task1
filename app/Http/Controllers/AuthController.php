<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;
use ErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws ErrorException
     */
    public
    function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->login($request->validated());
    }
}
