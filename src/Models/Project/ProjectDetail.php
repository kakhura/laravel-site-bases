<?php

namespace Kakhura\LaravelSiteBases\Models\Project;

use Kakhura\LaravelSiteBases\Models\Base;

class ProjectDetail extends Base
{
    protected $table = 'project_details';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'locale',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
