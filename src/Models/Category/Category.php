<?php
namespace Kakhura\LaravelSiteBases\Models\Category;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kakhura\LaravelSiteBases\Models\Base;
use Kakhura\LaravelSiteBases\Traits\Models\ForDetail;

class Category extends Base
{
    use SoftDeletes, ForDetail;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'published',
        'ordering',
        'image',
        'thumb',
    ];

    public function detail()
    {
        return $this->hasMany(CategoryDetail::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->orderBy('ordering', 'asc');
    }
}
