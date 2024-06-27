<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    // The Eloquent model that this resource represents
    protected static ?string $model = Product::class;

    // The sort order for the navigation menu
    protected static ?int $navigationSort = 4;

    // The icon to be used for this resource in the navigation menu
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    // Defines the form schema for creating and editing records
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Grouping form components
                Group::make()->schema([
                    // Section for product information
                    Section::make('Product Information')->schema([
                        // Text input for the product name
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            // Creates a slug automatically but only when the operation is create
                            ->afterStateUpdated(function (string $operation, $state, Set $set){
                                if ($operation !== 'create') {
                                    return;
                                }
                                // Generate slug from name when creating a new record
                                $set('slug', Str::slug($state));
                            }),

                        // Text input for the product slug
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        // Markdown editor for the product description
                        Forms\Components\MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(2),

                    // Section for product images
                    FileUpload::make('image')
                        ->multiple()
                        ->directory('products')
                        ->maxFiles(5)
                        ->reorderable()
                        ->storeFileNamesIn('image'),
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make()->schema([
                        // Text input for the product price
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('€'),
                    ]),

                    // Section for associations
                    Section::make('Associations')->schema([
                        // Select input for category
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        // Select input for brand
                        Select::make('brand_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name'),

                    ]),

                    // Section for product status
                    Section::make('Status')->schema([
                        // Toggle for in stock status
                        Toggle::make('in_stock')
                            ->required()
                            ->default(true),

                        // Toggle for active status
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),

                        // Toggle for featured status
                        Toggle::make('is_featured')
                            ->required(),

                        // Toggle for on sale status
                        Toggle::make('on_sale')
                            ->required(),
                    ])
                ])->columnSpan(1),
            ])->columns(3);
    }

    // Defines the table schema for listing records
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Text column for category ID
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),

                // Text column for brand ID
                Tables\Columns\TextColumn::make('brand_id')
                    ->numeric()
                    ->sortable(),

                // Text column for product name
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                // Text column for product slug
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                // Text column for category name
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),

                // Text column for brand name
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),

                // Text column for product price, formatted as currency
                Tables\Columns\TextColumn::make('price')
                    ->money('EUR', divideBy: 100)
                    ->sortable(),

                // Icon column for active status
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                // Icon column for featured status
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                // Icon column for in stock status
                Tables\Columns\IconColumn::make('in_stock')
                    ->boolean(),

                // Icon column for on sale status
                Tables\Columns\IconColumn::make('on_sale')
                    ->boolean(),

                // Text column for created at timestamp, toggleable and sortable
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Text column for updated at timestamp, toggleable and sortable
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter for category
                SelectFilter::make('category')
                    ->relationship('category', 'name'),

                // Filter for brand
                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
            ])
            ->actions([
                // Action group for view, edit, and delete actions
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                // Bulk action group for delete action
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Defines the relations for the resource
    public static function getRelations(): array
    {
        return [
            // Define any relationships here
        ];
    }

    // Defines the pages for the resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
