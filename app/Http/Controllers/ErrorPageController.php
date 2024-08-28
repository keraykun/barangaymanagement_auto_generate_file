<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ErrorPageController extends Controller
{
    public function __invoke()
    {
        if(Auth::check()){
            $user = auth()->user()->barangay_id;
            return redirect()->route('admin.barangay.show',$user);
        }
        return view('error404');
    }
}
