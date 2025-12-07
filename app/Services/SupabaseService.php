<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SupabaseService
{
    protected $client;
    protected $url;
    protected $key;

    public function __construct()
    {
        $this->url = env('SUPABASE_URL');
        $this->key = env('SUPABASE_KEY');
        
        $this->client = new Client([
            'base_uri' => $this->url . '/rest/v1/',
            'headers' => [
                'apikey' => $this->key,
                'Authorization' => 'Bearer ' . $this->key,
                'Content-Type' => 'application/json',
                'Prefer' => 'return=representation'
            ]
        ]);
    }

    public function get($table, $params = [])
    {
        try {
            $response = $this->client->get($table, [
                'query' => $params
            ]);
            
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('Supabase API Error: ' . $e->getMessage());
        }
    }

    public function post($table, $data)
    {
        try {
            $response = $this->client->post($table, [
                'json' => $data
            ]);
            
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('Supabase API Error: ' . $e->getMessage());
        }
    }

    public function put($table, $data, $params = [])
    {
        try {
            $response = $this->client->put($table, [
                'json' => $data,
                'query' => $params
            ]);
            
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('Supabase API Error: ' . $e->getMessage());
        }
    }

    public function delete($table, $params = [])
    {
        try {
            $response = $this->client->delete($table, [
                'query' => $params
            ]);
            
            return $response->getStatusCode() === 204;
        } catch (RequestException $e) {
            throw new \Exception('Supabase API Error: ' . $e->getMessage());
        }
    }
}
