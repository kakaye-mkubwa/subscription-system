<?php

namespace App\Models;

use App\AppUtils\DefaultAppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends DefaultAppModel
{
    protected $fillable = [
        'title',
        'description',
        'post_date',
        'author',
        'url',
        'subscription_website_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    // subscription
    public function subscriptionWebsite()
    {
        return $this->belongsTo(SubscriptionWebsites::class, 'subscription_website_id');
    }
}
