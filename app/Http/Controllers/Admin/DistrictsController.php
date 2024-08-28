<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Traits\BarangayTraits;
use App\Models\Residents;

class DistrictsController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('check.purok');
     }

    public function index(Request $request)
    {


    // return $this->BarangayID();
      if($request->search){

        $search = $request->search;
          $districts = Districts::where(function($query) use ($search){
          $query->where('barangay_id',$this->BarangayID());
           $query->where('name','LIKE',"%$search%");
        })
/*         ->orWhere(function($query) use ($search){
            $query->where('barangay_id',$this->BarangayID());
            //$query->where('zone','LIKE',"%$search%");
        }) */
/*         ->orWhere(function($query) use ($search){
            $query->where('barangay_id',$this->BarangayID());
           // $query->where('address','LIKE',"%$search%");
        }) */
        ->orWhereHas('barangay',function($query) use($search){
            $query->where('barangay_id',$this->BarangayID());
            $query->where('name','LIKE',"%$search%");
        })
        ->withCount('residents as count')
        ->orderByRaw("CAST(SUBSTRING_INDEX(name, ' ', -1) AS UNSIGNED) ASC")
        ->paginate(10);

      }else{
        $districts = Districts::where('barangay_id',$this->BarangayID())
        ->with(['barangay'])
        ->orderByRaw("CAST(SUBSTRING_INDEX(name, ' ', -1) AS UNSIGNED) ASC")
        ->withCount('residents as count')
        ->paginate(100);
      }
      return view('admin.district.index',['districts'=>$districts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role=='staff',403);
        return view('admin.district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(auth()->user()->role=='staff',403);
        $request->merge(['barangay_id'=>$this->BarangayID()]);
        $district = $request->validate([
            'barangay_id'=>['required'],
            'name'=>['required','min:2'],
            // 'address'=>['required','min:2'],
            // 'zone'=>['required','min:2'],
        ]);
        Districts::create($district);
        return redirect()->route('admin.district.index')->with('success','New District has been Added !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Districts $district)
    {
        return $district;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Districts $district)
    {
        abort_if(auth()->user()->role=='staff',403);
        return view('admin.district.edit',['district'=>$district]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Districts $district)
    {
        abort_if(auth()->user()->role=='staff',403);
        $patch = $request->validate([
            'name'=>['required','min:2'],
            // 'address'=>['required','min:2'],
            // 'zone'=>['required','min:2'],
        ]);
       Districts::where('id',$district->id)->update($patch);
       return redirect()->back()->with('updated','District has been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Districts $district)
    {
        abort_if(auth()->user()->role=='staff',403);
        Districts::destroy($district->id);
        return redirect()->route('admin.district.index')->with('deleted',$district->name);
    }
}
