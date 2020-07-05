<?php

namespace Kakhura\LaravelSiteBases\Models\Brand;

use Kakhura\LaravelSiteBases\Models\Base;

class BrandDetail extends Base
{
    protected $table = 'brand_details';

    protected $fillable = [
        'brand_id',
        'title',
        'description',
        'locale',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
