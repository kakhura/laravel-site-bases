<?php

namespace Kakhura\LaravelSiteBases\Models\Page;

use Kakhura\LaravelSiteBases\Models\Base;

class PageDetail extends Base
{
    protected $table = 'page_details';

    protected $fillable = [
        'page_id',
        'title',
        'description',
        'locale',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
