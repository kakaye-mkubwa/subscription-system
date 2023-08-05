<?php

namespace App\Models;

use App\AppUtils\DefaultAppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionWebsites extends DefaultAppModel
{
    protected $fillable = [
        'website_name',
        'website_url',
        'description',
        'price',
        'duration_in_months',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    // user
    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'subscription_website_id');
    }

    // users
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_subscriptions',
            'subscription_website_id',
            'user_id'
        );
    }
}
