<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DrutogotiPerformance extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationGroup = 'System & Modules';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Speed & Optimization (Drutogoti)';

    protected static ?string $title = 'Drutogoti Speed & Bottleneck Engine';

    protected static string $view = 'filament.pages.drutogoti-performance';

    public $metrics = [];
    public $suggestions = [];
    public $lastBenchmark = null;

    public function mount()
    {
        $this->refreshMetrics();
    }

    public function refreshMetrics()
    {
        $start = microtime(true);
        // sample benchmark query
        DB::table('products')->count();
        $dbLatency = round((microtime(true) - $start) * 1000, 2);

        $this->metrics = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'opcache_enabled' => function_exists('opcache_get_status') && opcache_get_status() !== false,
            'db_latency_ms' => $dbLatency,
            'memory_usage_mb' => round(memory_get_usage(true) / 1024 / 1024, 2),
            'routes_cached' => app()->routesAreCached(),
            'config_cached' => app()->configurationIsCached(),
            'events_cached' => app()->eventsAreCached(),
        ];
    }

    public function runCacheOptimization()
    {
        try {
            Artisan::call('optimize');
            $this->refreshMetrics();
            Notification::make()
                ->title('Drutogoti Optimization Applied')
                ->body('Configuration, routes, and views compiled & cached for peak speed.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()->title('Optimization Error')->body($e->getMessage())->danger()->send();
        }
    }

    public function clearAllCaches()
    {
        try {
            Artisan::call('optimize:clear');
            $this->refreshMetrics();
            Notification::make()
                ->title('Caches Cleared')
                ->body('All application cache tiers reset.')
                ->info()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()->title('Clear Error')->body($e->getMessage())->danger()->send();
        }
    }

    public function runBenchmark()
    {
        $start = microtime(true);
        for ($i = 0; $i < 50; $i++) {
            DB::table('branches')->first();
        }
        $timeMs = round((microtime(true) - $start) * 1000, 2);

        $this->lastBenchmark = [
            'iterations' => 50,
            'total_time_ms' => $timeMs,
            'avg_query_ms' => round($timeMs / 50, 3),
            'timestamp' => now()->format('h:i:s A'),
        ];

        Notification::make()
            ->title('Benchmark Complete')
            ->body("50 Queries processed in {$timeMs}ms")
            ->success()
            ->send();
    }
}
