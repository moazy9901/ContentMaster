<?php

namespace App\Services;

use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ProductImportService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.escuelajs.co/api/v1/',
            'verify' => false,
            'timeout'  => 10.0,
        ]);
    }

    public function fetchAndStoreProducts()
    {
        try {
            $response = $this->client->get('products');
            $products = json_decode($response->getBody(), true);
            foreach ($products as $item) {
                Product::updateOrCreate(
                    ['id' => $item['id']],
                    [
                        'title'       => $item['title'],
                        'slug'       => $item['slug'],
                        'description' => $item['description'],
                        'price'       => $item['price'],
                        'category_id'    => $item['category']['id'],
                        'images'       => $item['images'] ? json_encode($item['images']) : null,
                    ]
                );
            }

            return $products;
        } catch (RequestException $e) {
            throw new \Exception("API Request failed: " . $e->getMessage());
        }
    }
}
