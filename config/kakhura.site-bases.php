<?php

use Kakhura\LaravelSiteBases\Models\Blog\Blog;
use Kakhura\LaravelSiteBases\Models\Brand\Brand;
use Kakhura\LaravelSiteBases\Models\Category\Category;
use Kakhura\LaravelSiteBases\Models\News\News;
use Kakhura\LaravelSiteBases\Models\Page\Page;
use Kakhura\LaravelSiteBases\Models\Partner\Partner;
use Kakhura\LaravelSiteBases\Models\Photo\Photo;
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
     * Which module's routes must done.
     */
    'routes_mapper' => [
        'about' => [
            'main_method_name' => 'about',
            'namespace' => 'About',
            'controller' => 'AboutController',
            'main_url' => 'about',
        ],
        'rules' => [
            'main_method_name' => 'rules',
            'namespace' => 'Rule',
            'controller' => 'RuleController',
            'main_url' => 'rules',
        ],
        'contact' => [
            'main_method_name' => 'contact',
            'namespace' => 'Contact',
            'controller' => 'ContactController',
            'main_url' => 'contact',
        ],
        'blogs' => [
            'main_method_name' => 'blogs',
            'namespace' => 'Blog',
            'controller' => 'BlogController',
            'item_method_name' => 'blog',
            'main_url' => 'blogs',
            'item_url' => 'blog',
        ],
        'projects' => [
            'main_method_name' => 'projects',
            'namespace' => 'Project',
            'controller' => 'ProjectController',
            'item_method_name' => 'project',
            'main_url' => 'projects',
            'item_url' => 'project',
        ],
        'services' => [
            'main_method_name' => 'services',
            'namespace' => 'Service',
            'controller' => 'ServiceController',
            'item_method_name' => 'service',
            'main_url' => 'services',
            'item_url' => 'service',
        ],
        'news' => [
            'main_method_name' => 'news',
            'namespace' => 'News',
            'controller' => 'NewsController',
            'item_method_name' => 'news_in',
            'main_url' => 'news',
            'item_url' => 'news',
        ],
        'videos' => [
            'main_method_name' => 'videos',
            'namespace' => 'Video',
            'controller' => 'VideoController',
            'item_method_name' => 'video',
            'main_url' => 'videos',
        ],
        'products' => [
            'main_method_name' => 'products',
            'namespace' => 'Product',
            'controller' => 'ProductController',
            'item_method_name' => 'product',
            'main_url' => 'products',
            'item_url' => 'product',
        ],
        'photos' => [
            'main_method_name' => 'photos',
            'namespace' => 'Photo',
            'controller' => 'PhotoController',
            'item_method_name' => 'photo',
            'main_url' => 'photos',
            'item_url' => 'photo',
        ],
        'pages' => [
            'main_method_name' => 'pages',
            'namespace' => 'Page',
            'controller' => 'PageController',
            'item_method_name' => 'page',
            'main_url' => 'pages',
            'item_url' => 'page',
        ],
        'partners' => [
            'main_method_name' => 'partners',
            'namespace' => 'Partner',
            'controller' => 'PartnerController',
            'item_method_name' => 'partner',
            'main_url' => 'partners',
            'item_url' => 'partner',
        ],
        'brands' => [
            'main_method_name' => 'brands',
            'namespace' => 'Brand',
            'controller' => 'BrandController',
            'item_method_name' => 'brand',
            'main_url' => 'brands',
            'item_url' => 'brand',
        ],
    ],

    /**
     * Which module's pagination number.
     */
    'pagination_mapper' => [
        'blogs' => 15,
        'projects' => 15,
        'services' => 15,
        'news' => 15,
        'videos' => 15,
        'products' => 15,
        'photos' => 15,
        'pages' => 15,
        'partners' => 15,
        'brands' => 15,
    ],

    /**
     * Publish website views.
     */
    'publish_website_views' => true,

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
     * Change width of image.
     */
    'max_image_width' => 2000, // in px

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
            'icon' => '<i class="fa fa-suitcase" aria-hidden="true"></i>',
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

    /**
     * Admin pages menu
     */
    'contact_socials' => [
        'facebook',
    ],

    /**
     * Use two type users
     */
    'use_two_type_users' => true,

    /**
     * Use Georgian letter into category url
     */
    'use_georgian_letters_into_category_url' => false,

    /**
     * Modules photo positions
     */
    'modules_photo_positions' => [
        'news' => [
            'top',
            'middle',
            'bottom',
        ],
    ],
];
