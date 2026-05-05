<?php

namespace App\Providers;

use App\Models\Participant;
use App\Observers\ParticipantObserver;
use Illuminate\Support\Facades\URL;
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
            URL::forceScheme('https');

            request()->server->set('HTTPS', 'on');
        }

        Participant::observe(ParticipantObserver::class);
    }
}
