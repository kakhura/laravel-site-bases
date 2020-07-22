<?php

namespace Kakhura\LaravelSiteBases\Models\Contact;

use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Contact extends Base
{
    use ForDetail;

    protected $table = 'contacts';

    protected $guarded = [
        'id',
    ];

    public function detail()
    {
        return $this->hasMany(ContactDetail::class);
    }
}
