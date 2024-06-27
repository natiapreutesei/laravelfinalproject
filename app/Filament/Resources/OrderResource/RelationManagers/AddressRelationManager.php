<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    // Defines the relationship managed by this relation manager
    protected static string $relationship = 'address';

    // Defines the form schema for creating and editing related records
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Text input for the name field
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Text input for the phone field
                TextInput::make('phone')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                // Text input for the city field
                TextInput::make('city')
                    ->required()
                    ->maxLength(255),

                // Text input for the state field
                TextInput::make('state')
                    ->required()
                    ->maxLength(255),

                // Text input for the zip code field
                TextInput::make('zip_code')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                // Text input for the street address field
                TextInput::make('street_address')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    // Defines the table schema for listing related records
    public function table(Table $table): Table
    {
        return $table
            // Sets the title attribute for each record in the table to the street address
            ->recordTitleAttribute('street_address')
            ->columns([
                // Column for displaying the name
                TextColumn::make('name')
                    ->label('Name'),

                // Column for displaying the phone number
                TextColumn::make('phone')
                    ->label('Phone Number'),

                // Column for displaying the city
                TextColumn::make('city')
                    ->label('City'),

                // Column for displaying the state
                TextColumn::make('state')
                    ->label('State'),

                // Column for displaying the zip code
                TextColumn::make('zip_code')
                    ->label('Zip Code'),

                // Column for displaying the street address
                TextColumn::make('street_address')
                    ->label('Street Address'),

                // Column for displaying the creation date, formatted as a date-time
                TextColumn::make('created_at')
                    ->dateTime(),

                // Column for displaying the updated date, formatted as a date-time
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                // Currently, no filters are defined
            ])
            ->headerActions([
                // Action for creating a new record
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Action for editing the selected record
                Tables\Actions\EditAction::make(),

                // Action for deleting the selected record
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Group of bulk actions, currently only includes delete action
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
