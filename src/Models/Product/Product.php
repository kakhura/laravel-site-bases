<?php

namespace Kakhura\LaravelSiteBases\Models\Product;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Product extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
        'video_image',
        'price',
        'discounted_price',
    ];

    protected $urlSegment = 'products';

    public function detail()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
