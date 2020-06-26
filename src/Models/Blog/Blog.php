<?php

namespace Kakhura\LaravelSiteBases\Models\Blog;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Blog extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'blogs';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
    ];

    protected $urlSegment = 'blogs';

    public function detail()
    {
        return $this->hasMany(BlogDetail::class);
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
}
