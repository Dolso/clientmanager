<?php

namespace App;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{

	protected $fillable = [
        'closed', 'answered', 'viewed'
    ];

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

    public function comments()
    {

        return $this->hasMany('App\ApplicationComment', 'application_id');
    }
}
