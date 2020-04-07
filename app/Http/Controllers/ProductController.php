<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Client;
use App\Category;
use App\ProjectImage;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
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
		return view('projects.index', [
			'projects' => Project::all()
		]);
	}

	public function create(){
		return view('projects.add', [
			'clients' => Client::orderBy('name', 'asc')->get(),
			'categories' => Category::orderBy('name_es', 'asc')->get(),
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
			'client_id' => 'required',
			'thumbnail' => 'required|image|mimes:jpg,jpeg,bmp,png|max:5000',
			'description_es' => 'required',
		];
		//print_r($request->all()); die;
		$images = isset($request->images) ? count($request->images) : 0;
			if(!empty($request->input('images')[0])){
				foreach(range(0, $images) as $index){
				$rules['images.'. $index] = 'image|mimes:jpg,jpeg,bmp,png|max:5000';
				}
			}
			$validatedData = $request->validate($rules);

			$project = Project::create([
				'client_id' => $request->input('client_id'),
				'description_es' => $request->input('description_es'),
			]);
			foreach($request->categories as $category){
				$project->categories()->attach($category);
		}
		
		if(!empty($request->thumbnail)){
			$image = $request->thumbnail;
			$originalName = $image->getClientOriginalName();
			$path = $image->storeAs('projects/'. $project->id .'/thumbnail', $originalName);
		
			$project->thumbnail = $originalName;
			$project->save();
		}

		if($images>0){
			$i = 0;
			foreach($request->images as $image){
				if(!empty($image)){
					$originalName = $image->getClientOriginalName();
					$path = $image->storeAs('projects/'. $project->id, $originalName);
		  
					$articleImage = ProjectImage::create([
						'project_id' => $project->id,
						'image' => $originalName,
						'order' => $i
					]);
					$i++;
				}
			}
		}
		
		return redirect('/admin/projects');
	}

	public function edit($id){
		$project = Project::find($id);
		$pcategories = [];
		foreach ($project->categories as $cat) {
			$pcategories[] = $cat->id;
		} 
		return view('projects.edit', [
			'project' => $project,
			'images' => Project::find($id)->images()->orderBy('order')->get(),
			'pcategories' => $pcategories,
			'clients' => Client::orderBy('name', 'asc')->get(),
			'categories' => Category::orderBy('name_es', 'asc')->get(),
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
			'client_id' => 'required',
			'description_es' => 'required',
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

		$project = Project::find($id);
		$project->fill($request->all());

		foreach($project->categories as $p){
			$project->categories()->detach($p);
		}
		if($request->has('categories') && !empty($request->input('categories'))){
			foreach($request->input('categories') as $cat){
				$category = Category::find($cat);
				$project->categories()->attach($category);
			}
		}

		foreach ($project->images as $image) {
			$image->update(['order' => $request->image_order[$image->id]]);
		}

		if ($images>0) {
			$i = count($project->images);
			foreach($request->images as $image){
			  if(!empty($image)){
				$originalName = $image->getClientOriginalName();
				$path = $image->storeAs('projects/'. $project->id, $originalName);
	  
				$projectImage = ProjectImage::create([
				  'project_id' => $project->id,
				  'image' => $originalName,
				  'order' => $i,
				]);
				$i++;
			  }
			}
		}
		if(!empty($request->thumbnail)){
			$image = $request->thumbnail;
			$originalName = $image->getClientOriginalName();
			$path = $image->storeAs('projects/'. $project->id .'/thumbnail', $originalName);
		
			$project->thumbnail = $originalName;
		}
		$project->save();


		return redirect('/admin/projects');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
		Project::destroy($id);
  
		return redirect('/admin/projects');
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id){
		
		$image = ProjectImage::find($id);
		$pid = $image->project->id;
		Storage::delete('/storage/projects/'. $pid. '/'. $image->image);
		ProjectImage::destroy($id);
  
		return redirect('/admin/projects/'.$pid.'/edit');
	}
}
