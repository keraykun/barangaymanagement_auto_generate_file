<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
           if (Auth::user()->role=='secondary' && Auth::user()->barangay_id!=null) {
                return redirect()->route('admin.dashboard.index');
            }else if(Auth::user()->role=='staff' && Auth::user()->barangay_id!=null){
                return redirect()->route('admin.barangay.show',Auth::user()->barangay_id);
                return redirect()->route('admin.dashboard.index');
            }else if(Auth::user()->role=='admin' && Auth::user()->barangay_id==null)  {
                return redirect()->route('admin.municipal.show',1);
                //return redirect()->route('admin.province.index');
            }else{
                abort(500);
            }
        }else{
            return redirect()->back()->with('error','Invalid Account Credentials.');
        }

    }
}
