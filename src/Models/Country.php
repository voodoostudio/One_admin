<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Country extends Model
{
    protected $table = 'admin_country';

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'))->published();
    }
}
