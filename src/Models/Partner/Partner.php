<?php

namespace Kakhura\LaravelSiteBases\Models\Partner;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;
use Kakhura\LaravelSiteBases\Traits\Models\ForUrl;

class Partner extends Base
{
    use SoftDeletes, ForDetail, ForUrl;

    protected $table = 'partners';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'thumb',
        'video',
        'link',
    ];

    protected $urlSegment = 'partners';

    public function detail()
    {
        return $this->hasMany(PartnerDetail::class);
    }
}
