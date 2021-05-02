<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'foods',
        'createdDate',
        'sender',
        'customerId',
        'commentText',
        'rate',
        'feeling',
        'status',
        'expeditionType',
        'replies',
        'commentId',
        'restaurant_vendor_id',
        'restaurant_city'
    ];
}
