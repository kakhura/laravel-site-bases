<?php

namespace Kakhura\LaravelSiteBases\Models\Photo;

use Kakhura\LaravelSiteBases\Models\Base;

class PhotoDetail extends Base
{
    protected $table = 'photo_details';

    protected $fillable = [
        'photo_id',
        'title',
        'description',
        'locale',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
