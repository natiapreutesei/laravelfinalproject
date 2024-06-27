<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    // The Eloquent model that this resource represents
    protected static ?string $model = Order::class;

    // The sort order for the navigation menu
    protected static ?int $navigationSort = 5;

    // The icon to be used for this resource in the navigation menu
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    // Defines the form schema for creating and editing records
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Details')->schema([
                        // Select input for the user (customer), with a relationship to the User model
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Select input for the payment method
                        Select::make('payment_method')
                            ->options([
                                'stripe' => 'Stripe',
                            ])
                            ->required(),

                        // Select input for the payment status
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->default('pending')
                            ->required(),

                        // Toggle buttons for the order status
                        ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'cancelled' => 'heroicon-m-x-circle',
                            ]),

                        // Select input for the currency
                        Select::make('currency')
                            ->options([
                                /*'usd' => 'USD',*/
                                'eur' => 'EUR',
                                /*'gbp' => 'GBP',*/
                            ])
                            ->default('eur')
                            ->required(),

                        // Select input for the shipping method
                        Select::make('shipping_method')
                            ->options([
                                'dhl' => 'DHL',
                                'bpost' => 'BPOST',
                                'ups' => 'UPS',
                            ]),

                        // Textarea for notes
                        Textarea::make('notes')
                            ->label('Notes')
                            ->columnSpanFull(),
                    ])->columns(2),

                    // Section for order items
                    Section::make('Order Items')->schema([
                        // Repeater component for order items
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                // Select input for the product, with a relationship to the Product model
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->distinct()
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Find the product based on the selected product ID ($state)
                                        $product = Product::find($state);

                                        // If the product is found, get its price. If not, set the price to 0
                                        $price = $product ? $product->price : 0;

                                        // Set the 'unit_amount' field to the product's price
                                        $set('unit_amount', $price);

                                        // Set the 'total_amount' field to the product's price
                                        $set('total_amount', $price);
                                    }),

                                // Text input for the quantity
                                TextInput::make('quantity')
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->numeric()
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $totalAmount = $state * $get('unit_amount');
                                        $set('total_amount', $totalAmount);
                                    }),

                                // Text input for the unit amount
                                TextInput::make('unit_amount')
                                    ->required()
                                    ->numeric()
                                    ->columnSpan(3),

                                // Text input for the total amount
                                TextInput::make('total_amount')
                                    ->required()
                                    ->numeric()
                                    ->columnSpan(3),
                            ])->columns(12),

                        // Placeholder for displaying the grand total
                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function(Get $get, Set $set){
                                $total = 0;

                                // Get the 'items' repeater data from the form state
                                if (!$repeaters = $get('items')) {
                                    // If there are no items, return the formatted total (0 in this case)
                                    return number_format($total / 100, 2) . ' €'; // Divide by 100 to convert cents to euros
                                }

                                // Iterate over each item in the repeater
                                foreach ($repeaters as $key => $repeater) {
                                    // Add the total amount of each item to the grand total
                                    $total += $get("items.{$key}.total_amount");
                                }

                                // Set the 'grand_total' hidden field to the calculated total
                                $set('grand_total', $total);

                                // Return the formatted grand total
                                return number_format($total / 100, 2) . ' €'; // Divide by 100 to convert cents to euros
                            }),


                        // Hidden field for storing the grand total
                        Hidden::make('grand_total')
                            ->default(0),
                    ])
                ])->columnSpanFull(),
            ]);
    }

    // Defines the table schema for listing records
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Column for the customer name, searchable
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                // Column for the grand total, formatted as currency, and sortable
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('EUR', divideBy: 100)
                    ->sortable(),

                // Column for the payment method, searchable and sortable
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->searchable()
                    ->sortable(),

                // Column for the payment status, searchable and sortable
                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->searchable()
                    ->sortable(),

                // Column for the currency, searchable and sortable
                TextColumn::make('currency')
                    ->label('Currency')
                    ->searchable()
                    ->sortable(),

                // Column for the shipping method, searchable and sortable
                TextColumn::make('shipping_method')
                    ->label('Shipping Method')
                    ->searchable()
                    ->sortable(),

                // Select column for the order status, with defined options and sortable
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->sortable(),

                // Column for the created_at timestamp, toggleable, and sortable
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Column for the updated_at timestamp, toggleable, and sortable
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Defines the relations for the resource
    public static function getRelations(): array
    {
        return [
            // Include the AddressRelationManager to manage related addresses
            AddressRelationManager::class
        ];
    }

    // Defines the navigation badge for the resource, showing the count of orders
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    // Defines the pages for the resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
