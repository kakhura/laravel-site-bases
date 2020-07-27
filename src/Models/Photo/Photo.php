<?php

namespace Kakhura\LaravelSiteBases\Models\Photo;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Photo extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'photos';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
        'video_image',
    ];

    protected $urlSegment = 'photos';

    public function detail()
    {
        return $this->hasMany(PhotoDetail::class);
    }

    public function images()
    {
        return $this->hasMany(PhotoImage::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
