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
use Illuminate\Support\Str;

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
    public function index(Request $request, Product $prod){
		$cat_id = $request->query('category');
		$subcat_id = $request->query('subcategory');
		$prov_id = $request->query('provider');
		$deposit_id = $request->query('deposit');

		$query = $prod->newQuery();
		
		if(!empty($cat_id)) {
			$query->where('category_id', $cat_id);
		} 
		
		if(!empty($subcat_id)) {
			$query->where('subcategory_id', $cat_id);
		}
		if(!empty($prov_id)) {
			$query->where('provider_id', $prov_id);
		} 
		
		if(!empty($deposit_id)) {
			$query->where('deposit_id', $deposit_id);
		}
		$products = $query->get();

		return view('products.index', [
			'products' => $products,
			'categories' => Category::with('subcategories')->orderBy('name', 'asc')->get(),
			'subcategories' => Subcategory::all(),
			'providers' => Provider::all(),
			'deposits' => Deposit::all(),
			'cat_id' => $cat_id,
			'scat_id' => $subcat_id,
			'prov_id' => $prov_id,
			'deposit_id' => $deposit_id,
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
			'thumbnail' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1000',
			'description' => 'required',
			'category_id' => 'required',
			'name' => 'required',
			'sale_price' => 'required',
		];
		//print_r($request->all()); die;
		$images = isset($request->images) ? count($request->images) : 0;
		if(!empty($request->input('images')[0])){
			foreach(range(0, $images) as $index){
			$rules['images.'. $index] = 'image|mimes:jpg,jpeg,bmp,png|max:1000';
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
			$ext = $image->getClientOriginalExtension();
			$originalName = (string) Str::uuid() . '.' . $ext;
			$path = $image->storeAs('products/'. $product->id .'/thumbnail', $originalName);
		
			$product->thumbnail = $originalName;
			$product->save();
		}

		if($images>0){
			$i = 0;
			foreach($request->images as $image){
				if(!empty($image)){
					$ext = $image->getClientOriginalExtension();
					$originalName = (string) Str::uuid() . '.' . $ext;
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
			'sale_price' => 'required',
		];
		$images = isset($request->images) ? count($request->images) : 0;
		if(!empty($request->input('images')[0])){
			foreach(range(0, $images) as $index){
			  $rules['images.'. $index] = 'image|mimes:jpg,jpeg,bmp,png|min:1|max:1000';
			}
		}
		if (isset($request->thumbnail)) {
			$rules['thumbnail'] = 'image|mimes:jpg,jpeg,bmp,png|min:1|max:1000';
		}
		$validatedData = $request->validate($rules);

		$product = Product::find($id);
		$product->fill($request->all());

		if ($images>0) {
			$i = count($product->images);
			foreach($request->images as $image){
			  if(!empty($image)){
				$ext = $image->getClientOriginalExtension();
				$originalName = (string) Str::uuid() . '.' . $ext;
				$path = $image->storeAs('products/'. $product->id, $originalName);
	  
				$productImage = ProductImage::create([
				  'product_id' => $product->id,
				  'image' => $originalName,
				]);
				$i++;
			  }
			}
		}
		if(!empty($request->thumbnail)){
			$image = $request->thumbnail;
			$ext = $image->getClientOriginalExtension();
			$renamed = (string) Str::uuid() . '.' . $ext;
			$path = $image->storeAs('products/'. $product->id .'/thumbnail', $renamed);
		
			$product->thumbnail = $renamed;
		}
		$product->save();


		return redirect('/admin/products');
	}

	public function quickUpdate(Request $request, $id) {
		$product = Product::find($id);
		$product->fill($request->all());
		$res = $product->save();
		return response()->json(['result' => $res]);
	}

	public function priceUpdate(Request $request) {
		$query = Product::where('active', 1);
		$perc = $request->input('perc');
		if(empty($perc) || $perc <= 0 || $perc > 100) {
			return redirect('/admin/products');
		}

		if(!empty($request->input('category'))) {
			$query->where('category_id', $request->input('category'));
		}

		if(!empty($request->input('subcategory'))) {
			$query->where('subcategory_id', $request->input('subcategory'));
		}
		$products = $query->get();

		foreach($products as $prod) {
			$new_price = $prod->sale_price + ($prod->sale_price*$perc/100);
			if ($new_price%10!=0) {
				$new_price += (10-($new_price%10));
				$new_price = round($new_price, 0);
			}
			$prod->sale_price = $new_price;
			
			$new_price = $prod->buy_price + ($prod->buy_price*$perc/100);
			if ($new_price%10!=0) {
				$new_price += (10-($new_price%10));
				$new_price = round($new_price, 0);
			}
			$prod->buy_price = $new_price;

			$new_price = $prod->sale_price_ml + ($prod->sale_price_ml*$perc/100);
			if ($new_price%10!=0) {
				$new_price += (10-($new_price%10));
				$new_price = round($new_price, 0);
			}
			$prod->sale_price_ml = $new_price;
			$prod->save();
		}
		
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
