<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{

    use SoftDeletes;

    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_job', 'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
