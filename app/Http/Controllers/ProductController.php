<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Provider;
use App\Deposit;
use App\Category;
use App\Subcategory;
use App\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		return view('products.index', [
			'products' => Product::all()
		]);
	}

	public function create(){
		return view('products.add', [
			'providers' => Provider::orderBy('name', 'asc')->get(),
			'deposits' => Deposit::orderBy('name', 'asc')->get(),
			'categories' => Category::with('subcategories')->orderBy('name', 'asc')->get(),
		]);
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		$rules = [
			'provider_id' => 'required',
			'thumbnail' => 'required|image|mimes:jpg,jpeg,bmp,png|max:5000',
			'description' => 'required',
			'category_id' => 'required',
			'name' => 'required',
		];
		//print_r($request->all()); die;
		$images = isset($request->images) ? count($request->images) : 0;
		if(!empty($request->input('images')[0])){
			foreach(range(0, $images) as $index){
			$rules['images.'. $index] = 'image|mimes:jpg,jpeg,bmp,png|max:5000';
			}
		}
		$validatedData = $request->validate($rules);

		$product = Product::create([
			'name' => $request->input('name'),
			'provider_id' => $request->input('provider_id'),
			'description' => $request->input('description'),
			'other' => $request->input('other'),
			'category_id' => $request->input('category_id'),
			'subcategory_id' => $request->input('subcategory_id'),
			'deposit_id' => $request->input('deposit_id'),
			'provider_id' => $request->input('provider_id'),
			'buy_price' => $request->input('buy_price'),
			'sale_price' => $request->input('sale_price'),
			'sale_price_ml' => $request->input('sale_price_ml'),
			'amount' => $request->input('amount'),
		]);
		
		if(!empty($request->thumbnail)){
			$image = $request->thumbnail;
			$originalName = $image->getClientOriginalName();
			print_r($originalName);
			$path = $image->storeAs('products/'. $product->id .'/thumbnail', $originalName);
		
			$product->thumbnail = $originalName;
			$product->save();
		}

		if($images>0){
			$i = 0;
			foreach($request->images as $image){
				if(!empty($image)){
					$originalName = $image->getClientOriginalName();
					$path = $image->storeAs('products/'. $product->id, $originalName);
		  
					$articleImage = ProductImage::create([
						'product_id' => $product->id,
						'image' => $originalName,
					]);
					$i++;
				}
			}
		}
		
		return redirect('/admin/products');
	}

	public function edit($id){
		$product = Product::find($id);

		return view('products.edit', [
			'product' => $product,
			'images' => Product::find($id)->get(),
			'providers' => Provider::orderBy('name', 'asc')->get(),
			'deposits' => Deposit::orderBy('name', 'asc')->get(),
			'categories' => Category::with('subcategories')->orderBy('name', 'asc')->get(),
		]);
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
		//print_r($request->all()); die;
		$rules = [
			'description' => 'required',
			'name' => 'required',
		];
		$images = isset($request->images) ? count($request->images) : 0;
		if(!empty($request->input('images')[0])){
			foreach(range(0, $images) as $index){
			  $rules['images.'. $index] = 'image|mimes:jpg,jpeg,bmp,png|max:5000';
			}
		}
		if (isset($request->thumbnail)) {
			$rules['thumbnail'] = 'image|mimes:jpg,jpeg,bmp,png|max:5000';
		}
		$validatedData = $request->validate($rules);

		$product = Product::find($id);
		$product->fill($request->all());

		if ($images>0) {
			$i = count($product->images);
			foreach($request->images as $image){
			  if(!empty($image)){
				$originalName = $image->getClientOriginalName();
				$path = $image->storeAs('products/'. $product->id, $originalName);
	  
				$productImage = ProductImage::create([
				  'product_id' => $product->id,
				  'image' => $originalName,
				  'order' => $i,
				]);
				$i++;
			  }
			}
		}
		if(!empty($request->thumbnail)){
			$image = $request->thumbnail;
			print_r($image);
			$originalName = $image->getClientOriginalName();
			$path = $image->storeAs('products/'. $product->id .'/thumbnail', $originalName);
		
			$product->thumbnail = $originalName;
		}
		$product->save();


		return redirect('/admin/products');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
		Product::destroy($id);
  
		return redirect('/admin/products');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id){
		
		$image = ProductImage::find($id);
		$pid = $image->product->id;
		Storage::delete('/storage/products/'. $pid. '/'. $image->image);
		ProductImage::destroy($id);
  
		return redirect('/admin/products/'.$pid.'/edit');
	}
}
