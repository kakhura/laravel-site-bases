<?php

namespace Kakhura\LaravelSiteBases\Models\News;

use Kakhura\LaravelSiteBases\Models\Base;

class NewsDetail extends Base
{
    protected $table = 'news_details';

    protected $fillable = [
        'news_id',
        'title',
        'description',
        'locale',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
