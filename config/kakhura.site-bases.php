<?php

use Kakhura\LaravelSiteBases\Models\Blog\Blog;
use Kakhura\LaravelSiteBases\Models\News\News;
use Kakhura\LaravelSiteBases\Models\Project\Project;
use Kakhura\LaravelSiteBases\Models\Service\Service;
use Kakhura\LaravelSiteBases\Models\Slide\Slide;

return [
    /**
     * Which module's views and migrations do you want to publish.
     */
    'modules_publish_mapper' => [
        'about',
        'contact',
        'blogs',
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

    /**
     * Ordering classes
     */
    'ordering_classes' => [
        'blogs' => Blog::class,
        'slides' => Slide::class,
        'projects' => Project::class,
        'services' => Service::class,
        'news' => News::class,
    ],

    /**
     * Publish classes
     */
    'publish_classes' => [
        'blogs' => Blog::class,
        'slides' => Slide::class,
        'projects' => Project::class,
        'services' => Service::class,
        'news' => News::class,
    ],
];
