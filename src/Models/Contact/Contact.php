<?php

namespace Kakhura\LaravelSiteBases\Models\Contact;

use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Contact extends Base
{
    use ForDetail;

    protected $table = 'contacts';

    protected $guarded = [
        'phone',
        'email',
        'long',
        'lat',
        'facebook',
        'other_socials',
    ];

    protected $casts = [
        'other_socials' => 'array',
    ];

    public function detail()
    {
        return $this->hasMany(ContactDetail::class);
    }
}
