<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

	public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'image', 'order'
	];
	
	public function product(){
		return $this->belongsTo('App\Product');
	}

}
