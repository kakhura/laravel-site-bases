<?php

namespace Kakhura\LaravelSiteBases\Models\Rule;

use Kakhura\LaravelSiteBases\Models\Base;

class RuleDetail extends Base
{
    protected $table = 'rule_details';

    protected $fillable = [
        'rule_id',
        'title',
        'description',
        'locale',
    ];

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
