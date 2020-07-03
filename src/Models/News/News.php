<?php

namespace Kakhura\LaravelSiteBases\Models\News;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class News extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'news';

    protected $fillable = [
        'photo_id',
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
    ];

    protected $urlSegment = 'news';

    public function detail()
    {
        return $this->hasMany(NewsDetail::class);
    }

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }
}
