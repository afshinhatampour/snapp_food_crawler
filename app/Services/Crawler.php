<?php


namespace App\Services;


use Goutte\Client;

class Crawler
{
    public $crawler;

    public $result = [];

    public function __construct()
    {
        $this->crawler = new Client();
    }

    public function getCities()
    {
        $crawl = $this->crawler->request('GET',
            env('SNAPP_FOOD_BASE_URL') . 'restaurant/city/Tehran?page=0');

        $crawl->filter('a')->each(function ($node) {
            if ($node->attr('class') == '' && strpos($node->attr('href'), 'city')) {
                array_push($this->result, [
                    'name_fa' => $node->text(),
                    'link' => $node->attr('href'),
                    'name_en' => explode('/', $node->attr('href'))[3]
                ]);
            }
        });

        return $this->result;
    }

    public function getRestaurants($city, $page)
    {
        $crawl = $this->crawler->request('GET',
            env('SNAPP_FOOD_BASE_URL') . 'restaurant/city/' . $city . '?page=' . $page);

        $crawl->filter('a')->each(function($node) use ($city) {
            if($node->attr('class') == 'idn-restaurant-title'){
                array_push($this->result, [
                    'name' => $node->text(),
                    'link' => $node->attr('href'),
                    'vendor_id' => explode('/', $node->attr('href'))[3],
                    'city' => $city
                ]);
            }
        });

        return $this->result;
    }
}
