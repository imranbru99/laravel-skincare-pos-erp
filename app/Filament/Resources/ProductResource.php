<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\AiSkincareService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Catalog & Inventory';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General Info')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Product English Name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('bangla_name')
                                        ->label('Product Bangla Name (বাংলা নাম)')
                                        ->placeholder('যেমন: কোসআরএক্স স্নেল মিউসিন এসেন্স'),
                                    Forms\Components\TextInput::make('slug')
                                        ->label('Universal Multilingual Slug')
                                        ->helperText('Auto-generated from name via Universal Slug')
                                        ->disabled()
                                        ->dehydrated(false),
                                ]),

                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\Select::make('brand_id')
                                        ->relationship('brand', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('name')->required(),
                                            Forms\Components\TextInput::make('country_of_origin')->default('South Korea'),
                                        ]),
                                    Forms\Components\Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm([
                                            Forms\Components\TextInput::make('name')->required(),
                                            Forms\Components\TextInput::make('bangla_name'),
                                        ]),
                                    Forms\Components\TextInput::make('sku')
                                        ->label('SKU')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->default(fn () => 'SKU-' . strtoupper(substr(uniqid(), -6))),
                                ]),

                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('barcode')
                                        ->label('Barcode / EAN')
                                        ->placeholder('8809...'),
                                    Forms\Components\TextInput::make('volume_or_weight')
                                        ->label('Volume / Size')
                                        ->placeholder('50ml / 100g / 150ml'),
                                    Forms\Components\TextInput::make('country_of_origin')
                                        ->label('Country of Origin')
                                        ->default('South Korea'),
                                ]),

                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\Toggle::make('bsti_certified')
                                        ->label('BSTI Certified (বিএসটিআই অনুমোদিত)')
                                        ->default(true),
                                    Forms\Components\Toggle::make('is_active')
                                        ->label('Active for Sale')
                                        ->default(true),
                                ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Skincare Attributes')
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Forms\Components\Select::make('skin_types')
                                    ->label('Suitable Skin Types (ত্বকের ধরন)')
                                    ->multiple()
                                    ->options([
                                        'oily' => 'Oily Skin (তৈলাক্ত ত্বক)',
                                        'dry' => 'Dry Skin (শুষ্ক ত্বক)',
                                        'combination' => 'Combination Skin (মিশ্র ত্বক)',
                                        'sensitive' => 'Sensitive Skin (সংবেদনশীল ত্বক)',
                                        'normal' => 'Normal Skin (স্বাভাবিক ত্বক)',
                                        'all' => 'All Skin Types (সব ধরনের ত্বক)',
                                    ]),

                                Forms\Components\Select::make('skin_concerns')
                                    ->label('Skin Concerns Targeted (ত্বকের সমস্যা)')
                                    ->multiple()
                                    ->options([
                                        'acne' => 'Acne & Blemishes (ব্রণ ও দাগ)',
                                        'pigmentation' => 'Melasma & Pigmentation (মেছতা ও পিগমেন্টেশন)',
                                        'aging' => 'Anti-Aging & Fine Lines (বয়সের ছাপ)',
                                        'dark_spots' => 'Dark Spots & Tan (রোদে পোড়া কালো দাগ)',
                                        'hydration' => 'Dehydration & Dullness (শুষ্কতা ও মলিনতা)',
                                        'pores' => 'Enlarged Pores (বড় লোমকূপ)',
                                        'redness' => 'Redness & Irritation (লালচে ভাব)',
                                    ]),

                                Forms\Components\TextInput::make('spf_rating')
                                    ->label('SPF & PA Rating (for Sunscreens)')
                                    ->placeholder('e.g. SPF 50+ PA++++'),

                                Forms\Components\Textarea::make('ingredients')
                                    ->label('Active Ingredients (উপাদানসমূহ)')
                                    ->rows(3)
                                    ->placeholder('Niacinamide 5%, Centella Asiatica 10%, Hyaluronic Acid, Ceramide NP'),

                                Forms\Components\Textarea::make('bangla_ingredients')
                                    ->label('Bangla Ingredients Summary (বাংলায় সক্রিয় উপাদান)')
                                    ->rows(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Pricing & Inventory')
                            ->icon('heroicon-o-currency-bangladeshi')
                            ->schema([
                                Forms\Components\Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('purchase_price')
                                        ->label('Purchase Price (৳ BDT)')
                                        ->numeric()
                                        ->prefix('৳')
                                        ->default(0),
                                    Forms\Components\TextInput::make('regular_price')
                                        ->label('Regular Selling Price (৳ BDT)')
                                        ->numeric()
                                        ->prefix('৳')
                                        ->required(),
                                    Forms\Components\TextInput::make('sale_price')
                                        ->label('Sale/Discounted Price (৳ BDT)')
                                        ->numeric()
                                        ->prefix('৳')
                                        ->nullable(),
                                ]),

                                Forms\Components\Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('stock_alert_quantity')
                                        ->label('Low Stock Alert Threshold')
                                        ->numeric()
                                        ->default(5)
                                        ->helperText('Get notified when total branch stock falls below this level'),
                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Featured Product (প্রদর্শনীর বিশেষ পণ্য)')
                                        ->default(false),
                                ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Descriptions & AI Copy')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Textarea::make('short_description')
                                    ->label('Short Summary')
                                    ->rows(2),
                                Forms\Components\RichEditor::make('description')
                                    ->label('Detailed English Description'),
                                Forms\Components\RichEditor::make('bangla_description')
                                    ->label('Bangla Description (বাংলা বিবরণ ও উপকারিতা)'),
                                Forms\Components\Textarea::make('how_to_use')
                                    ->label('How to Use (ব্যবহারের নিয়ম)')
                                    ->rows(3),
                            ]),

                        Forms\Components\Tabs\Tab::make('Funnel Landing Page')
                            ->icon('heroicon-o-rocket-launch')
                            ->schema([
                                Forms\Components\Toggle::make('is_landing_page_active')
                                    ->label('Enable Single-Product Checkout Funnel Landing Page')
                                    ->helperText('Creates a dedicated high-converting landing page at /landing/{slug}'),
                                Forms\Components\TextInput::make('landing_headline')
                                    ->label('Landing Page Hero Headline')
                                    ->placeholder('কোরিয়ান সিক্রেট গ্লো স্কিনকেয়ার কম্বো - ৭ দিনে স্পষ্ট পরিবর্তন!'),
                                Forms\Components\TextInput::make('landing_video_url')
                                    ->label('YouTube / Video Embed URL')
                                    ->placeholder('https://www.youtube.com/embed/...'),
                                Forms\Components\Textarea::make('landing_highlights')
                                    ->label('Landing Page Key Highlights')
                                    ->rows(3)
                                    ->placeholder('✓ ১০০% অরিজিনাল কোরিয়ান ফর্মুলেশন&#10;✓ ক্যাশ অন ডেলিভারি সারা বাংলাদেশে&#10;✓ কোনো পার্শ্বপ্রতিক্রিয়া নেই'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Primary Product Photo')
                                    ->image()
                                    ->directory('products'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Product & Brand')
                    ->description(fn (Product $record): string => ($record->brand?->name ?? 'Generic') . ' | ' . ($record->sku ?? ''))
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('regular_price')
                    ->label('Price (৳)')
                    ->money('BDT')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Offer Price (৳)')
                    ->money('BDT')
                    ->placeholder('None'),
                Tables\Columns\TextColumn::make('total_stock')
                    ->label('Total Stock')
                    ->badge()
                    ->color(fn (int $state, Product $record): string => $state <= $record->stock_alert_quantity ? 'danger' : 'success')
                    ->suffix(' pcs'),
                Tables\Columns\IconColumn::make('is_landing_page_active')
                    ->label('Landing Page')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Filter by Brand'),
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter by Category'),
                Tables\Filters\TernaryFilter::make('is_landing_page_active')
                    ->label('Has Landing Funnel'),
            ])
            ->actions([
                Tables\Actions\Action::make('ai_copy')
                    ->label('AI Copy')
                    ->icon('heroicon-o-sparkles')
                    ->color('warning')
                    ->action(function (Product $record, AiSkincareService $aiService) {
                        $generated = $aiService->generateBengaliProductCopy($record);
                        $record->update([
                            'bangla_name' => $generated['bangla_name'] ?? $record->bangla_name,
                            'bangla_description' => $generated['bangla_description'] ?? $record->bangla_description,
                            'how_to_use' => $generated['how_to_use'] ?? $record->how_to_use,
                        ]);

                        Notification::make()
                            ->title('AI Copywriting Generated')
                            ->body('Bengali product title, description, and usage instructions generated successfully via AI Skincare Hub!')
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
