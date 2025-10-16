<?php

namespace App\Filament\Dashboard\Resources\Posts\Pages;

use App\Filament\Dashboard\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Dashboard\Resources\Posts\Widgets\PostCreatedNotificationWidget;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getFooter(): \Illuminate\Contracts\View\View|null{
        return view("filament.dashboard.resources.posts.scripts.list-notification-script");
    }
}
