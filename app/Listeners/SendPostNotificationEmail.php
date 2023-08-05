<?php

namespace App\Listeners;

use App\Events\PostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class SendPostNotificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostAdded $event): void
    {
        // execute the send email to notify subscribers command
        $postID = $event->postID;
        Artisan::call('app:send-email-for-new-posts-to-subscribers', [
            'postID' => $postID,
        ]);
    }
}
