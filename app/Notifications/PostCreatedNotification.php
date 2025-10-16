<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\PrivateChannel;

class PostCreatedNotification extends Notification implements ShouldBroadcast
{

    public function __construct(public Post $post){}
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function broadcastOn(): Channel
    {
        return new Channel('posts');
    }
    public function broadcastAs(): string 
    {
        return 'post-created';
    }

    public function broadcastQueue(): string
    {
        return 'notifications';
    }
 
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return (new BroadcastMessage([
            'id'=> $this->post->id,
            'title'=> $this->post->title,
            'content'=> $this->post->content,
            'author' => [
                'id'=> $this->post->user->id,
                'name'=> $this->post->user->name,
            ],
        ]))->onQueue('notifications');
    }


 

}
