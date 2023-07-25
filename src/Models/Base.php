<?php

namespace Kakhura\LaravelSiteBases\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Base extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config(sprintf('kakhura.site-bases.models_connection_mapper.%s', get_called_class()), 'mysql'));
    }
}
