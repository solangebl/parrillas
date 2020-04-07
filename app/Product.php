<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'description', 'provider_id', 'category_id', 'thumbnail', 'subcategory_id', 'deposit_id', 'buy_price', 'sale_price',
		'sale_price_ml', 'amount', 'other', 'active'
	];
	
	public function images(){
		return $this->hasMany('App\ProductImage');
	}

	public function provider(){
		return $this->belongsTo('App\Provider');
	}
	
	public function deposit(){
		return $this->belongsTo('App\Deposit');
	}

	public function category(){
		return $this->belongsTo('App\Category');
	}
	
	public function subcategory(){
		return $this->belongsToOne('App\Subcategory');
	}


}
