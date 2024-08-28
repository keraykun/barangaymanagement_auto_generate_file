<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\Residents;
use App\Http\Traits\BarangayTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
class ResidentsController extends Controller
{

    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $url =  $request->getQueryString();
        $getID = str_replace('=','',$url);

        $resident = Districts::where('id',$getID)
        ->with('barangay')
        ->first();
        return view('admin.resident.create',['resident'=>$resident]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;

        $request->merge([
            'barangay_id'=>$this->BarangayID(),
            'district_id'=>$request->district_id,
            'status' => 'Living',
            'is_active'=>'Yes',
            'image'=>'noimage.jpg'
        ]);
        $validate = $request->validate([
            'firstname'=>[Rule::unique('residents')->where(function ($query) use ($request) {
                return $query
                ->where('firstname',$request->firstname)
                ->where('middlename',$request->middlename)
                ->where('lastname',$request->lastname);
            })
            ,'required','min:3'],
            'barangay_id'=>['required'],
            'middlename'=>['required','min:3'],
            'lastname'=>['required','min:3'],
            'birthdate'=>['required'],
            'contact'=>['required','min:11'],
            'gender'=>['required'],
            'district_id'=>['required'],
            'status'=>['required'],
            'is_active'=>['required'],
            'image'=>['required']
        ],[
            'firstname' => $request->firstname.' '.$request->middlename.' '.$request->lastname.' , Already exist cannot be duplicate.',
        ]);

        DB::transaction(function () use($validate){
            Residents::create($validate);
        });
        return redirect()->route('admin.resident.show',$request->id)->with('success','New Resident has been Added !');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Districts $resident)
    {

       abort_if($resident->barangay_id!=$this->BarangayID(),500);
         $resident = Districts::where('id',$resident->id)
        ->withCount('residents as count')
        ->first();
        if($request->search){
             $search = $request->search;
             $residents = Residents::where('is_active','Yes')
             ->where(function($query) use ($search,$resident){
                $query->where('district_id',$resident->id);
                $query->where('firstname','LIKE',"%$search%");
            })->orWhere(function($query) use ($search,$resident){
                $query->where('district_id',$resident->id);
                $query->where('middlename','LIKE',"%$search%");
            })->orWhere(function($query) use ($search,$resident){
                $query->where('district_id',$resident->id);
                $query->where('lastname','LIKE',"%$search%");
            })->orWhere(function($query) use ($search,$resident){
                $query->where('district_id',$resident->id);
                $query->where('contact','LIKE',"%$search%");
            })->orWhere(function($query) use ($search,$resident){
                $query->where('district_id',$resident->id);
                $query->where('gender','LIKE',"%$search%");
            })
            ->orderBy('lastname','asc')
            ->paginate(15);
        }else{
            $residents = Residents::where('district_id',$resident->id)
            ->with(['district.barangay'])
            ->orderBy('lastname','asc')
            ->paginate(15);
        }
        return view('admin.resident.show',['residents'=>$residents,'resident'=>$resident]);
    }

    public function detail(Residents $resident){
        $resident = Residents::where('id',$resident->id)
        ->with(['district.barangay.municipal','business','indigency'])
        ->withCount('indigency as indigency_count')
        ->withCount('business as business_count')
        ->first();
        abort_if($this->BarangayID()!=$resident->district->barangay->id,500);
        return view('admin.resident.detail',['resident'=>$resident]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residents $resident)
    {
         $resident = Residents::where('id',$resident->id)
        ->with(['district.barangay'])
        ->first();

        return view('admin.resident.edit',['resident'=>$resident]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residents $resident)
    {

        $validate = $request->validate([
            'firstname'=>[Rule::unique('residents')->where(function ($query) use ($request) {
                return $query
                ->where('firstname',$request->firstname)
                ->where('middlename',$request->middlename)
                ->where('lastname',$request->lastname)
                ->where('id','!=',$request->id)
                ;
            })
            ,'required','min:3'],
            'middlename'=>['required','min:3'],
            'lastname'=>['required','min:3'],
            'birthdate'=>['required'],
            'contact'=>['required','min:11'],
            'gender'=>['required'],
        ],[
            'firstname' => $request->firstname.' '.$request->middlename.' '.$request->lastname.' , Already exist cannot be duplicate.',
        ]);

         Residents::where('id',$resident->id)->update($validate);
        return redirect()->back()->with('updated','Resident has been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residents $resident)
    {
        Residents::destroy($resident->id);
        return redirect()->route('admin.resident.show',$resident->district_id)->with('deleted',$resident->firstname.' '.$resident->middlename.' '.$resident->lastname);
    }
}
