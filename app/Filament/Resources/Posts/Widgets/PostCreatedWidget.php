<?php

namespace App\Filament\Resources\Posts\Widgets;

use Filament\Widgets\Widget;
use Livewire\Attributes\On;
class PostCreatedWidget extends Widget
{
    protected string $view = 'filament-panels::filament.resources.posts.widgets.post-created-widget';

    #[On('post-created')]
    public function refreshPosts()
    {
        // Logic when event received
        $this->dispatch('refresh');
    }
}
