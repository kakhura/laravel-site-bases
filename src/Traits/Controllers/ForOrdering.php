<?php

namespace Kakhura\LaravelSiteBases\Traits\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait ForOrdering
{
    public function ordering(Request $request)
    {
        $className = $request->get('className');
        foreach (json_decode($request->ordering) as $value) {
            $object = $className::find(Arr::get($value, 0));
            $object->update([
                'ordering' => $value[1],
            ]);
        }
    }
}
