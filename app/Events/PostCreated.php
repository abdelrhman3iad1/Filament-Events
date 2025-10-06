<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    // public string $queue = 'emails';


    public function __construct(
        public Post $post
    ){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('post');
    }
    public function broadcastAs(): string {
        return 'post.created';
    }

    public function broadcastWith(): array {
        return [
            'id'=> $this->post->id,
            'title'=> $this->post->title,
            'content'=> $this->post->content,
            'author' => [
                'id'=> $this->post->user->id,
                'name'=> $this->post->user->name,
            ]
        ];
    }
}
