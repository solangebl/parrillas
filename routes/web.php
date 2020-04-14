<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', 'FrontendController@index');
    Route::get('/product/{id}', 'FrontendController@project')->name('product.view');
    Route::get('/products/{cat_slug}', 'FrontendController@products')->name('product.list');
    Route::get('/product/{id}', 'FrontendController@product')->name('product.view');
    Route::post('/search', 'FrontendController@search')->name('products.search');
    Route::get('/ayuda', 'FrontendController@help')->name('help');
    /*
    Route::get('/', function(){
      return view('soon');
    });
    */
    /*
    Route::get('/content/{page}', function ($locale, $page) {
      App::setLocale($locale);
      return view('front.'.$locale.'.'.$page);
    */
	//});
    

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
	Route::get('/', 'HomeController@index')->name('admin.index');
	Route::resource('providers', 'ProviderController');
	Route::resource('deposits', 'DepositController');
	Route::resource('categories', 'CategoryController');
	Route::resource('products', 'ProductController');
	Route::delete('/products/destroyImage/{imageId}', 'ProductController@destroyImage')->name('products.destroyImage');
	Route::put('/products/quickUpdate/{id}', 'ProductController@quickUpdate')->name('products.quickUpdate');
	Route::delete('/categories/destroySubcat/{subcatId}', 'CategoryController@destroySubcat')->name('categories.destroySubcat');
	
	Route::get('/home', 'HomeController@index')->name('home');
  
});



Auth::routes();