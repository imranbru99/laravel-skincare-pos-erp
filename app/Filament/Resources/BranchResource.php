<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Multi-Branch & Warehouse';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Branch & Outlet Information')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Branch Name')
                                ->required()
                                ->placeholder('e.g. Banani Flagship Outlet'),
                            Forms\Components\TextInput::make('code')
                                ->label('Branch Code')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->placeholder('BNN-01'),
                        ]),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('phone')
                                ->label('Branch Hotline')
                                ->tel()
                                ->placeholder('017...'),
                            Forms\Components\TextInput::make('email')
                                ->label('Branch Email')
                                ->email(),
                            Forms\Components\TextInput::make('city')
                                ->label('City / Division')
                                ->default('Dhaka'),
                        ]),

                        Forms\Components\Textarea::make('address')
                            ->label('Complete Address')
                            ->required()
                            ->rows(2),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Toggle::make('is_central_warehouse')
                                ->label('Is Central Warehouse (কেন্দ্রীয় গুদাম)')
                                ->helperText('Central hub for all imports and branch requisitions'),
                            Forms\Components\Toggle::make('is_active')
                                ->label('Branch Operational')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Branch Name')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('city')
                    ->label('City'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone'),
                Tables\Columns\IconColumn::make('is_central_warehouse')
                    ->label('Central Hub')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
