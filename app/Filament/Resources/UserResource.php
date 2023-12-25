<?php

namespace App\Filament\Resources;

use App\Filament\Forms\UserForm;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Tables\UserTable;
use App\Models\TeamUser;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class   UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Advanced';

    public static function getEloquentQuery(): Builder
    {
        $users =  TeamUser::where('team_id', Filament::getTenant()->id)->pluck('user_id');
        return User::query()->whereIn('id', $users);
    }

    public static function form(Form $form): Form
    {
        return $form->schema(UserForm::schema());
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(User::ROLE_ADMIN);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(UserTable::schema())
            ->filters([
                //
            ])
            ->actions(UserTable::actions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
