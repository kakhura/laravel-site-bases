<?php

namespace Kakhura\LaravelSiteBases\Models\Service;

use Kakhura\LaravelSiteBases\Models\Base;

class ServiceDetail extends Base
{
    protected $table = 'service_details';

    protected $fillable = [
        'service_id',
        'title',
        'description',
        'locale',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
