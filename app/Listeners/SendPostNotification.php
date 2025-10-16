<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\PostCreatedNotification;


class SendPostNotification implements ShouldQueue
{

    public $queue = "notifications";

    public function __construct(){}

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $post = $event->post;


        $post->notify(
            (new PostCreatedNotification($post))
        );
    }
      
}
