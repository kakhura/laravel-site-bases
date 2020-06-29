<?php

namespace Kakhura\LaravelSiteBases\Models\Photo;

use Kakhura\LaravelSiteBases\Models\Base;

class PhotoImage extends Base
{
    protected $table = 'photo_images';

    protected $fillable = [
        'photo_id',
        'image',
        'thumb',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
