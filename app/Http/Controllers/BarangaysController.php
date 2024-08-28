<?php

namespace App\Http\Controllers;

use App\Models\Barangays;
use Symfony\Component\HttpFoundation\Request;
use Session;
class BarangaysController extends Controller
{

    public function index(){

        return view('barangay');
    }

    public function show(Barangays $barangay){
         $barangay = Barangays::where('id',$barangay->id)->with('municipal.province')->first();
        Session::put('barangay', $barangay );
        return redirect()->route('admin.dashboard.index');
    }

    public function create(Request $request){
        abort_if(auth()->user()->role!='admin',403);
        return view('admin.barangay.create',[
            'municipal_name'=>$request->input('municipal_name'),
            'province_name'=>$request->input('province_name'),
            'municipal_id'=>$request->input('municipal_id'),
        ]);
    }

    public function store(Request $request){
        abort_if(auth()->user()->role!='admin',403);
        $request->validate([
            'name'=>['unique:municipals,name','required','min:3','string'],
            // 'code'=>['unique:municipals,name','required','min:3','integer'],
            // 'psgc_code'=>['unique:municipals,name','required','min:3','integer'],
            // 'province_code'=>['required','min:3','integer'],
            // 'municipal_code'=>['required','min:3','integer'],
            // 'old_name'=>['required'],
            // 'region_code'=>['unique:municipals,name','required','min:3','integer'],
            // 'municipal_id'=>['integer'],
        ]);
        Barangays::create([
            'name'=>$request->name,
            'municipal_id'=>$request->municipal_id
        ]);
        return redirect()->route('admin.municipal.show',$request->municipal_id)->with('success','New barangay has been added');
    }

    public function edit(Barangays $barangay){
        abort_if(auth()->user()->role!='admin',403);
         $barangay = Barangays::where('id',$barangay->id)->with('municipal.province')->first();
        return view('admin.barangay.edit',['barangay'=>$barangay]);
    }

    public function update(Request $request, Barangays $barangay){
        abort_if(auth()->user()->role!='admin',403);
        $validate = $request->validate([
            'name'=>['unique:barangays,name,'.$barangay->id,'required','min:3','string'],
            // 'code'=>['unique:barangays,name','required','min:3','integer'],
            // 'psgc_code'=>['unique:barangays,name','required','min:3','integer'],
            // 'province_code'=>['required','min:3','integer'],
            // 'municipal_code'=>['required','min:3','integer'],
        ]);

        Barangays::where('id',$barangay->id)->update(['name'=>$request->name]);
       return redirect()->back()->with('updated','Successfully Updated');
    }

    public function destroy(Barangays $barangay){
        abort_if(auth()->user()->role!='admin',403);
        Barangays::destroy($barangay->id);
        return redirect()->route('admin.municipal.show',$barangay->municipal_id)->with('deleted','Successfully <b>'.$barangay->name.'</b> has been Removed');
    }
}
