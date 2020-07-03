<?php

namespace Kakhura\LaravelSiteBases\Models\Category;

use Kakhura\LaravelSiteBases\Models\Base;

class CategoryDetail extends Base
{
    protected $table = 'category_details';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'locale',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
