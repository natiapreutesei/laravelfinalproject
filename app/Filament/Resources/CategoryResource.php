<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    // The Eloquent model that this resource represents
    protected static ?string $model = Category::class;

    // The icon to be used for this resource in the navigation menu
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // The sort order for the navigation menu
    protected static ?int $navigationSort = 3;

    // Defines the form schema for creating and editing records
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                        ->schema([
                            // Text input for the category name
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                // Automatically sets the category slug when the name changes
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                            // Text input for the category slug
                            TextInput::make('slug')
                                ->maxLength(255)
                                ->disabled()
                                ->required()
                                // the value of slug will saved and processed with the rest of the form data even if the input is disabled
                                ->dehydrated()
                                ->unique(table: Category::class, column: 'slug', ignoreRecord: true),
                        ]),
                    Grid::make()
                        ->schema([
                            // File upload for the category image
                            FileUpload::make('image')
                                ->image()
                                ->directory('categories')
                                ->required(),

                            // Toggle for the active status of the category
                            Toggle::make('is_active')
                                ->required()
                                ->default(true),
                        ]),
                ]),
            ]);
    }

    // Defines the table schema for listing records
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Column for the category name, searchable
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                // Column for the category image
                Tables\Columns\ImageColumn::make('image'),

                // Column for the category slug, searchable
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                // Column for the active status of the category, displayed as an icon
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                // Column for the created_at timestamp, sortable, and toggleable
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Column for the updated_at timestamp, sortable, and toggleable
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Define any filters for the table here
            ])
            ->actions([
                // Define the actions available for each record in the table
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                // Define the bulk actions available for the table
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Defines the relations for the resource
    public static function getRelations(): array
    {
        return [
            // Define any relations here
        ];
    }

    // Defines the pages for the resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
