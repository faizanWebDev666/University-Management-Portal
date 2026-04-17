<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Task;

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
        // Share pending task count with registration branch sidebar
        View::composer('components.registrationheader', function ($view) {
            $pendingCount = Task::where('department', 'Registration')
                ->whereIn('status', ['Pending', 'In Progress'])
                ->count();
            $view->with('pendingTaskCount', $pendingCount);
        });
    }
}
