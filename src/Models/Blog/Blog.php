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
        'photo_id',
        'published',
        'published_at',
        'ordering',
        'image',
        'thumb',
        'video',
        'video_image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
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

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
