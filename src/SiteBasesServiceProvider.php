<?php

namespace Kakhura\LaravelSiteBases;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Kakhura\LaravelSiteBases\Console\Commands\RunCommands;
use Kakhura\LaravelSiteBases\Http\Middleware\AdminMiddleware;

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
    public function boot(Router $router)
    {
        $router->middlewareGroup('admin', [AdminMiddleware::class]);
        $this->publishConfigs();
        $this->publishViews();
        $this->publishMigrations();
        if (config('kakhura.site-bases.use_roles_and_permissions')) {
            $this->loadRoutesFrom(__DIR__ . '/role_routes.php');
        } else {
            $this->loadRoutesFrom(__DIR__ . '/routes.php');
        }
    }

    protected function publishConfigs()
    {
        $configPath = __DIR__ . '/../config/kakhura.site-bases.php';
        $this->mergeConfigFrom($configPath, 'kakhura.site-bases');
        if (!File::exists(config_path('kakhura.site-bases.php'))) {
            $this->publishes([$configPath => config_path('kakhura.site-bases.php')], 'kakhura-site-bases-config');
        }
    }

    protected function publishViews()
    {
        $this->publishAdminViews();
        if (config('kakhura.site-bases.publish_website_views')) {
            $this->publishWebsiteViews();
        }
        $this->publishOtherViews();
    }

    protected function publishAdminViews()
    {
        foreach (config('kakhura.site-bases.modules_publish_mapper') as $module) {
            $viewPath = __DIR__ . sprintf('/../resources/views/admin/%s', $module);
            if (File::exists($viewPath)) {
                $this->loadViewsFrom($viewPath, 'site-bases');
                if (!File::exists(base_path(sprintf('resources/views/vendor/site-bases/admin/%s', $module)))) {
                    $this->publishes([
                        $viewPath => base_path(sprintf('resources/views/vendor/site-bases/admin/%s', $module)),
                    ], 'kakhura-site-bases-views');
                }
            }
        }
    }

    protected function publishWebsiteViews()
    {
        foreach (config('kakhura.site-bases.modules_publish_mapper') as $module) {
            $viewPath = __DIR__ . sprintf('/../resources/views/website/client/%s', $module);
            if (File::exists($viewPath)) {
                $this->loadViewsFrom($viewPath, 'site-bases');
                if (!File::exists(base_path(sprintf('resources/views/vendor/site-bases/website/%s', $module)))) {
                    $this->publishes([
                        $viewPath => base_path(sprintf('resources/views/vendor/site-bases/website/%s', $module)),
                    ], 'kakhura-site-bases-views');
                }
            }
        }
        $viewPath = __DIR__ . '/../resources/views/website/client/main';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            $this->publishes([
                $viewPath => base_path('resources/views/vendor/site-bases/website/main'),
            ], 'kakhura-site-bases-views');
        }
        $viewPath = __DIR__ . '/../resources/views/website/layouts';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            if (!File::exists(base_path(sprintf('resources/views/vendor/site-bases/website/layouts')))) {
                $this->publishes([
                    $viewPath => base_path(sprintf('resources/views/vendor/site-bases/website/layouts')),
                ], 'kakhura-site-bases-views');
            }
        }
    }

    protected function publishOtherViews()
    {
        $viewPath = __DIR__ . '/../resources/views/translation-manager';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            if (!File::exists(base_path('resources/views/vendor/translation-manager'))) {
                $this->publishes([
                    $viewPath => base_path('resources/views/vendor/translation-manager'),
                ], 'kakhura-site-bases-views');
            }
        }
        $viewPath = __DIR__ . '/../resources/views/admin/inc';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            if (!File::exists(base_path('resources/views/vendor/site-bases/admin/inc'))) {
                $this->publishes([
                    $viewPath => base_path('resources/views/vendor/site-bases/admin/inc'),
                ], 'kakhura-site-bases-views');
            }
        }
        $viewPath = __DIR__ . '/../resources/views/admin/index.blade.php';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            if (!File::exists(base_path('resources/views/vendor/site-bases/admin/index.blade.php'))) {
                $this->publishes([
                    $viewPath => base_path('resources/views/vendor/site-bases/admin/index.blade.php'),
                ], 'kakhura-site-bases-views');
            }
        }

        $viewPath = __DIR__ . '/../resources/lang/vendor/laravel-filemanager/ka/lfm.php';
        if (File::exists($viewPath)) {
            $this->loadViewsFrom($viewPath, 'site-bases');
            if (!File::exists(base_path('resources/lang/vendor/laravel-filemanager/ka/lfm.php'))) {
                $this->publishes([
                    $viewPath => base_path('resources/lang/vendor/laravel-filemanager/ka/lfm.php'),
                ], 'kakhura-site-bases-views');
            }
        }
    }

    protected function publishMigrations()
    {
        foreach (config('kakhura.site-bases.modules_publish_mapper') as $module) {
            $migrationPath = __DIR__ . sprintf('/../database/migrations/%s', $module);
            if (File::exists($migrationPath) && count(glob(sprintf('database/migrations/*%s*.php', $module))) == 0) {
                $this->publishes([
                    $migrationPath => base_path('database/migrations'),
                ], 'kakhura-site-bases-migrations');
            }
        }
    }
}
