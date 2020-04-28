<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationComment extends Model
{
    public function application()
    {
        // Принадлежит пользователю
        // belongsTo определяется у модели содержащей внешний ключ
        return $this->belongsTo('App\User');
    }
}
