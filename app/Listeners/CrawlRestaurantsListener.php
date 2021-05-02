<?php

namespace App\Listeners;

use App\Models\Restaurant;
use App\Services\Crawler;
use Illuminate\Contracts\Queue\ShouldQueue;

class CrawlRestaurantsListener implements ShouldQueue
{
    public $crawler;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->crawler = new Crawler();
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $restaurants = $this->getRestaurants($event->city, $event->page);

        foreach ($restaurants as $restaurant) {
            $this->createNewRestaurant($restaurant);
        }
    }

    /**
     * @param $city
     * @param $page
     * @return array
     */
    public function getRestaurants($city, $page)
    {
        return $this->crawler->getRestaurants($city, $page);
    }

    /**
     * @param $restaurant
     */
    public function createNewRestaurant($restaurant)
    {
        Restaurant::firstOrCreate($restaurant);
    }
}
