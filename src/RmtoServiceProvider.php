<?php

namespace Rmto;

use Illuminate\Support\ServiceProvider;

class RmtoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/rmto.php' => config_path('rmto.php'),
        ], 'config');

        if ($this->isLumen()) {
            $this->app->configure('rmto');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rmto.php', 'rmto');

        $this->app->bind('rmto', function () {
            return new RmtoClient();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['rmto'];
    }

    /**
     * Check if app uses Lumen.
     *
     * @return bool
     */
    private function isLumen(): bool
    {
        return str_contains($this->app->version(), 'Lumen');
    }
}
