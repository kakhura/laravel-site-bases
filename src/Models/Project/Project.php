<?php

namespace Kakhura\LaravelSiteBases\Models\Project;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Project extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'projects';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
    ];

    protected $urlSegment = 'projects';

    public function detail()
    {
        return $this->hasMany(ProjectDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
