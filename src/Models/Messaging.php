<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Messaging extends Model
{
    protected $table = 'admin_messaging';

//    public function posts()
//    {
//        return $this->hasMany(Voyager::modelClass('Users'))->published();
//    }
}
