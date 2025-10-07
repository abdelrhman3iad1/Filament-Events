<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;

class PostCreatedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post, public User $user )
    {
        $this->onQueue('emails'); 
    }
    

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        sleep(5);
          Log::driver('email-queue')->info('Queueing PostNotification', [
            'pid' => getmypid(),
            'user' => $this->user->id,
        ]);
          return (new MailMessage)
            ->subject("New Post: {$this->post->title}")
            ->view("emails.new-post",[
                "post"=>$this->post,
                "user"=> $this->user,
            ]);
    }
}
