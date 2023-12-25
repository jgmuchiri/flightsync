<?php

namespace App\Filament\Forms;

use Filament\Forms;

class UserForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\Section::make([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ])
                ->columns(4)
                ->compact()
        ];
    }
}
