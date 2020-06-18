<?php

namespace Kakhura\LaravelSiteBases\Models\Contact;

use Kakhura\LaravelSiteBases\Models\Base;

class ContactDetail extends Base
{
    protected $table = 'contact_details';

    protected $fillable = [
        'contact_id',
        'address',
        'description',
        'locale',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
