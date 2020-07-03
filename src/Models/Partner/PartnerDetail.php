<?php

namespace Kakhura\LaravelSiteBases\Models\Partner;

use Kakhura\LaravelSiteBases\Models\Base;

class PartnerDetail extends Base
{
    protected $table = 'partner_details';

    protected $fillable = [
        'partner_id',
        'title',
        'description',
        'locale',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
