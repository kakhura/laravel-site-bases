<?php

namespace Kakhura\LaravelSiteBases\Models\Slide;

use Kakhura\LaravelSiteBases\Models\Base;

class SlideDetail extends Base
{
    protected $table = 'slide_details';

    protected $fillable = [
        'slide_id',
        'title',
        'description',
        'locale',
    ];

    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }
}
