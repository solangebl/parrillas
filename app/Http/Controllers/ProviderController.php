<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
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
		return view('providers.index', [
			'providers' => Provider::all()
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
			'name' => 'required',
		];
		$validatedData = $request->validate($rules);

		$provider = Provider::create([
			'name' => $request->input('name'),
			'information' => $request->input('information'),
		]);
		$provider->save();
		
		return redirect('/admin/providers');
	}

	public function edit($id){
		$provider = Provider::find($id);
		
		return view('providers.edit', [
			'provider' => $provider,
		]);
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
		$rules = [
			'name' => 'required',
		];
		$validatedData = $request->validate($rules);
		
		$provider = Provider::find($id);
		if (!empty($provider)) {
			$provider->name = $request->input('name');
			$provider->information = $request->input('information');
			$provider->save();
		}
		return redirect('/admin/providers');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
		Provider::destroy($id);
  
		return redirect('/admin/providers');
	}
}
