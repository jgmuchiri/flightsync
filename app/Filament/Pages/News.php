<?php

namespace App\Filament\Pages;

use App\Models\NewsPost;
use Filament\Pages\Page;

class News extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.news';

    protected static ?string $navigationGroup = 'Community';

    protected function getViewData(): array
    {
        return [
            'posts'=>NewsPost::paginate(20)
        ];
    }
}
