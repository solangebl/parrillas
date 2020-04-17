<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'information',
	];
	
	public function products(){
		return $this->hasMany('App\Product');
	}

}
