<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id' 
	];
	
	public function category(){
		return $this->belongsToOne('App\Category');
	}
    
    public function products(){
		return $this->hasMany('App\Product');
	}

}
