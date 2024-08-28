<?php

namespace App\Http\Controllers;
use App\Models\Municipal;
use Illuminate\Http\Request;

class MunicipalController extends Controller
{
    public function index(){
        return redirect()->route('admin.municipal.show',1);
        //return view('admin.municipal.index');
    }

    public function show(Municipal $municipal){

         if(auth()->user()->role!='admin'){
            return redirect()->route('admin.dashboard.index');
         }

          $barangays = Municipal::where('id',$municipal->id)->with(['province','barangays.admins'])->first();
         return view('admin.barangay.index')->with('barangays',$barangays);
    }

    public function create(Request $request){
        abort_if(auth()->user()->role!='admin',403);
        return view('admin.municipal.create',['province_id'=>$request->province_id]);
    }

    // public function create(Request $request){
    //     return view('admin.municipal.create',[
    //         'municipal_name'=>$request->input('municipal_name'),
    //         'municipal'=>$request->input('municipal_code'),
    //         'id'=>$request->input('id'),'region_code'=>$request->input('region_code')
    //     ]);
    // }

    public function store(Request $request){
        abort_if(auth()->user()->role!='admin',403);
       $request->validate([
            'name'=>['unique:municipals,name','required','min:3','string'],
           //  'province_id'=>['integer'],
            // 'old_name'=>['required'],
            // 'is_municipal'=>['string'],
            // 'code'=>['unique:municipals,name','required','min:3','integer'],
            // 'psgc_code'=>['unique:municipals,name','required','min:3','integer'],
            // 'region_name'=>['unique:municipals,name','required','min:3','string'],
            // 'province_code'=>['required','min:3','integer'],
        ]);

        Municipal::create([
            'name'=>$request->name,
            'province_id'=>$request->province_id
        ]);
        return redirect()->route('admin.province.show',$request->province_id);
    }

    public function edit(Municipal $municipal){
        abort_if(auth()->user()->role!='admin',403);
         $municipal = Municipal::where('id',$municipal->id)->with('province')->first();
        return view('admin.municipal.edit',['municipal'=>$municipal]);
    }

    public function update(Request $request, Municipal $municipal){
        abort_if(auth()->user()->role!='admin',403);
        $validate = $request->validate([
            'name'=>['unique:municipals,name,'.$municipal->id,'required','min:3','string'],
            // 'code'=>['unique:municipals,name','required','min:3','integer'],
            // 'psgc_code'=>['unique:municipals,name','required','min:3','integer'],
            // 'region_name'=>['unique:municipals,name','required','min:3','string'],
            // 'province_code'=>['required','min:3','integer'],
        ]);

       Municipal::where('id',$municipal->id)->update($validate);
       return redirect()->back()->with('success','Successfully Updated');
    }

    public function destroy(Municipal $municipal){
        abort_if(auth()->user()->role!='admin',403);
        Municipal::destroy($municipal->id);
        return redirect()->route('admin.province.show',$municipal->province_id)->with('success','Successfully <b>'.$municipal->name.'</b> has been Removed');
    }
}
