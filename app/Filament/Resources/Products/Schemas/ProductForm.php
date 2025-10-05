<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;

use Filament\Schemas\Schema;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
               use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

Fieldset::make('Label')
    ->columns([
        'default' => 1,
        'md' => 2,
        'xl' => 2,
    ])
    ->schema([
        TextInput::make('name'),
        TextInput::make('name'),
        TextInput::make('name'),

        TextInput::make('name'),
        TextInput::make('name'),
        TextInput::make('name'),

    ])
            ]);
    }
}
