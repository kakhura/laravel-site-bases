<?php

namespace Kakhura\LaravelSiteBases\Models\Video;

use Kakhura\LaravelSiteBases\Models\Base;

class VideoDetail extends Base
{
    protected $table = 'video_details';

    protected $fillable = [
        'video_id',
        'title',
        'locale',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
