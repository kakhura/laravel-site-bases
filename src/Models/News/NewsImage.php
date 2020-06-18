<?php

namespace Kakhura\LaravelSiteBases\Models\News;

use Kakhura\LaravelSiteBases\Models\Base;

class NewsImage extends Base
{
    protected $table = 'news_images';

    protected $fillable = [
        'news_id',
        'image',
        'thumb',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
