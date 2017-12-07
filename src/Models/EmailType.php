<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class EmailType extends Model
{
    protected $table = 'admin_emails';

//    public function posts()
//    {
//        return $this->hasMany(Voyager::modelClass('User'))->published();
//    }
}
