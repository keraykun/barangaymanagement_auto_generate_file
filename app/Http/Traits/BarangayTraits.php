<?php

namespace App\Http\Traits;
use Session;
use Illuminate\Support\Facades\Auth;
trait BarangayTraits {

    public function BarangayID()
    {

        if(!Session::has('barangay')){
            if (Auth::user()->role=='secondary' && Auth::user()->barangay_id!=null) {
            $user = Auth::user()->barangay_id;
            return redirect()->route('admin.barangay.show',$user);
            }
            abort(500);
        }
       return Session::get('barangay')->id;
    }

    public function BarangaySession()
    {
       return Session::get('barangay');
    }

    public function ifBarangayIsSet(){
        if(!Session::has('barangay')){
            abort(401);
        }
    }
}
