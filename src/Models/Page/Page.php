<?php

namespace Kakhura\LaravelSiteBases\Models\Page;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Page extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'pages';

    protected $fillable = [
        'in_main_menu',
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
        'video_image',
    ];

    protected $urlSegment = 'pages';

    public function detail()
    {
        return $this->hasMany(PageDetail::class);
    }

    public function images()
    {
        return $this->hasMany(PageImage::class);
    }
}
