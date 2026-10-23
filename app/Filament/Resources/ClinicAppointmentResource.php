<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClinicAppointmentResource\Pages;
use App\Models\ClinicAppointment;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClinicAppointmentResource extends Resource
{
    protected static ?string $model = ClinicAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Clinic & Dermatology';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dermatologist Consultation & Patient Details')
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('appointment_number')
                                ->disabled()
                                ->default(fn () => ClinicAppointment::generateAppointmentNumber()),
                            Forms\Components\Select::make('branch_id')
                                ->relationship('branch', 'name')
                                ->required(),
                            Forms\Components\Select::make('doctor_id')
                                ->relationship('doctor', 'name', fn ($query) => $query->where('role', 'doctor'))
                                ->label('Consultant Doctor / Dermatologist')
                                ->searchable()
                                ->preload(),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('customer_name')
                                ->required(),
                            Forms\Components\TextInput::make('customer_phone')
                                ->tel()
                                ->required(),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('appointment_date')
                                ->required()
                                ->default(now()),
                            Forms\Components\TextInput::make('appointment_time')
                                ->placeholder('04:30 PM')
                                ->required(),
                        ]),

                        Forms\Components\Select::make('skin_concerns')
                            ->multiple()
                            ->options([
                                'severe_acne' => 'Cystic & Severe Acne (মারাত্মক ব্রণ)',
                                'hyperpigmentation' => 'Melasma & Sun Damage (মেছতা ও রোদে পোড়া)',
                                'eczema' => 'Eczema & Atopic Dermatitis (একজিমা)',
                                'fungal_acne' => 'Fungal Acne (ছত্রাকজনিত ব্রণ)',
                                'barrier_damage' => 'Compromised Skin Barrier (ক্ষতিগ্রস্ত স্কিন ব্যারিয়ার)',
                            ]),

                        Forms\Components\Textarea::make('symptoms')
                            ->label('Patient Symptoms & History')
                            ->rows(2),

                        Forms\Components\Textarea::make('doctor_prescription')
                            ->label('Dermatologist Prescription / Regimen Advice')
                            ->rows(3),

                        Forms\Components\Select::make('recommended_products')
                            ->label('Prescribed Skincare Products')
                            ->multiple()
                            ->options(Product::where('is_active', true)->pluck('name', 'id'))
                            ->searchable(),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('consultation_fee')
                                ->label('Consultation Fee (৳)')
                                ->numeric()
                                ->default(500)
                                ->prefix('৳'),
                            Forms\Components\Select::make('payment_status')
                                ->options([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                ]),
                            Forms\Components\Select::make('status')
                                ->options([
                                    'scheduled' => 'Scheduled',
                                    'in_consultation' => 'In Consultation',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->default('scheduled'),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment_number')
                    ->label('Appt #')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Patient')
                    ->description(fn (ClinicAppointment $record) => $record->customer_phone)
                    ->searchable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_time'),
                Tables\Columns\TextColumn::make('branch.name')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'info',
                        'in_consultation' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClinicAppointments::route('/'),
            'create' => Pages\CreateClinicAppointment::route('/create'),
            'edit' => Pages\EditClinicAppointment::route('/{record}/edit'),
        ];
    }
}
