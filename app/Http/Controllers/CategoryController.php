<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	protected $valFields = [
		'name' => 'required',
	];
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
      return view('categories.index',
        ['categories' => Category::all()]
		  );
	  }

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $validatedData = $request->validate($this->valFields);

      $category = Category::create([
        'name' => $request->input('name'),
      ]);

      return redirect('/admin/categories');
    }

    public function edit($id){
      $category = Category::find($id);
      
      return view('categories.edit', [
        'category' => $category,
      ]);
    }

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $cat = Category::find($id);
      if (!empty($cat)) {
        $cat->fill($request->all());
      }
      if(!empty($request->input('subcategory'))) {
        $subcategory = Subcategory::create([
          'name' => $request->input('subcategory'),
          'category_id' => $cat->id,
        ]);
        $subcategory->save();
      }
      $cat->save();
      return redirect(route('categories.edit', $cat->id));
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
		Category::destroy($id);
  
		return redirect('/admin/categories');
	}
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySubcat($id){
        
      Subcategory::destroy($id);
    
      return redirect('/admin/categories');
    }
}
