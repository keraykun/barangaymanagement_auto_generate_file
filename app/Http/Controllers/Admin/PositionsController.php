<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Positions;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(isset($request->search)){
            $search = $request->search;
             $positions = Positions::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->paginate(10);
            return view('admin.position.index',['positions'=>$positions]);
        }else{
            $positions = Positions::paginate(10);
            return view('admin.position.index',['positions'=>$positions]);
        }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['rank'=>0]);
        $validate = $request->validate([
            'name'=>['min:3','required','string','unique:positions,name'],
            'unique'=>['required'],
            'rank'=>['required']
        ],[
            'name'=>'The position field is required',
            'name.unique'=>'The position '.$request->name.' already exist'
        ]);
        Positions::create($validate);
        return redirect()->route('admin.position.index')->with('success','New Position has been Added !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Positions $positions)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Positions $position)
    {
        return view('admin.position.edit',['position'=>$position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Positions $position)
    {
        $validate = $request->validate([
            'name'=>['unique:positions,name,'.$position->id,'required','min:3','string'],
            'unique'=>['required'],
        ],[
            'name'=>'The position field is required',
            'name.unique'=>'The position '.$request->name.' already exist'
        ]);

        Positions::where('id',$position->id)->update($validate);
        return redirect()->back()->with('success','Position has been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Positions $position)
    {
        Positions::destroy($position->id);
        return redirect()->route('admin.position.index')->with('danger',' '.$position->name.' has been Removed');
    }
}
