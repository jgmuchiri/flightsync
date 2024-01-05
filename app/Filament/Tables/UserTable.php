<?php

namespace App\Filament\Tables;

use Illuminate\Database\Eloquent\Model;
use Filament\Tables;

class UserTable
{
    public static function schema(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('email_verified_at')
                ->badge(fn(Model $record) => !is_null($record->email_verified_at))
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function actions(): array
    {
        return [
            Tables\Actions\Action::make('Delete')->color('danger')
        ];
    }
}
