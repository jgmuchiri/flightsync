<?php

namespace App\Filament\Widgets\Tenancy;

use App\Models\Invitation;
use App\Models\TeamUser;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

class TeamUsers extends BaseWidget
{
    protected static bool $isDiscovered = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()->whereIn('id', TeamUser::where('team_id', Filament::getTenant()->id)->pluck('user_id'))
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('membership.status')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => strtoupper($state))
                    ->colors([
                        'success' => TeamUser::STATUS_ACTIVE,
                        'danger'  => TeamUser::STATUS_SUSPENDED
                    ])
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
                    })
            ]);
    }
}
