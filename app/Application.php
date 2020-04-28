<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function comments()
    {

        return $this->hasMany('App\ApplicationComment', 'application_id');
    }
}
