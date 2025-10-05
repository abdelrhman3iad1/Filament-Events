<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\NewPostNotification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\SendPostNotificationEmail;
use Illuminate\Bus\Batch;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log ;
use Throwable;

class SendEmails  implements ShouldQueue
{
    use InteractsWithQueue,Queueable,SerializesModels;


    public function queue(){
        return 'emails';
    }

    public function __construct()
    {}


    public function handle(PostCreated $event): void
    {
        $post = $event->post;

        $users = User::all();
        
        foreach($users as $user){
            $user->notify(new PostNotification($post,$user));
        }
        
    }
        
}
