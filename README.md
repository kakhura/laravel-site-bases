## kakhura/laravel-site-bases

### Docs
* [Installation](#installation)
* [Configuration (Config based management)](#configuration)
* [Views](#views)
* [Migrations](#migrations)

## Installation
Add the package in your composer.json by executing the command.

```bash
composer require kakhura/laravel-site-bases
```

For Laravel versions before 5.5 or if not using **auto-discovery**, register the service provider in `config/app.php`

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    \Kakhura\LaravelSiteBases\SiteBasesServiceProvider::class,
],
```


## Configuration

If you want to change ***default configuration***, you must publish default configuration file to your project by running this command in console:
```bash
php artisan vendor:publish --tag=kakhura-site-bases-config
```

This command will copy file `[/vendor/kakhura/laravel-site-bases/config/kakhura.site-basbes.php]` to `[/config/kakhura.site-basbes.php]`

Default `kakhura.site-basbes.php` looks like:
```php
return [
    /**
     * Which module's views and migrations do you want to publish.
     */
    'modules_publish_mapper' => [
        'about',
        'contact',
        'blog',
        'slides',
        'projects',
        'services',
        'news',
    ],
    /**
     * Generate thumbs.
     */
    'images_thumbs' => [
        'generate_thumb_for_images' => true,
        'thumb_width' => 400,
        'thumb_height' => null,
    ],
    /**
     * Add watermark.
     */
    'images_watermark' => [
        'add_watermark_to_images' => false,
        'watermark_path' => public_path('watermark.png'),
        'watermark_position' => 'bottom-left', // http://image.intervention.io/api/insert
        'watermark_x' => 20,
        'watermark_y' => 20,
    ],
    /**
     * Admin languages active tab.
     */
    'admin_editors_default_locale' => 'ka',
];
```
## Views
After publish [Configuration](#configuration), you must publish **views**, by running this command in console:
```bash
php artisan vendor:publish --tag=kakhura-site-bases-views
```

This command will copy file `[/vendor/kakhura/laravel-site-bases/resources/views]` to `[/resources/views/vendor/admin/site-bases]`

## Migrations
After publish [Views](#views), you must publish **migrations**, by running this command in console:
```bash
php artisan vendor:publish --tag=kakhura-site-bases-migrations
```

This command will copy file `[/vendor/kakhura/laravel-site-bases/database/migrations]` to `[/database/migrations]`
