<?php

namespace Kakhura\LaravelSiteBases\Models\About;

use Kakhura\LaravelSiteBases\Models\Base;

class AboutDetail extends Base
{
    protected $table = 'about_details';

    protected $fillable = [
        'about_id',
        'title',
        'description',
        'locale',
    ];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'description',
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
