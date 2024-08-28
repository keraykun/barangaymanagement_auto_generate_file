<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Backgrounds;
use App\Models\Barangays;
use App\Models\Logos;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $background = Backgrounds::where('barangay_id',$this->BarangayID())->with('barangay.municipal.province')->orderBy('id','desc')->first();
        $logo = Logos::where('barangay_id',$this->BarangayID())->with('barangay.municipal.province')->orderBy('id','desc')->first();
        return view('admin.information.index',['logo'=>$logo,'background'=>$background]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(auth()->user()->role!='admin',403);
        $logo = Logos::where('barangay_id',$this->BarangayID())->orderBy('id','desc')->first();
        return view('admin.information.create',['logo'=>$logo]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title'=>'required',
        ]);
        $imageName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('images/logos'), $imageName);
        Logos::create([
            'barangay_id'=>$this->BarangayID(),
            'title'=>$request->title,
            'name'=>$imageName
        ]);

        return redirect()->back()->with('success','Logo has been Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barangays $information)
    {

        $request->validate([
            'name'=>['required','unique:barangays,name,'.$information->id],
            'phone'=>['required'],
            'email'=>['required','unique:barangays,email,'.$information->id],
        ]);
        Barangays::where('id',$information->id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email
        ]);
        return redirect()->route('admin.information.index')->with('success','Sucessful Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
