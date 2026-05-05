<?php

namespace App\Providers;

use App\Models\Participant;
use App\Observers\ParticipantObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');

            Vite::createAssetPathsUsing(function (string $path, $secure = null): string {
                return secure_asset($path);
            });
        }

        Participant::observe(ParticipantObserver::class);
    }
}
