<x-filament-panels::page>
    <div class="space-y-6">

        <!-- Top Action Buttons -->
        <div class="flex flex-wrap items-center gap-3 bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <button 
                wire:click="runCacheOptimization" 
                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition flex items-center gap-2 shadow-sm">
                <span>🚀 Drutogoti 1-Click Optimize</span>
            </button>

            <button 
                wire:click="runBenchmark" 
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition flex items-center gap-2 shadow-sm">
                <span>⚡ Run Live Query Benchmark</span>
            </button>

            <button 
                wire:click="clearAllCaches" 
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200 font-semibold rounded-lg text-sm transition">
                <span>🧹 Clear Caches</span>
            </button>

            <button 
                wire:click="refreshMetrics" 
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200 font-semibold rounded-lg text-sm transition ml-auto">
                <span>🔄 Refresh Stats</span>
            </button>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Database Latency</div>
                <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">
                    {{ $metrics['db_latency_ms'] ?? 0 }} ms
                </div>
                <div class="text-xs text-gray-400 mt-1">SQLite / Local PDO</div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Memory Allocation</div>
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                    {{ $metrics['memory_usage_mb'] ?? 0 }} MB
                </div>
                <div class="text-xs text-gray-400 mt-1">Real memory in use</div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">PHP & Framework</div>
                <div class="text-base font-bold text-gray-800 dark:text-gray-200 mt-2">
                    PHP {{ $metrics['php_version'] }}
                </div>
                <div class="text-xs text-gray-400 mt-1">Laravel {{ $metrics['laravel_version'] }}</div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">OPcache Status</div>
                <div class="text-2xl font-bold {{ ($metrics['opcache_enabled'] ?? false) ? 'text-emerald-600' : 'text-amber-500' }} mt-2">
                    {{ ($metrics['opcache_enabled'] ?? false) ? 'Active' : 'Disabled' }}
                </div>
                <div class="text-xs text-gray-400 mt-1">Bytecode caching</div>
            </div>

        </div>

        <!-- Cache Statuses & Benchmarks -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <span>📦 Laravel Production Cache Tiers</span>
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Route Cache</span>
                        <span class="text-xs px-2 py-0.5 rounded font-bold {{ $metrics['routes_cached'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $metrics['routes_cached'] ? 'CACHED' : 'NOT CACHED' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Config Cache</span>
                        <span class="text-xs px-2 py-0.5 rounded font-bold {{ $metrics['config_cached'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $metrics['config_cached'] ? 'CACHED' : 'NOT CACHED' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Events Cache</span>
                        <span class="text-xs px-2 py-0.5 rounded font-bold {{ $metrics['events_cached'] ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $metrics['events_cached'] ? 'CACHED' : 'NOT CACHED' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="font-bold text-sm text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <span>📊 Latest Query Benchmark</span>
                </h3>

                @if($lastBenchmark)
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 dark:bg-blue-900/30">
                            <span class="text-sm font-medium">Batch Iterations:</span>
                            <span class="font-bold text-sm">{{ $lastBenchmark['iterations'] }} Queries</span>
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 dark:bg-blue-900/30">
                            <span class="text-sm font-medium">Total Execution:</span>
                            <span class="font-bold text-sm text-emerald-600">{{ $lastBenchmark['total_time_ms'] }} ms</span>
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 dark:bg-blue-900/30">
                            <span class="text-sm font-medium">Avg Per Query:</span>
                            <span class="font-bold text-sm">{{ $lastBenchmark['avg_query_ms'] }} ms</span>
                        </div>
                        <div class="text-[11px] text-gray-400 text-right">Run at: {{ $lastBenchmark['timestamp'] }}</div>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400 text-xs">
                        Click "Run Live Query Benchmark" above to test throughput and database query efficiency.
                    </div>
                @endif
            </div>

        </div>

    </div>
</x-filament-panels::page>
