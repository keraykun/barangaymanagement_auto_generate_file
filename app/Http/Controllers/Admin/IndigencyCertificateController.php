<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use App\Models\IndigencyCertificates;
use App\Models\Logos;
use App\Models\Officials;
use App\Models\Residents;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndigencyCertificateController extends Controller
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
    public function create(Request $request)
    {

    }

    public function file(Residents $resident){
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
        return  view('admin.indigency.index')->with(compact('logo','background','resident','kagawads','kapitan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // return $request->userID;
        DB::transaction(function () use($request){
            IndigencyCertificates::create([
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

    public function list(Residents $resident)
    {
        $indigencies = IndigencyCertificates::where('resident_id',$resident->id)->get();
        return view('admin.indigency.list',compact('indigencies','resident'));
    }

    public function format(IndigencyCertificates $format)
    {

         $resident = Residents::find($format->resident_id);

         $indigency = IndigencyCertificates::where('id',$format->id)->first();

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
        return  view('admin.indigency.format')->with(compact('logo','indigency','background','resident','kagawads','kapitan'));

    }


    public function show(Residents $indigency)
    {
        $this->ifBarangayIsSet();
        $resident = Residents::where('id',$indigency->id)->with('district.barangay.municipal.province')->first();
        if($this->BarangayID()!=$resident->district->barangay->id){
            return abort(500);
        }
        $logo = Logos::where('barangay_id',$this->BarangayID())->first();
        $background = Backgrounds::where('barangay_id',$this->BarangayID())->first();
        $indigency = IndigencyCertificates::all();
        $pdf = PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf->setBasePath(public_path());

        return $pdf->loadView('admin.indigency.show',compact('indigency','logo','resident'))->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indigency $indigency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indigency $indigency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indigency $indigency)
    {
        //
    }
}
