<?php

namespace Kakhura\LaravelSiteBases\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Base extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(config(sprintf('kakhura.site-bases.models_connection_mapper.%s', get_called_class()), 'mysql'));
    }

    public static function boot()
    {
        static::updating(function (self $model) {
            if ($model->isDirty('ordering') && !Str::contains(url()->current(), 'ordering')) {
                $model->update([
                    'ordering' => 0,
                ]);
            }
        });
        parent::boot();
    }
}
