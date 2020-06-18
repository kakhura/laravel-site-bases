<?php

namespace Kakhura\LaravelSiteBases;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class SiteBasesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfigs();
        $this->publishViews();
        $this->publishMigrations();
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function publishConfigs()
    {
        $configPath = __DIR__ . '/../config/kakhura.site-bases.php';
        $this->mergeConfigFrom($configPath, 'kakhura.site-bases');
        $this->publishes([$configPath => config_path('kakhura.site-bases.php')], 'kakhura-site-bases-config');
    }

    protected function publishViews()
    {
        foreach (config('kakhura.site-bases.modules_publish_mapper') as $module) {
            $viewPath = __DIR__ . sprintf('/../resources/views/%s', $module);
            if (File::exists($viewPath)) {
                $this->loadViewsFrom($viewPath, 'site-bases');
                $this->publishes([
                    $viewPath => base_path('resources/views/vendor/admin/site-bases'),
                ], 'kakhura-site-bases-views');
            }
        }
    }

    protected function publishMigrations()
    {
        foreach (config('kakhura.site-bases.modules_publish_mapper') as $module) {
            $migrationPath = __DIR__ . sprintf('/../database/migrations/%s', $module);
            if (File::exists($migrationPath)) {
                $this->publishes([
                    $migrationPath => base_path('database/migrations'),
                ], 'kakhura-site-bases-migrations');
            }
        }
    }
}
