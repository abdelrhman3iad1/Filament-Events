<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Mail\Mailable;
use App\Mail\NewPostNotification;
class PostNotification extends Notification implements ShouldQueue

{

    use Queueable;

    public function queue(){
        return 'emails';
    }

    /**
     * Create a new notification instance.
     */
    public function __construct(public Post $post, public User $user)
    {
        //
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
    
    public function toMail(object $notifiable): Mailable
    {
        return (new NewPostNotification($this->post))
            ->to($notifiable->email);
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
