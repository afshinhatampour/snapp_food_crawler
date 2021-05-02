<?php

namespace App\Listeners;

use App\Models\Comment;
use App\Services\HttpClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GetCommentsListener implements ShouldQueue
{
    public $client;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new HttpClient();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $this->client->getComments($event->restaurant,$event->pageNumber);
        //dd($event->restaurant->vendor_id);
        foreach ($data->data->comments as $comment) {
            isset($comment->createdDate)  ? $newComment['createdDate'] = $comment->createdDate : $newComment['createdDate'] = now();
            isset($comment->sender) ? $newComment['sender'] = $comment->sender : $newComment['sender'] = '';
            isset($comment->customerId)  ? $newComment['customerId'] = $comment->customerId : $newComment['customerId'] = '';
            isset($comment->commentText)  ? $newComment['commentText'] = $comment->commentText : $newComment['commentText'] = '';
            isset($comment->rate)  ? $newComment['rate'] = $comment->rate : $newComment['rate'] = 0;
            isset($comment->feeling)  ? $newComment['feeling'] = $comment->feeling : $newComment['feeling'] = '';
            isset($comment->status)  ? $newComment['status'] = $comment->status : $newComment['status'] = 0;
            isset($comment->commentId)  ? $newComment['commentId'] = $comment->commentId : $newComment['commentId'] = '';
            isset($comment->expeditionType) ? $newComment['expeditionType'] = $comment->expeditionType : 'unset';
            isset($comment->foods) ? $newComment['foods'] = json_encode($comment->foods) : $newComment['foods'] = '';
            isset($comment->replies) ? $newComment['replies'] = json_encode($comment->replies) : $newComment['replies'] = '';
            $newComment['restaurant_vendor_id'] = $event->restaurant->vendor_id;
            $newComment['restaurant_city'] = $event->restaurant->city;

            Comment::firstOrCreate($newComment);
        }
    }
}
