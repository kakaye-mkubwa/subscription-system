<?php

namespace App\Console\Commands;

use App\Mail\NotifySubscribersOfNewPostMail;
use App\Models\Posts;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewPostsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-for-new-posts-to-subscribers {postID : ID of the post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to new subscribers for new posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get post id
        $postID = $this->argument('postID');

        try {
            // get post
            $post = Posts::find($postID);
            if (!$post) {
                Log::error('Post not found while sending email to subscribers. ID provided: '.$postID);
                return;
            }

            // get subscribers
            $subscribers = $post->subscriptionWebsite?->users?->all();

            // send email to subscribers
            foreach ($subscribers as $subscriber) {
                // que
                // send email
                Mail::to($subscriber->email)->queue(new NotifySubscribersOfNewPostMail($post, $subscriber));
            }
        }catch (\Exception $e) {
            Log::error('Error while sending email to subscribers. Error: Referenced post: ' .$postID);
            Log::debug('Error while sending email to subscribers. Error: '.$e->getMessage());
            return;
        }
    }
}
