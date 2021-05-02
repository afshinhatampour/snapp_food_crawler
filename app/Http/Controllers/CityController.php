<?php

namespace App\Http\Controllers;

use App\Events\CrawlCitiesEvent;
use App\Models\City;
use App\Services\Crawler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cities = City::paginate(20);

        return response()->json(['data' => [
            'count' => City::count,
            'cities' => $cities
        ]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        event(new CrawlCitiesEvent(
            (new Crawler())->getCities())
        );

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return Response
     */
    public function show(City $city)
    {
        return response()->json(['data' => $city], 200);
    }
}
