<?php

namespace Kakhura\LaravelSiteBases\Models\Product;

use Kakhura\LaravelSiteBases\Models\Base;

class ProductImage extends Base
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image',
        'thumb',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
