<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Energy extends Model
{
    protected $table = 'admin_fuel_type';

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'))->published();
    }
}
