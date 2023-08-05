<?php

namespace App\Models;

use App\AppUtils\DefaultAppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends DefaultAppModel
{
    protected $fillable = [
        'user_subscription_id',
        'issue_date',
        'due_date',
        'amount',
        'payment_status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    // user
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            UserSubscription::class,
            'id',
            'id',
            'user_subscription_id',
            'user_id'
        );
    }

    // subscription
    public function subscriptionWebsite()
    {
        return $this->hasOneThrough(
            SubscriptionWebsites::class,
            UserSubscription::class,
            'id',
            'id',
            'user_subscription_id',
            'subscription_website_id'
        );
    }
}
