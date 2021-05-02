<?php

namespace App\Http\Controllers;

use App\Events\CrawlRestaurantsEvent;
use App\Http\Requests\CrawlRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $restaurants  = Restaurant::paginate(20);

        return response()->json(['data' => [
            'count' => Restaurant::count(),
            'restaurants' => $restaurants,
        ]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CrawlRestaurantRequest $request
     * @return array
     */
    public function store(CrawlRestaurantRequest $request)
    {
        for ($i = $request->get('first_page'); $i < $request->get('last_page'); $i++) {
            event(new CrawlRestaurantsEvent(
                $request->get('city'), $i));
        }

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Restaurant $restaurant
     * @return Response
     */
    public function show(Restaurant $restaurant)
    {
        return response()->json(['data' => $restaurant], 200);
    }
}
