<?php

namespace App\Providers;

use App\Models\SiteContent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        if ($this->app->runningInConsole()) {
            return;
        }

        $content = SiteContent::defaultContent();

        try {
            if (Schema::hasTable('site_contents')) {
                $stored = SiteContent::current()->content;

                if ($stored instanceof \ArrayObject) {
                    $stored = $stored->getArrayCopy();
                }

                if (is_array($stored)) {
                    $content = array_replace_recursive($content, $stored);
                }
            }
        } catch (QueryException) {
        }

        View::share('siteContent', $content);
    }
}
