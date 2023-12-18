<?php

namespace App\Filament\Pages\Tenancy\Team;

use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Str;

class RegisterPage extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Team';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->afterStateUpdated(function (callable $get, callable $set, ?string $state) {
                        if (!$get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->reactive(),
                TextInput::make('slug')
                    ->label('Short name')
                    ->afterStateUpdated(function (callable $set) {
                        $set('is_slug_changed_manually', true);
                    })
                    ->required()
                    ->unique(),
                Forms\Components\Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);

        $team->members()->attach(auth()->user());

        return $team;
    }
}
