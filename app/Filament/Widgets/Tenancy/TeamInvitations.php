<?php

namespace App\Filament\Widgets\Tenancy;

use App\Models\Invitation;
use App\Models\TeamUser;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

class TeamInvitations extends BaseWidget
{
    protected static bool $isDiscovered = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invitation::query()->whereIn('team_id', TeamUser::where('team_id', Filament::getTenant()->id)->pluck('team_id'))
                ->where('completed', false)
            )
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles')
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Invite User')
                    ->form([
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
                            Forms\Components\Select::make('roles')
                                ->required()
                                ->options(function (){
                                    $ops = [];
                                    foreach(TeamUser::ROLES as $role)
                                    {
                                        $ops[$role] = ucwords($role);
                                    }
                                    return $ops;
                                })
                        ])->columns(3)
                    ])
                    ->action(function ($data) {
                        $invite = new Invitation();
                        $invite->fill($data);
                        $invite->team_id = Filament::getTenant()->id;
                        $invite->save();

                        Notification::make()
                            ->success()
                            ->title('Invitation sent')
                            ->send();
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('Delete')
                    ->requiresConfirmation()
                    ->action(function (Model $record) {
                        $record->forceDelete();

                        Notification::make()
                            ->success()
                            ->title('Invitation deleted')
                            ->send();
                    }),
            ]);
    }
}
