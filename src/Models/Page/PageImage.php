<?php

namespace Kakhura\LaravelSiteBases\Models\Page;

use Kakhura\LaravelSiteBases\Models\Base;

class PageImage extends Base
{
    protected $table = 'page_images';

    protected $fillable = [
        'page_id',
        'image',
        'thumb',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
