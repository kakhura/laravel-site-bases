<?php

namespace Kakhura\LaravelSiteBases\Models\Category;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kakhura\LaravelSiteBases\Helpers\Helper;
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

    public function getUrlAttribute()
    {
        if (config('kakhura.site-bases.use_georgian_letters_into_category_url')) {
            return $this->withoutSlugify();
        }
        return $this->withSlugify();
    }

    /**
     * This method returns link without slugifyed title.
     *
     * @return string
     */
    protected function withoutSlugify(): string
    {
        if ($this->parent) {
            return url(sprintf('%s-%s/%s-%s', $this->parent_id, Helper::sanitize($this->parent->title), $this->id, Helper::sanitize($this->title)));
        }
        return url(sprintf('%s-%s', $this->id, Helper::sanitize($this->title)));
    }

    /**
     * This method returns link with slugifyed title.
     *
     * @return string
     */
    protected function withSlugify(): string
    {
        if ($this->parent) {
            return url(sprintf('%s-%s/%s-%s', $this->parent_id, Str::slug($this->parent->title), $this->id, Str::slug($this->title)));
        }
        return url(sprintf('%s-%s', $this->id, Str::slug($this->title)));
    }
}
