<?php

namespace App\Http\Services;

use App\External\Baz\Auth\Responses\Success;

class ThirdPartyClientsAdapter
{
    /**
     * @param $clientResponse
     * @return bool
     */
    public function processResponse($clientResponse): bool
    {
        // Adapt the response based on the specific third-party response
        if ($clientResponse instanceof Success) {
            return true;
        }
        if ($clientResponse === true) {
            return true;
        }
        return false;
    }
}
