<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\PostNotification;
// use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
class SendEmails  implements ShouldQueue
{
    use InteractsWithQueue,SerializesModels;

    public $queue = 'emails';

    public function __construct(){}


    public function handle(PostCreated $event): void
    {
        $post = $event->post;
         User::chunk(50, function ($users) use ($post) {
            foreach ($users as $user) {
                $user->notify(new PostNotification($post, $user,$this->queue));
            }
        });
    }
        
}
