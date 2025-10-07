<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Events\PostCreated;
use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\Posts\Widgets\PostCreatedWidget;
class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;

    }
    protected function afterCreate(){
        event(new PostCreated($this->record));
    }

    protected function getFooterWidgets(): array
    {
        return [
            PostCreatedWidget::class,
        ];
    }
}
