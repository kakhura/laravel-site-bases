<?php

namespace Kakhura\LaravelSiteBases\Models\Rule;

use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Rule extends Base
{
    use ForDetail;

    protected $table = 'rules';

    protected $fillable = [
        'image',
        'thumb',
        'video',
    ];

    public function detail()
    {
        return $this->hasMany(RuleDetail::class);
    }
}
