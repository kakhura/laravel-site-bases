<?php

namespace Kakhura\LaravelSiteBases\Models\Blog;

use Kakhura\LaravelSiteBases\Models\Base;

class BlogImage extends Base
{
    protected $table = 'blog_images';

    protected $fillable = [
        'blog_id',
        'image',
        'thumb',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
