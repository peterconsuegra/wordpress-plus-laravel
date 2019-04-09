<?php

namespace Peterconsuegra\WordPressPlusLaravel;

use Illuminate\Support\ServiceProvider;

class WordPressPlusLaravelServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
	
	
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
				Console\InstallWPMiddleware::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
