<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockTransferResource\Pages;
use App\Models\BranchStock;
use App\Models\StockTransfer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StockTransferResource extends Resource
{
    protected static ?string $model = StockTransfer::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $navigationGroup = 'Multi-Branch & Warehouse';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Stock Transfer Requisition (আন্তঃশাখা চালান)')
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('transfer_number')
                                ->disabled()
                                ->default(fn () => StockTransfer::generateTransferNumber()),
                            Forms\Components\Select::make('from_branch_id')
                                ->label('Dispatching Branch / Warehouse')
                                ->relationship('fromBranch', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),
                            Forms\Components\Select::make('to_branch_id')
                                ->label('Receiving Destination Branch')
                                ->relationship('toBranch', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'pending' => 'Pending Requisition',
                                    'approved' => 'Approved by Central Warehouse',
                                    'dispatched' => 'Dispatched in Transit',
                                    'received' => 'Received & Stock Updated',
                                    'rejected' => 'Rejected',
                                ])
                                ->default('pending')
                                ->required(),
                            Forms\Components\Textarea::make('notes')
                                ->rows(2),
                        ]),

                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('quantity_requested')
                                    ->numeric()
                                    ->required()
                                    ->label('Qty Requested'),
                                Forms\Components\TextInput::make('quantity_transferred')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Qty Dispatched'),
                                Forms\Components\TextInput::make('quantity_received')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Qty Received'),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transfer_number')
                    ->label('Challan #')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fromBranch.name')
                    ->label('From')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('toBranch.name')
                    ->label('To')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'approved' => 'info',
                        'dispatched' => 'warning',
                        'received' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_received')
                    ->label('Accept & Update Stock')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (StockTransfer $record) => in_array($record->status, ['approved', 'dispatched']))
                    ->action(function (StockTransfer $record) {
                        // Transfer stock between branches
                        foreach ($record->items as $item) {
                            $qty = $item->quantity_transferred > 0 ? $item->quantity_transferred : $item->quantity_requested;
                            $item->update(['quantity_received' => $qty]);

                            // Deduct from sender
                            BranchStock::updateOrCreate(
                                ['branch_id' => $record->from_branch_id, 'product_id' => $item->product_id],
                                ['stock_quantity' => \DB::raw("GREATEST(0, stock_quantity - {$qty})")]
                            );

                            // Add to receiver
                            BranchStock::updateOrCreate(
                                ['branch_id' => $record->to_branch_id, 'product_id' => $item->product_id],
                                ['stock_quantity' => \DB::raw("stock_quantity + {$qty}")]
                            );
                        }

                        $record->update([
                            'status' => 'received',
                            'received_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Stock Transfer Received')
                            ->body('Stock balances updated in both branches.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('print_challan')
                    ->label('Print Challan (চালান)')
                    ->icon('heroicon-o-printer')
                    ->color('primary')
                    ->url(fn (StockTransfer $record): string => route('transfer.pdf.challan', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockTransfers::route('/'),
            'create' => Pages\CreateStockTransfer::route('/create'),
            'edit' => Pages\EditStockTransfer::route('/{record}/edit'),
        ];
    }
}
