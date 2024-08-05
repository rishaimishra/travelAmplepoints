<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ImageHelper
{
    public static function isValidImageUrl($url)
    {
        try {
            $response = Http::head($url);

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
