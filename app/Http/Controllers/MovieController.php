<?php

namespace App\Http\Controllers;

use App\Http\Services\MovieService;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @return JsonResponse
     */
    public function getTitles(): JsonResponse
    {
        return $this->movieService->getTitles();
    }
}
