<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $projects = project::orderBy('id', 'desc')->paginate(10);
        return view('admin.projectAll', compact('projects') );        
    }
    public function AxiosProjects(){       
        $projects = project::orderBy('id', 'desc')->paginate(10);
        return $projects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.projectNew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',            
            'description' => 'required',            
        ]);
        $user = Auth::user();
        project::create([
            'title' => $request->title,
            'description' => $request->description, 
            'created_by' =>  $user->id,          
        ]);
        return redirect('/projects')->with('status', 'Project save successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        //$project = project::findOrFail($id);
        return view('admin.projects.Edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project )
    {
        $request->validate([
            'title' => 'required',            
            'description' => 'required',            
        ]);
        $authors = $request->authors;
        $authors = json_encode($authors);      
       // $project = project::findOrFail($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->authors = $authors;

        $project->save();
        return redirect('/projects')->with('status', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $project->delete();
        return redirect('/projects');
    }
}
