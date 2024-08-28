<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\Officials;
use App\Models\Projects;
use App\Http\Traits\BarangayTraits;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = Projects::where('barangay_id',$this->BarangayID())->with(['officials','barangay'])->get();

        return view('admin.project.index',['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        return view('admin.project.edit',['project'=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $projects)
    {
        //
    }
}
