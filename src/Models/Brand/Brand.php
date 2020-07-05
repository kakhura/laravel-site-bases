<?php

namespace Kakhura\LaravelSiteBases\Models\Brand;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Brand extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'brands';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
    ];

    protected $urlSegment = 'brands';

    public function detail()
    {
        return $this->hasMany(BrandDetail::class);
    }
}
