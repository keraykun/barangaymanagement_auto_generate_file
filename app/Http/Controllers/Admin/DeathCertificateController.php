<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use App\Models\DeathCertificates;
use Illuminate\Http\Request;
use App\Models\Residents;
use App\Models\Officials;
use App\Models\Logos;
use Illuminate\Support\Facades\DB;


class DeathCertificateController extends Controller
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
            DeathCertificates::create([
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
    public function show(Residents $death)
    {
       // return $death;
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

       $secretary = Officials::where('barangay_id',$this->BarangayID())
       ->whereHas('positions',function($query){
           $query->where('name','secretary');
       })
       ->with('positions')
       ->first();


       $background = Backgrounds::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
       $logo = Logos::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
       return  view('admin.death.show')->with(compact('logo','background','death','kagawads','kapitan','secretary'));
    }

    public function list(Residents $resident)
    {
         $deaths = DeathCertificates::where('resident_id',$resident->id)->get();
        return view('admin.death.list',compact('deaths','resident'));
    }

    public function format(DeathCertificates $format)
    {

         $resident = Residents::find($format->resident_id);

         $death = DeathCertificates::where('id',$format->id)->first();

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
        return  view('admin.death.format')->with(compact('logo','death','background','resident','kagawads','kapitan'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeathCertificates $deathCertificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeathCertificates $deathCertificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeathCertificates $deathCertificates)
    {
        //
    }
}
