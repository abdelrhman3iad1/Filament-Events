<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\PostCreatedEmail;
class SendPostEmails  implements ShouldQueue
{

    use SerializesModels;

    public $queue = "emails";

    public function __construct(){}
    
    public function handle(PostCreated $event): void
    {
        $post = $event->post;
         User::chunk(50, function ($users) use ($post) {
            foreach ($users as $user) {
                $user->notify(new PostCreatedEmail($post, $user)); 
            }
        });
    }
        
}
