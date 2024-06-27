<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    // The Eloquent model that this resource represents
    protected static ?string $model = Brand::class;

    // The attribute to be used as the title for records in the admin panel
    protected static ?string $recordTitleAttribute = 'name';

    // The sort order for the navigation menu
    protected static ?int $navigationSort = 2;

    // The icon to be used for this resource in the navigation menu
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    // Defines the form schema for creating and editing records
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                        ->schema([
                            // Text input for the brand name
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                            // Text input for the brand slug (URL-friendly identifier)
                            TextInput::make('slug')
                                ->maxLength(255)
                                ->disabled()
                                ->required()
                                ->dehydrated()
                                ->unique(table: Category::class, column: 'slug', ignoreRecord: true),
                        ]),
                    Grid::make()
                        ->schema([
                            // File upload for the brand image
                            FileUpload::make('image')
                                ->image()
                                ->directory('brands')
                                ->required(),

                            // Toggle for the active status of the brand
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
                // Column for the brand name, searchable
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                // Column for the brand image
                Tables\Columns\ImageColumn::make('image'),

                // Column for the brand slug, searchable
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                // Column for the active status of the brand, displayed as an icon
                Tables\Columns\IconColumn::make('status')
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
                ]),
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
