<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Construction extends Model
{
    protected $table = 'admin_construction_material_type';

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'))->published();
    }
}
