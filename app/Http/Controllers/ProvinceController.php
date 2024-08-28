<?php

namespace App\Http\Controllers;
use App\Models\Province;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinceController extends Controller
{
    public function index(){
        if(auth()->user()->role!='admin'){
            return redirect()->route('admin.dashboard.index');
         }
        $provinces = Province::all();
        return redirect()->route('admin.municipal.show',1);
        //return view('admin.province.index',['provinces'=>$provinces]);
    }

    public function show(Province $province){
        if(auth()->user()->role!='admin'){
            return redirect()->route('admin.dashboard.index');
         }
        $province = Province::where('id',$province->id)->with('municipals')->first();
        return redirect()->route('admin.municipal.show',1);
       // return view('admin.municipal.index')->with('province',$province);
    }

    public function create(){
        abort_if(auth()->user()->role!='admin',403);
        return view('admin.province.create');
    }

    public function store(Request $request){
        abort_if(auth()->user()->role!='admin',403);
        $validate = $request->validate([
            'name'=>['unique:provinces,name','required','min:3','string'],
            // 'code'=>['unique:provinces,name','required','min:3','integer'],
            // 'region_code'=>['required','min:3','integer'],
            // 'psgc_code'=>['unique:provinces,name','required','min:3','integer'],
            // 'island_name'=>['unique:provinces,name','required','min:3','string'],
        ]);

        Province::create($validate);
        return redirect()->route('admin.province.index');
    }

    public function edit(Province $province){
        abort_if(auth()->user()->role!='admin',403);
        return view('admin.province.edit',['province'=>$province]);
    }

    public function update(Request $request, Province $province){
        abort_if(auth()->user()->role!='admin',403);
        $validate = $request->validate([
            'name'=>['unique:provinces,name','required','min:3','string'],
            // 'code'=>['unique:provinces,name','required','min:3','integer'],
            // 'region_code'=>['required','min:3','integer'],
            // 'psgc_code'=>['unique:provinces,name','required','min:3','integer'],
            // 'island_name'=>['unique:provinces,name','required','min:3','string'],
        ]);
       Province::where('id',$province->id)->update($validate);
       return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy(Province $province){
        abort_if(auth()->user()->role!='admin',403);
        Province::destroy($province->id);
        return redirect()->route('admin.province.index')->with('success','Successfully <b>'.$province->name.'</b> has been Removed');
    }
}
