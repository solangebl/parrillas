<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductImage;

use Lang;

use App\Mail\Contacto;

use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		return view('front.index', [
			'categories' => Category::all(),
			'products' => Product::all(),
		]);
	}

	public function product($id) {
		
		return view('front.product', [
			'product' => Product::find($id),
			'images' => ProductImage::where('product_id', $id)->orderBy('order')->get(),
		]);
	}

	public function help(){
		return view('front.help');
	}

	/*
	public function contact_send(Request $request)
    {

        Mail::to(['info@kilak.com'])->send(new Contacto($request));
        // Mail::to(['solange.blundi@gmail.com','info@kilak.com'])->send(new Contacto($request));

        return redirect('/'. App::getLocale() );
	}
	*/
}
