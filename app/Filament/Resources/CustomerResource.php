<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'POS & Sales';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Profile & Skin Diagnosis')
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Customer Name')
                                ->required(),
                            Forms\Components\TextInput::make('phone')
                                ->label('Phone Number (01...)')
                                ->tel()
                                ->required()
                                ->unique(ignoreRecord: true),
                            Forms\Components\TextInput::make('email')
                                ->email(),
                        ]),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\Select::make('skin_type')
                                ->options([
                                    'oily' => 'Oily Skin (তৈলাক্ত)',
                                    'dry' => 'Dry Skin (শুষ্ক)',
                                    'combination' => 'Combination (মিশ্র)',
                                    'sensitive' => 'Sensitive (সংবেদনশীল)',
                                    'normal' => 'Normal (স্বাভাবিক)',
                                ]),
                            Forms\Components\Select::make('skin_concerns')
                                ->multiple()
                                ->options([
                                    'acne' => 'Acne (ব্রণ)',
                                    'pigmentation' => 'Pigmentation (মেছতা)',
                                    'aging' => 'Aging & Wrinkles (বয়সের ছাপ)',
                                    'dark_spots' => 'Dark Spots (কালো দাগ)',
                                    'hydration' => 'Dehydration (পানিশূন্যতা)',
                                ]),
                            Forms\Components\TextInput::make('loyalty_points')
                                ->numeric()
                                ->default(0)
                                ->label('Loyalty Points (পয়েন্টস)'),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('district')
                                ->default('Dhaka'),
                            Forms\Components\Textarea::make('address')
                                ->rows(2),
                        ]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Dermatological / Skin Allergy Notes')
                            ->rows(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skin_type')
                    ->label('Skin Type')
                    ->badge()
                    ->color('info')
                    ->placeholder('Not set'),
                Tables\Columns\TextColumn::make('loyalty_points')
                    ->label('Points')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('district')
                    ->label('District'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
