<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public $fillable = ['title','description'];

     protected $geofields = array('location');
 
 
    public function setLocationAttribute($value) {
        $this->attributes['location'] = \DB::raw("POINT($value)");
    }
 
    public function getLocationAttribute($value){
 
        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);
 
        return substr($loc,0,-1);
    }
 
    public function newQuery($excludeDeleted = true)
    {
        $raw='';
        foreach($this->geofields as $column){
            $raw .= ' astext('.$column.') as '.$column.' ';
        }
 
        return parent::newQuery($excludeDeleted)->addSelect('*', \DB::raw($raw));
    }
    public function scopeDistance($query,$dist,$location)
    {
        return $query->whereRaw('st_distance(location,POINT('.$location.')) < '.$dist);
 
    }
}
