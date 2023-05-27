<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarMoviesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param array $request
     * @return array
     */
    public function toArray($request): array
    {
        $array = [];
        foreach ($request['titles'] as $titles) {
            foreach ($titles as $title) {
                $array[] = $title;
            }
        }
        return $array;
    }
}
