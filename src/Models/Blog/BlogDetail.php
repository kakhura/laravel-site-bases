<?php

namespace Kakhura\LaravelSiteBases\Models\Blog;

use Kakhura\LaravelSiteBases\Models\Base;

class BlogDetail extends Base
{
    protected $table = 'blog_details';

    protected $fillable = [
        'blog_id',
        'title',
        'description',
        'description_min',
        'locale',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
