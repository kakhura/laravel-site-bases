<?php

use Kakhura\LaravelSiteBases\Models\Blog\Blog;
use Kakhura\LaravelSiteBases\Models\News\News;
use Kakhura\LaravelSiteBases\Models\Product\Product;
use Kakhura\LaravelSiteBases\Models\Project\Project;
use Kakhura\LaravelSiteBases\Models\Service\Service;
use Kakhura\LaravelSiteBases\Models\Slide\Slide;
use Kakhura\LaravelSiteBases\Models\Video\Video;

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
        'admins',
        'videos',
        'products',
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
        'videos' => Video::class,
        'products' => Product::class,
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
        'videos' => Video::class,
        'products' => Product::class,
    ],

    /**
     * Admin sidebar menu
     */
    'sidebar_modules' => [
        'slides' => [
            'url' => env('APP_URL') . '/admin/slides',
            'title' => 'სლაიდერი',
            'icon' => '<i class="fa fa-sliders"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'products' => [
            'title' => 'პროდუქცია',
            'icon' => '<i class="fa fa-product-hunt"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-down"></span>',
            'children' => [
                'products' => [
                    'url' => env('APP_URL') . '/admin/products',
                    'title' => 'პროდუქცია',
                ],
            ],
        ],
        'projects' => [
            'url' => env('APP_URL') . '/admin/projects',
            'title' => 'პროექტები',
            'icon' => '<i class="fa fa-product-hunt"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'blogs' => [
            'url' => env('APP_URL') . '/admin/blogs',
            'title' => 'ბლოგი',
            'icon' => '<i class="fa fa-file-text-o"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'news' => [
            'url' => env('APP_URL') . '/admin/news',
            'title' => 'სიახლეები',
            'icon' => '<i class="fa fa-file-text-o"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'services' => [
            'url' => env('APP_URL') . '/admin/services',
            'title' => 'სერვისები',
            'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'videos' => [
            'url' => env('APP_URL') . '/admin/videos',
            'title' => 'ვიდეო გალერეა',
            'icon' => '<i class="fa fa-file-video-o" aria-hidden="true"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
    ],

    /**
     * Admin pages menu
     */
    'pages_menu' => [
        'about' => [
            'title' => 'ჩვენ შესახებ',
            'link' => env('APP_URL') . '/admin/pages/edit/about',
        ],
        'contact' => [
            'title' => 'კონტაქტი',
            'link' => env('APP_URL') . '/admin/pages/edit/contact',
        ],
    ],
];
