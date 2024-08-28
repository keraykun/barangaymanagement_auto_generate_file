<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use Illuminate\Http\Request;

class BackgroundsController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $background = Backgrounds::where('barangay_id',$this->BarangayID())->with('barangay.municipal.province')->orderBy('id','desc')->first();
        // $logo = Backgrounds::where('barangay_id',$this->BarangayID())->with('barangay.municipal.province')->orderBy('id','desc')->first();
        // return view('admin.information.index',['logo'=>$logo,'background'=>$background]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        abort_if(auth()->user()->role!='admin',403);
        $background = Backgrounds::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
        return view('admin.background.create',['background'=>$background]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'background' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title'=>'required',
        ]);
        $imageName = time().'.'.$request->background->extension();
        $request->background->move(public_path('images/background'), $imageName);
        Backgrounds::create([
            'barangay_id'=>$this->BarangayID(),
            'title'=>$request->title,
            'name'=>$imageName
        ]);

        return redirect()->back()->with('success','Logo has been Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Backgrounds $backgrounds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Backgrounds $backgrounds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Backgrounds $backgrounds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Backgrounds $backgrounds)
    {
        //
    }
}
