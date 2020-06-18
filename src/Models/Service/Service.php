<?php

namespace Kakhura\LaravelSiteBases\Models\Service;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Service extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'services';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
    ];

    protected $urlSegment = 'services';

    public function detail()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
