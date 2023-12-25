<?php

namespace App\Filament\Pages;

use App\Models\Forum;
use Filament\Pages\Page;

class Forums extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.forums';

    protected static ?string $navigationGroup = 'Community';

    public Forum $forum;

    public $forums;

    public function mount()
    {
        $this->forums = Forum::isPrivate()->get();
    }

}
