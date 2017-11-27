<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class Post extends Model
{
    use Translatable;

    protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

    const PUBLISHED = 'PUBLISHED';

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    public function authorId()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'author_id', 'id');
    }

    /**
     * Scope a query to only published scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function vip_users()
    {
        return $this->hasOne(Voyager::modelClass('IndividualView'), 'id', 'vip_users');
    }

    public function category()
    {
        return $this->hasOne(Voyager::modelClass('Category'), 'id', 'category_id');
    }

    public function property_status()
    {
        return $this->hasOne(Voyager::modelClass('Status'), 'reference', 'status_id');
    }

    public function property_mandate()
    {
        return $this->hasOne(Voyager::modelClass('Mandate'), 'reference', 'mandate_id');
    }

    public function property_origin()
    {
        return $this->hasOne(Voyager::modelClass('Origin'), 'reference', 'origin_id');
    }

    public function property_country()
    {
        return $this->hasOne(Voyager::modelClass('Country'), 'reference', 'country');
    }

    public function property_location()
    {
        return $this->hasOne(Voyager::modelClass('Location'), 'reference', 'location');
    }

    public function property_languages()
    {
        return $this->hasOne(Voyager::modelClass('Languages'), 'reference', 'lng_of_add');
    }

    public function property_currency()
    {
        return $this->hasOne(Voyager::modelClass('Currency'), 'reference', 'сurrency');
    }

    public function property_regime()
    {
        return $this->hasOne(Voyager::modelClass('Regime'), 'reference', 'regime');
    }

    public function property_floor()
    {
        return $this->hasOne(Voyager::modelClass('Floor'), 'reference', 'floor_property');
    }

    public function property_type_of_land()
    {
        return $this->hasOne(Voyager::modelClass('TypeOfLand'), 'reference', 'type_land');
    }

    public function property_kitchen()
    {
        return $this->hasOne(Voyager::modelClass('Kitchen'), 'reference', 'type');
    }

    public function property_heating()
    {
        return $this->hasOne(Voyager::modelClass('Heating'), 'reference', 'format');
    }

    public function property_energy()
    {
        return $this->hasOne(Voyager::modelClass('Energy'), 'reference', 'chauffage_energy');
    }

    public function property_heating_type()
    {
        return $this->hasOne(Voyager::modelClass('HeatingType'), 'reference', 'type_heating');
    }

    public function property_radiator()
    {
        return $this->hasOne(Voyager::modelClass('Radiator'), 'reference', 'type_radiator');
    }

    public function property_water_distribution()
    {
        return $this->hasOne(Voyager::modelClass('WaterDistribution'), 'reference', 'distribution');
    }

    public function property_water_energy()
    {
        return $this->hasOne(Voyager::modelClass('WaterEnergy'), 'reference', 'eau_chaude_energy');
    }

    public function property_waste_distribution()
    {
        return $this->hasOne(Voyager::modelClass('WasteDistribution'), 'reference', 'usees_distribution');
    }

    public function property_minergie()
    {
        return $this->hasOne(Voyager::modelClass('Minergie'), 'reference', 'divers_format');
    }

    public function property_sonority()
    {
        return $this->hasOne(Voyager::modelClass('Sonority'), 'reference', 'sonority');
    }

    public function property_style()
    {
        return $this->hasOne(Voyager::modelClass('Style'), 'reference', 'style');
    }

    public function property_interior_condition()
    {
        return $this->hasOne(Voyager::modelClass('State'), 'reference', 'interior_condition');
    }

    public function property_construction()
    {
        return $this->hasOne(Voyager::modelClass('Construction'), 'reference', 'type_construction');
    }

    public function property_state_front()
    {
        return $this->hasOne(Voyager::modelClass('State'), 'reference', 'state_front');
    }

    public function property_external_state()
    {
        return $this->hasOne(Voyager::modelClass('State'), 'reference', 'external_state');
    }

//    public function property_address()
//    {
//        return $this->belongsTo(Voyager::modelClass('Address'), 'property_id');
//    }

    /**
     *   Method for returning specific thumbnail for post.
     */
    public function thumbnail($type)
    {
        // We take image from posts field
        $image = $this->attributes['image'];
        // We need to get extension type ( .jpeg , .png ...)
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        // We remove extension from file name so we can append thumbnail type
        $name = rtrim($image, '.'.$ext);
        // We merge original name + type + extension
        return $name.'-'.$type.'.'.$ext;
    }
}
