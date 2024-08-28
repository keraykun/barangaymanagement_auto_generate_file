<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use App\Models\LoanCertificates;
use Illuminate\Http\Request;
use App\Models\Residents;
use App\Models\Logos;
use App\Models\Officials;
use Illuminate\Support\Facades\DB;

class LoanCertificateController extends Controller
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
            LoanCertificates::create([
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
    public function show(Residents $loan)
    {
       // return$loan;
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
       return  view('admin.loan.show')->with(compact('logo','background','loan','kagawads','kapitan','secretary'));
    }

    public function list(Residents $resident)
    {
       $loans = LoanCertificates::where('resident_id',$resident->id)->get();
        return view('admin.loan.list',compact('loans','resident'));
    }

    public function format(LoanCertificates $format)
    {

         $resident = Residents::find($format->resident_id);

         $loan = LoanCertificates::where('id',$format->id)->first();

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

        $background = Backgrounds::where('barangay_id',$this->BarangayID())->first();
        $logo = Logos::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
        return  view('admin.loan.format')->with(compact('logo','loan','background','resident','kagawads','kapitan','secretary'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanCertificates $loanCertificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanCertificates $loanCertificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanCertificates $loanCertificates)
    {
        //
    }
}
