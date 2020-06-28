<?php

namespace Kakhura\LaravelSiteBases;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Kakhura\LaravelSiteBases\Console\Commands\RunCommands;

class SiteBasesServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([RunCommands::class]);
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
                    $viewPath => base_path(sprintf('resources/views/vendor/admin/site-bases/%s', $module)),
                ], 'kakhura-site-bases-views');
            }
        }
        $this->publishOtherViews();
    }

    protected function publishOtherViews()
    {
        $viewPath = __DIR__ . '/../resources/views/translation-manager';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            $this->publishes([
                $viewPath => base_path('resources/views/vendor/translation-manager'),
            ], 'kakhura-site-bases-views');
        }
        $viewPath = __DIR__ . '/../resources/views/inc';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            $this->publishes([
                $viewPath => base_path('resources/views/vendor/admin/site-bases/inc'),
            ], 'kakhura-site-bases-views');
        }
        $viewPath = __DIR__ . '/../resources/views/index.blade.php';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            $this->publishes([
                $viewPath => base_path('resources/views/vendor/admin/site-bases/index.blade.php'),
            ], 'kakhura-site-bases-views');
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
