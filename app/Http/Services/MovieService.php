<?php

namespace App\Http\Services;

use App\Http\Resources\BarMoviesResource;
use App\Http\Resources\BazMoviesResource;
use App\External\Foo\Movies\MovieService as FooMovieService;
use App\External\Bar\Movies\MovieService as BarMovieService;
use App\External\Baz\Movies\MovieService as BazMovieService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class MovieService
{
    /**
     * @return JsonResponse
     */
    public function getTitles(): JsonResponse
    {
        try {
            $fooMovieService = new FooMovieService();
            $fooTitles = $fooMovieService->getTitles();

            $barMovieService = new BarMovieService();
            $barTitles = $barMovieService->getTitles();
            $barMoviesResource = new BarMoviesResource($barTitles);
            $barTitles = $barMoviesResource->toArray($barTitles);

            $bazMovieService = new BazMovieService();
            $bazTitles = $bazMovieService->getTitles();
            $bazMoviesResource = new BazMoviesResource($bazTitles);
            $bazTitles = $bazMoviesResource->toArray($bazTitles);

            return response()->json(array_merge($fooTitles, $barTitles, $bazTitles));
        } catch (Exception $exception) {
            Log::debug($exception->getMessage());
            return response()->json([
                'status' => 'failure',
            ]);
        }
    }

}
