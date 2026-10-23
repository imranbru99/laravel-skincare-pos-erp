<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Services\BangladeshiCourierService;
use App\Services\PdfInvoiceService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Orders & Logistics';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Order & Customer Snapshot')
                        ->schema([
                            Forms\Components\Grid::make(3)->schema([
                                Forms\Components\TextInput::make('order_number')
                                    ->disabled()
                                    ->default(fn () => Order::generateOrderNumber()),
                                Forms\Components\Select::make('branch_id')
                                    ->relationship('branch', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('order_type')
                                    ->options([
                                        'online' => 'Online Store (অনলাইন শপ)',
                                        'landing_page' => 'Landing Funnel (ল্যান্ডিং ফানেল)',
                                        'pos' => 'POS Outlet (শোরুম সেল)',
                                        'wholesale' => 'Wholesale / B2B (পাইকারি)',
                                    ])
                                    ->default('online')
                                    ->required(),
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\TextInput::make('customer_name')
                                    ->label('Customer Full Name')
                                    ->required(),
                                Forms\Components\TextInput::make('customer_phone')
                                    ->label('Customer Phone (01...)')
                                    ->tel()
                                    ->required(),
                            ]),

                            Forms\Components\Grid::make(2)->schema([
                                Forms\Components\Select::make('delivery_zone')
                                    ->options([
                                        'inside_dhaka' => 'Inside Dhaka (৳৬০)',
                                        'sub_dhaka' => 'Sub-Dhaka / Gazipur / Savar (৳১০০)',
                                        'outside_dhaka' => 'Outside Dhaka (৳১৩০)',
                                    ])
                                    ->default('inside_dhaka')
                                    ->required(),
                                Forms\Components\TextInput::make('delivery_city')
                                    ->default('Dhaka'),
                            ]),

                            Forms\Components\Textarea::make('delivery_address')
                                ->label('Detailed Delivery Address')
                                ->required()
                                ->rows(2),
                        ]),

                    Forms\Components\Section::make('Order Items')
                        ->schema([
                            Forms\Components\Repeater::make('items')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->relationship('product', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $product = \App\Models\Product::find($state);
                                            if ($product) {
                                                $set('product_name', $product->name);
                                                $set('unit_price', $product->effective_price);
                                                $set('total_price', $product->effective_price);
                                            }
                                        }),
                                    Forms\Components\Hidden::make('product_name'),
                                    Forms\Components\TextInput::make('unit_price')
                                        ->label('Unit Price (৳)')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('quantity')
                                        ->numeric()
                                        ->default(1)
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $unit = (float) $get('unit_price');
                                            $qty = (int) $state;
                                            $set('total_price', $unit * $qty);
                                        }),
                                    Forms\Components\TextInput::make('total_price')
                                        ->label('Total (৳)')
                                        ->numeric()
                                        ->required(),
                                ])
                                ->columns(4),
                        ]),
                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Payment & Amounts')
                        ->schema([
                            Forms\Components\TextInput::make('subtotal')
                                ->label('Subtotal (৳)')
                                ->numeric()
                                ->default(0),
                            Forms\Components\TextInput::make('discount')
                                ->label('Discount (৳)')
                                ->numeric()
                                ->default(0),
                            Forms\Components\TextInput::make('delivery_charge')
                                ->label('Delivery Charge (৳)')
                                ->numeric()
                                ->default(60),
                            Forms\Components\TextInput::make('total_amount')
                                ->label('Net Total (৳)')
                                ->numeric()
                                ->default(0),
                            Forms\Components\TextInput::make('paid_amount')
                                ->label('Paid Amount (৳)')
                                ->numeric()
                                ->default(0),
                            Forms\Components\TextInput::make('due_amount')
                                ->label('Due / COD (৳)')
                                ->numeric()
                                ->default(0),
                            Forms\Components\Select::make('payment_method')
                                ->options([
                                    'cod' => 'Cash On Delivery (COD)',
                                    'bkash' => 'bKash Merchant / Personal',
                                    'nagad' => 'Nagad',
                                    'card' => 'POS Debit/Credit Card',
                                    'cash' => 'Cash at Counter',
                                ])
                                ->default('cod'),
                            Forms\Components\Select::make('payment_status')
                                ->options([
                                    'pending' => 'Pending (অপেক্ষমাণ)',
                                    'paid' => 'Fully Paid (পরিশোধিত)',
                                    'partially_paid' => 'Partially Paid (আংশিক পরিশোধ)',
                                ])
                                ->default('pending'),
                        ]),

                    Forms\Components\Section::make('Courier & Fulfillment')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'pending' => 'Pending Confirmation',
                                    'confirmed' => 'Order Confirmed',
                                    'processing' => 'Processing',
                                    'packaged' => 'Packaged / Ready to Ship',
                                    'in_transit' => 'In Transit with Courier',
                                    'delivered' => 'Delivered (সফল ডেলিভারি)',
                                    'cancelled' => 'Cancelled (বাতিল)',
                                    'returned' => 'Returned / RTO (ফেরত)',
                                    'exchanged' => 'Exchanged (বিনিময়)',
                                ])
                                ->default('pending')
                                ->required(),
                            Forms\Components\Select::make('courier_name')
                                ->options([
                                    'Steadfast' => 'Steadfast Courier (API Integrated)',
                                    'Pathao' => 'Pathao Courier Logistics',
                                    'RedX' => 'RedX Courier',
                                    'In-house' => 'In-house Branch Rider',
                                ]),
                            Forms\Components\TextInput::make('courier_tracking_code')
                                ->label('Tracking Code'),
                            Forms\Components\TextInput::make('courier_status')
                                ->label('Live Courier Status'),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M, h:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer')
                    ->description(fn (Order $record): string => $record->customer_phone)
                    ->searchable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('order_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pos' => 'info',
                        'landing_page' => 'warning',
                        'wholesale' => 'purple',
                        default => 'success',
                    }),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total (৳)')
                    ->money('BDT')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'confirmed' => 'info',
                        'packaged' => 'warning',
                        'in_transit' => 'primary',
                        'delivered' => 'success',
                        'returned', 'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('courier_name')
                    ->label('Courier')
                    ->description(fn (Order $record): string => $record->courier_tracking_code ?? 'Not booked')
                    ->placeholder('None'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'packaged' => 'Packaged',
                        'in_transit' => 'In Transit',
                        'delivered' => 'Delivered',
                        'returned' => 'Returned',
                    ]),
                Tables\Filters\SelectFilter::make('order_type')
                    ->options([
                        'online' => 'Online',
                        'landing_page' => 'Landing Page',
                        'pos' => 'POS',
                        'wholesale' => 'Wholesale',
                    ]),
                Tables\Filters\SelectFilter::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Branch'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('book_courier')
                        ->label('Book Steadfast Courier')
                        ->icon('heroicon-o-truck')
                        ->color('success')
                        ->visible(fn (Order $record) => empty($record->courier_tracking_code))
                        ->action(function (Order $record, BangladeshiCourierService $courierService) {
                            $res = $courierService->bookSteadfast($record);
                            if ($res['success']) {
                                Notification::make()
                                    ->title('Steadfast Parcel Booked')
                                    ->body("Tracking Code: {$res['tracking_code']}")
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Courier Booking Error')
                                    ->body($res['error'] ?? 'Unknown error')
                                    ->danger()
                                    ->send();
                            }
                        }),

                    Tables\Actions\Action::make('check_courier')
                        ->label('Track Delivery Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->visible(fn (Order $record) => !empty($record->courier_tracking_code))
                        ->action(function (Order $record, BangladeshiCourierService $courierService) {
                            $res = $courierService->checkStatus($record);
                            Notification::make()
                                ->title('Courier Status Synced')
                                ->body("Tracking: {$res['tracking_code']} | Status: {$res['status']}")
                                ->info()
                                ->send();
                        }),

                    Tables\Actions\Action::make('print_invoice')
                        ->label('Print Bangla Invoice (চালান)')
                        ->icon('heroicon-o-printer')
                        ->color('primary')
                        ->url(fn (Order $record): string => route('order.pdf.invoice', $record))
                        ->openUrlInNewTab(),

                    Tables\Actions\Action::make('print_pos_receipt')
                        ->label('Print POS Receipt (রসিদ)')
                        ->icon('heroicon-o-receipt-percent')
                        ->color('secondary')
                        ->url(fn (Order $record): string => route('order.pdf.receipt', $record))
                        ->openUrlInNewTab(),

                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
