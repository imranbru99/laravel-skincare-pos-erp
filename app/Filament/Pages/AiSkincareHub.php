<?php

namespace App\Filament\Pages;

use App\Models\Product;
use App\Services\AiSkincareService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiSkincareHub extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'AI & Data Intelligence';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'AI Skincare Consultant';

    protected static ?string $title = 'AI Skincare & Routine Diagnosis Hub';

    protected static string $view = 'filament.pages.ai-skincare-hub';

    public $skinType = 'combination';
    public $concerns = ['acne', 'pigmentation'];
    public $notes = '';
    public $generatedRoutine = null;
    public $recommendedProducts = [];
    public $isLoading = false;

    public function generateConsultation(AiSkincareService $aiService)
    {
        $this->isLoading = true;

        $result = $aiService->analyzeSkinAndRecommendRoutine(
            $this->skinType,
            $this->concerns,
            $this->notes
        );

        $this->generatedRoutine = $result['analysis'];
        $this->recommendedProducts = Product::whereIn('id', $result['recommended_product_ids'])->get();

        $this->isLoading = false;

        Notification::make()
            ->title('AI Diagnosis & Regimen Generated')
            ->success()
            ->send();
    }
}
