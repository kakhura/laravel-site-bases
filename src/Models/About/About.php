<?php

namespace Kakhura\LaravelSiteBases\Models\About;

use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class About extends Base
{
    use ForDetail;

    public function __construct()
    {
        $this->connection = config(sprintf('kakhura.site-bases.models_connection_mapper.%s', self::class));
    }

    protected $table = 'abouts';

    protected $fillable = [
        'image',
        'thumb',
        'video',
        'video_image',
    ];

    public function detail()
    {
        return $this->hasMany(AboutDetail::class);
    }
}
