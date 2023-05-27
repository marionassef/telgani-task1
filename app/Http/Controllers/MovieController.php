<?php

namespace App\Http\Controllers;

use App\Http\Services\MovieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    public function getTitles(Request $request): JsonResponse
    {
        // TODO
        return $this->movieService->getTitles();
        return response()->json([]);
    }
}
