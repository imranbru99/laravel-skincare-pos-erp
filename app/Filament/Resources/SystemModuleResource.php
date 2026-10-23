<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemModuleResource\Pages;
use App\Models\SystemModule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SystemModuleResource extends Resource
{
    protected static ?string $model = SystemModule::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationGroup = 'System & Modules';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Business Modules Control';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Module Configuration')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('key')
                            ->disabled()
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->disabled()
                            ->rows(2),
                        Forms\Components\Toggle::make('is_enabled')
                            ->label('Module Enabled for Business')
                            ->helperText('Switch OFF to stop and hide this feature across the system')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Module Name')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(60),
                Tables\Columns\ToggleColumn::make('is_enabled')
                    ->label('Enabled')
                    ->afterStateUpdated(function ($record, $state) {
                        \Illuminate\Support\Facades\Cache::forget("module_enabled_{$record->key}");
                        Notification::make()
                            ->title('Module Status Updated')
                            ->body("{$record->name} is now " . ($state ? 'Active' : 'Disabled'))
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemModules::route('/'),
            'edit' => Pages\EditSystemModule::route('/{record}/edit'),
        ];
    }
}
