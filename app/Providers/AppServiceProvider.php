<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $currentRouteName = optional(Route::current())->getName();
            $pageTitle = $this->derivePageTitleFromNavigation($currentRouteName);
            $view->with('pageTitle', $pageTitle);
        });
    }

    private function derivePageTitleFromNavigation(?string $routeName): string
    {
        if (! $routeName) {
            return config('app.name');
        }

        $navigation = config('navigation', []);

        foreach ($navigation as $item) {
            if (($item['type'] ?? null) === 'link' && ($item['route'] ?? null) === $routeName) {
                return $item['name'] ?? $routeName;
            }

            if (($item['type'] ?? null) === 'group') {
                foreach (($item['children'] ?? []) as $child) {
                    if (($child['route'] ?? null) === $routeName) {
                        return $child['name'] ?? $routeName;
                    }
                }
            }
        }

        return str_replace(['.', '-'], [' ', ' '], ucfirst(last(explode('.', $routeName))));
    }
}
