<?php

use Kakhura\LaravelSiteBases\Models\Blog\Blog;
use Kakhura\LaravelSiteBases\Models\News\News;
use Kakhura\LaravelSiteBases\Models\Page\Page;
use Kakhura\LaravelSiteBases\Models\Brand\Brand;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;
use Kakhura\LaravelSiteBases\Models\Slide\Slide;
use Kakhura\LaravelSiteBases\Models\Video\Video;
use Kakhura\LaravelSiteBases\Models\Partner\Partner;
use Kakhura\LaravelSiteBases\Models\Product\Product;
use Kakhura\LaravelSiteBases\Models\Project\Project;
use Kakhura\LaravelSiteBases\Models\Service\Service;
use Kakhura\LaravelSiteBases\Models\Category\Category;

return [
    /**
     * Which module's views and migrations do you want to publish.
     */
    'modules_publish_mapper' => [
        'about',
        'rules',
        'contact',
        'blogs',
        'slides',
        'projects',
        'services',
        'news',
        'admins',
        'videos',
        'products',
        'categories',
        'photos',
        'pages',
        'partners',
        'brands',
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
        'photos' => Photo::class,
        'products' => Product::class,
        'categories' => Category::class,
        'pages' => Page::class,
        'partners' => Partner::class,
        'brands' => Brand::class,
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
        'photos' => Photo::class,
        'products' => Product::class,
        'categories' => Category::class,
        'pages' => Page::class,
        'partners' => Partner::class,
        'brands' => Brand::class,
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
        'pages' => [
            'url' => env('APP_URL') . '/admin/pages',
            'title' => 'დინამიური გვერდები',
            'icon' => '<i class="fa fa-file-text-o"></i>',
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
                'categories' => [
                    'url' => env('APP_URL') . '/admin/categories',
                    'title' => 'კატეგორიები',
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
        'photos' => [
            'url' => env('APP_URL') . '/admin/photos',
            'title' => 'ფოტო გალერეა',
            'icon' => '<i class="fa fa fa-picture-o" aria-hidden="true"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'partners' => [
            'url' => env('APP_URL') . '/admin/partners',
            'title' => 'პარტნიორები',
            'icon' => '<i class="fa fa-handshake-o" aria-hidden="true"></i>',
            'arrow-icon' => '<span class="fa fa-chevron-right"></span>',
        ],
        'brands' => [
            'url' => env('APP_URL') . '/admin/brands',
            'title' => 'ბრენდები',
            'icon' => '<i class="fa fa-money" aria-hidden="true"></i>',
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
        'rules' => [
            'title' => 'წესები და პირობები',
            'link' => env('APP_URL') . '/admin/pages/edit/rules',
        ],
        'contact' => [
            'title' => 'კონტაქტი',
            'link' => env('APP_URL') . '/admin/pages/edit/contact',
        ],
    ],
];
