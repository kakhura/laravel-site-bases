<?php
namespace Kakhura\LaravelSiteBases\Models\Video;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Video extends Base
{
    use SoftDeletes, ForDetail;

    protected $table = 'videos';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video_url',
    ];

    public function detail()
    {
        return $this->hasMany(VideoDetail::class);
    }
}
