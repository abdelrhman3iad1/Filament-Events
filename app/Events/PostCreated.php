<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
class PostCreated 
{

    use Dispatchable, SerializesModels;
    
    public function __construct(
        public Post $post
    ){}

    
}
