<?php

namespace App\Models;

use App\AppUtils\DefaultAppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationRequests extends DefaultAppModel
{
    protected $fillable = [
        'user_id',
        'subscription_website_id',
        'request_date',
        'approval_date',
        'reason',
        'approval_status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    // user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // subscription
    public function subscriptionWebsite()
    {
        return $this->belongsTo(SubscriptionWebsites::class, 'subscription_website_id');
    }
}
