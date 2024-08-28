<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Officials;
use App\Models\OfficialsPositions;
use App\Models\Positions;
use Illuminate\Http\Request;

class OrganizationalController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kagawads = [];
        $kapitan = [];
        $secretary = [];
        $treasurer =[];

        $users = OfficialsPositions::where('barangay_id',$this->BarangayID())->with(['position','official'])->get();
        foreach ($users as $key => $user) {
            $tempArray = [];
            if($user->position->name=="Kapitan"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $kapitan = $tempArray;
            }
            if($user->position->name=="Secretary"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $secretary = $tempArray;
            }
            if($user->position->name=="Treasurer"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $treasurer = $tempArray;
            }
            if($user->position->name=="Kagawad"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $kagawads[] = $tempArray;
            }
        }
        return view('admin.organization.index',['kagawads'=>$kagawads,'kapitan'=>$kapitan,'treasurer'=>$treasurer,'secretary'=>$secretary]);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
