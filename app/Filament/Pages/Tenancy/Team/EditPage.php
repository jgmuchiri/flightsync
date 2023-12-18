<?php

namespace App\Filament\Pages\Tenancy\Team;

use App\Filament\Widgets\Tenancy\TeamUsers;

use App\Models\Invitation;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditPage extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Team profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->maxLength(50),
                    Forms\Components\FileUpload::make('logo')
                        ->directory('assets')
                        ->image(),
                    Forms\Components\TextInput::make('slogan')
                        ->maxLength(100)
                ])
                    ->compact()
                    ->collapsible()
                    ->columns(3)
            ]);
    }

    protected function getFooterWidgets(): array
    {
        return [
            TeamUsers::class
        ];
    }

    public function getFooterWidgetsColumns(): int|string|array
    {
        return [
            'md' => 1
        ];
    }
}
