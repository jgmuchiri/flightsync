<?php

namespace App\Filament\Tables;

use App\Models\TeamUser;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
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
            Tables\Columns\TextColumn::make('membership.roles')
                ->badge()
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('membership.status')
                ->sortable()
                ->badge()
                ->formatStateUsing(fn(string $state) => strtoupper($state))
                ->colors([
                    'success' => TeamUser::STATUS_ACTIVE,
                    'danger'  => TeamUser::STATUS_SUSPENDED
                ])
                ->searchable(),
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
            Tables\Actions\Action::make('Suspend')
                ->hidden(fn(Model $record) => $record->membership->status == TeamUser::STATUS_SUSPENDED)
                ->requiresConfirmation()
                ->action(function (Model $record) {
                    TeamUser::where('user_id', $record->id)
                        ->where('team_id', Filament::getTenant()->id)
                        ->update([
                            'status' => TeamUser::STATUS_SUSPENDED
                        ]);

                    Notification::make()
                        ->success()
                        ->title('User suspended')
                        ->send();
                }),

            Tables\Actions\Action::make('Activate')
                ->hidden(fn(Model $record) => $record->membership->status == TeamUser::STATUS_ACTIVE)
                ->requiresConfirmation()
                ->action(function (Model $record) {
                    TeamUser::where('user_id', $record->id)
                        ->where('team_id', Filament::getTenant()->id)
                        ->update([
                            'status' => TeamUser::STATUS_ACTIVE
                        ]);

                    Notification::make()
                        ->success()
                        ->title('User activated')
                        ->send();
                }),
            Tables\Actions\Action::make('Delete')
                ->color('danger')
                ->action(function(Model $record) {
                    TeamUser::where('user_id', $record->id)
                        ->where('team_id', Filament::getTenant()->id)
                        ->delete();

                    Notification::make()
                        ->success()
                        ->title('User deleted')
                        ->send();
                    //todo send notification
                })
        ];
    }
}
