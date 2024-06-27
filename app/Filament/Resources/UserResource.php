<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    // The Eloquent model that this resource represents
    protected static ?string $model = User::class;

    // The attribute used as the title for each record
    protected static ?string $recordTitleAttribute = 'name';

    // The sort order for this resource in the navigation menu
    protected static ?int $navigationSort = 1;

    // The icon used for this resource in the navigation menu
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    // Defines the form schema for creating and editing records
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Text input for the user's name
                TextInput::make('name')
                    ->required(),

                // Text input for the user's email address
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),

                // DateTime picker for the email verified at field
                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->default(now()),

                // Text input for the user's password
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    //the password is required when creating a new record but when editing since it's not CreateRecord it returns false and so that you can leave it black
                    ->required(fn(Page $livewire) : bool => $livewire instanceof CreateRecord),
            ]);
    }

    // Defines the table schema for listing records
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Text column for the user's name
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                // Text column for the user's email
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                // Text column for the email verified at timestamp
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),

                // Text column for the created at timestamp
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Define any table filters here
            ])
            ->actions([
                // Group of actions for view, edit, and delete actions
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()->slideOver(),
                    DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                // Group of bulk actions for deleting multiple records
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Defines the relations for the resource
    public static function getRelations(): array
    {
        return [
            RelationManagers\OrdersRelationManager::class,
        ];
    }

    // Defines the attributes that can be globally searched
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    // Defines the pages for the resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
