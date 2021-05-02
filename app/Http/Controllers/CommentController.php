<?php

namespace App\Http\Controllers;

use App\Events\GetCommentsEvent;
use App\Http\Requests\GetCommentsReauest;
use App\Models\Comment;
use App\Models\Restaurant;
use App\Services\HttpClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = new HttpClient();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::paginate(20);

        return response()->json(['data' => [
            'count' => Comment::count(),
            'comments' => $comments
        ]], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param GetCommentsReauest $request
     * @return Response
     */
    public function store(GetCommentsReauest $request)
    {
        $restaurant = Restaurant::where('vendor_id', $request->get('restaurants_id'))->first();
        $data = $this->client->getComments($restaurant, 0);
        for ($i = 0; $i < ceil($data->data->count / 10); $i++) {
            event(new GetCommentsEvent($restaurant,$i));
        }

        return response()->json(['added to queue']);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        return response()->json(['data' => $comment], 200);
    }
}
