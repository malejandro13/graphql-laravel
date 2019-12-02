<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_category', 'category_parent_id',
    ];

    //each category might have one parent
    public function parent() : BelongsTo
    {
        return $this->belongsTo(static::class, 'category_parent_id');
    }

  //each category might have multiple children
    public function childrens() : HasMany
    {
        return $this->hasMany(static::class, 'category_parent_id')->orderBy('name_category', 'asc');
    }
}
