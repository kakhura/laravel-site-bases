<?php

namespace Kakhura\LaravelSiteBases\Models\Project;

use Kakhura\LaravelSiteBases\Models\Base;

class ProjectImage extends Base
{
    protected $table = 'project_images';

    protected $fillable = [
        'project_id',
        'image',
        'thumb',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
