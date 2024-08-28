<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use App\Models\Business;
use App\Models\Officials;
use App\Models\Logos;
use App\Models\Residents;
use Illuminate\Http\Request;
use App\Models\BusinessCertificates;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
       // return $request->userID;
        DB::transaction(function () use($request){
            BusinessCertificates::create([
                'resident_id'=>$request->userID,
                'description'=>$request->content,
                'issuance_of'=>$request->issuanceDate,
                'price'=>$request->amountPaid,
            ]);
        });

        return response()->json('Data has been saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Residents $business)
    {
        $kagawads =  Officials::where('barangay_id',$this->BarangayID())
        ->whereHas('positions',function($query){
            $query->where('name','kagawad');
        })->get();

        $kapitan = Officials::where('barangay_id',$this->BarangayID())
       ->whereHas('positions',function($query){
           $query->where('name','kapitan');
       })
       ->with('positions')
       ->first();

       $background = Backgrounds::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
       $logo = Logos::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
        return  view('admin.business.show')->with(compact('logo','background','business','kagawads','kapitan'));
    }


    public function list(Residents $resident)
    {
        $businesses = BusinessCertificates::where('resident_id',$resident->id)->get();
        return view('admin.business.list',compact('businesses','resident'));
    }

    public function format(BusinessCertificates $format)
    {

         $resident = Residents::find($format->resident_id);

         $business = BusinessCertificates::where('id',$format->id)->first();

         $kagawads =  Officials::where('barangay_id',$this->BarangayID())
         ->whereHas('positions',function($query){
             $query->where('name','kagawad');
         })->get();

         $kapitan = Officials::where('barangay_id',$this->BarangayID())
        ->whereHas('positions',function($query){
            $query->where('name','kapitan');
        })
        ->with('positions')
        ->first();

        $background = Backgrounds::where('barangay_id',$this->BarangayID())->first();
        $logo = Logos::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
        return  view('admin.business.format')->with(compact('logo','business','background','resident','kagawads','kapitan'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        //
    }
}
