<?php

namespace App\Providers;

use App\Console\Commands\StartMmkkApolloAgent;
use Illuminate\Support\ServiceProvider;

class ApolloServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'config/apollo.php'=>config_path('apollo.php'),
        ]);

        if($this->app->runningInConsole())
        {
            $this->commands([
                StartMmkkApolloAgent::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/../../config/apollo.php','apollo');

        $this->commands('command.mmkk.apollo.start-agent');
    }

    public function provides()
    {
        return ['command.mmkk.apollo.start-agent'];
    }
}
