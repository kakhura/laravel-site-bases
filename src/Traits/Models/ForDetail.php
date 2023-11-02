<?php

namespace Kakhura\LaravelSiteBases\Traits\Models;

trait ForDetail
{
    public function getTitleAttribute()
    {
        return $this->detail->first() ? $this->detail->first()->title : '';
    }

    public function getDescriptionAttribute()
    {
        return $this->detail->first() ? $this->detail->first()->description : '';
    }

    public function getDescriptionMinAttribute()
    {
        return $this->detail->first() ? $this->detail->first()->description_min : '';
    }

    public function getAddressAttribute()
    {
        return $this->detail->first() ? $this->detail->first()->address : '';
    }
}
