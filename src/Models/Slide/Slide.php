<?php
namespace Kakhura\LaravelSiteBases\Models\Slide;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Slide extends Base
{
    use SoftDeletes, ForDetail;

    protected $table = 'slides';

    protected $fillable = [
        'published',
        'ordering',
        'image',
        'link',
    ];

    public function detail()
    {
        return $this->hasMany(SlideDetail::class);
    }
}
