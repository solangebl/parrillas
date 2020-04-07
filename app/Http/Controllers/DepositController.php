<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;

class DepositController extends Controller
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
		return view('deposits.index', [
			'deposits' => Deposit::all()
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

		$deposit = Deposit::create([
			'name' => $request->input('name'),
			'information' => $request->input('information'),
		]);
		$deposit->save();
		return redirect('/admin/deposits');
  }
  
  public function edit($id){
		$deposit = Deposit::find($id);
		
		return view('deposits.edit', [
			'deposit' => $deposit,
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

		$deposit = Deposit::find($id);
		if (!empty($deposit)) {
			$deposit->name = $request->input('name');
			$deposit->information = $request->input('information');
			$deposit->save();
		}
		return redirect('/admin/deposits');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
		Deposit::destroy($id);
  
		return redirect('/admin/deposits');
	}
}
