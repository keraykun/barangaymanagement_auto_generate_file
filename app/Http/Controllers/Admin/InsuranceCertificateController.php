<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Insurances;
use App\Models\Residents;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InsuranceCertificateController extends Controller
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
       // return view('admin.indigency.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            Insurances::create([
                'resident_id'=>$request->userID,
                'price'=>$request->price,
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Residents $insurance)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurances $insurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insurances $insurance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurances $insurance)
    {
        //
    }
}
