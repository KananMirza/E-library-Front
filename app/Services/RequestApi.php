<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class RequestApi
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL');
    }

    public function get($endpoint, $queryParams = []){
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . session()->get('access_token'),'Content-Type' => 'application/json'])
            ->get($this->baseUrl . $endpoint, $queryParams);
        return $response->json();
    }
    public function post($endpoint, $data = [],$header){
        if($header){
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . session()->get('access_token'),'Content-Type' => 'application/json'])
                ->post($this->baseUrl . $endpoint, $data);
        }else{
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($this->baseUrl . $endpoint, $data);
        }
        return $response->json();
    }
    public function delete($endpoint,$data = []){
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . session()->get('access_token'),'Content-Type' => 'application/json'])
            ->delete($this->baseUrl . $endpoint, $data);
        return $response->json();
    }

}
