<?php

namespace Kakhura\LaravelSiteBases\Models\Product;

use Kakhura\LaravelSiteBases\Models\Base;

class ProductDetail extends Base
{
    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'title',
        'description',
        'locale',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
