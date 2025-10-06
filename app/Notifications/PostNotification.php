<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PostNotification extends Notification implements ShouldQueue

{
    use Queueable;
    // public $queue ="emails";
    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post, public User $user ,public string $queue1)
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

    /**
     * Get the mail representation of the notification.
     */
    
    
    public function toMail(object $notifiable): MailMessage
    {
        // sleep(3);
          Log::driver('email-queue')->info('Queueing PostNotification', [
            'pid' => getmypid(),
            'user' => $this->user->id,
            'queue'=> $this->queue1,
        ]);
          return (new MailMessage)
            ->subject("New Post: {$this->post->title}")
            ->line('A new post has been published.')
            ->action('View Post', url("/posts/{$this->post->id}"))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
