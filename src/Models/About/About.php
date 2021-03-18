<?php

namespace Kakhura\LaravelSiteBases\Models\About;

use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class About extends Base
{
    use ForDetail;

    protected $table = 'abouts';

    protected $fillable = [
        'image',
        'thumb',
        'video',
        'video_image',
    ];

    public function detail()
    {
        return $this->hasMany(AboutDetail::class);
    }
}
