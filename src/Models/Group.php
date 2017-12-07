<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Group extends Model
{
    protected $table = 'admin_group';

//    public function posts()
//    {
//        return $this->hasMany(Voyager::modelClass('Users'))->published();
//    }
}
