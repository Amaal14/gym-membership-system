<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

// Small helper to call the other microservices.
// $service is training, attendance or payments (urls are in config/services.php)
class Api
{
    // returns the data as an array, or null if the service is not working
    public static function get($service, $url, $params = [])
    {
        try {
            $response = self::request()->get(self::url($service, $url), $params);

            return $response->successful() ? $response->json() : null;
        } catch (ConnectionException $e) {
            return null;
        }
    }

    // returns the full response (so we can read validation errors), or null if the service is down
    public static function post($service, $url, $data = [])
    {
        try {
            return self::request()->post(self::url($service, $url), $data);
        } catch (ConnectionException $e) {
            return null;
        }
    }

    public static function put($service, $url, $data = [])
    {
        try {
            return self::request()->put(self::url($service, $url), $data);
        } catch (ConnectionException $e) {
            return null;
        }
    }

    private static function request()
    {
        return Http::withHeaders(['X-Service-Key' => config('services.key')])
            ->acceptJson()
            ->timeout(5);
    }

    private static function url($service, $url)
    {
        return config("services.$service.url").'/api/'.$url;
    }
}
