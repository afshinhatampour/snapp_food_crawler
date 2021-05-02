<?php


namespace App\Services;


use GuzzleHttp\Client;

class HttpClient
{
    public $HttpClient;

    public function __construct()
    {
        $this->HttpClient = new Client();
    }

    public function getComments($restaurant, $pageNumber)
    {
        $data = $this->HttpClient
            ->get('https://snappfood.ir/restaurant/comment/vendor/' . $restaurant->vendor_id . '/' . $pageNumber);

        return json_decode($data->getBody());
    }
}
