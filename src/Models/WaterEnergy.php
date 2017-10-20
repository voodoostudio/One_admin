<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class WaterEnergy extends Model
{
    protected $table = 'admin_water_energy_type';

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'))->published();
    }
}
