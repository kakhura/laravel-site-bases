<?php

namespace Kakhura\LaravelSiteBases\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config(sprintf('kakhura.site-bases.models_connection_mapper.%s', get_called_class()), 'mysql'));
    }
}
