<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Roles;
use App\Models\RolesUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {


    }


    public function index()
    {

       $users = User::where('barangay_id',$this->BarangayID())->get();

       return view('admin.admin.index',['admins'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Roles::all();
        $barangay = $this->BarangayID();
        return view('admin.admin.create',['barangay'=>$barangay,'roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $roles = $request->tagsID;


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

       DB::transaction(function () use($roles,$request){
            $user = User::create([
                'barangay_id'=>$request->barangay_id,
                'role'=>$request->role,
                'name' => $request->name,
                'email' =>$request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::find($user->id);
            $user->roles()->attach($roles);
       });



        return redirect()->back()->with('success','New '.$request->role.' has been created !');
       // return redirect()->route('admin.admin.index')->with('success','New has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        $roles = Roles::all();
         $admin = User::where('id',$admin->id)->with('roles')->first();
        return view('admin.admin.edit',['admin'=>$admin,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
       $removeRoles = is_array($request->editTagID);


       if($request->name!=''){
            $admin->update([
                'name' => $request->name
            ]);
       }

       if($request->password!='' && $$request->password_confirmation!=''){
        return 'here';
            $request->validate([
                'current_password' => ['required'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
            ]);
            if (Hash::check($request->current_password, $admin->password)) {
                $admin->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect()->back()->withErrors(['current_password' => 'The provided current password does not match your actual password.']);

        }

        $roles = $request->tagsID;


        if($roles!=null && count($roles)>=0){
            DB::transaction(function () use($removeRoles,$roles,$request,$admin){

                $user = User::find($admin->id);
                DB::table('roles_user')->where('user_id', $admin->id)->delete();
            $user->roles()->attach($roles);
        });
        }


        return redirect()->back()->with('updated','Data has been updated');

    }


    public function profile(Request $request, User $user)
    {
      //  return $request;
       $request->validate([
            'name' => ['required', 'string', 'max:255'],
       ]);
       $user->update([
        'name'=>$request->name,
        ]);
        return redirect()->back()->with('updated','Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
       User::destroy('id',$admin->id);
       return redirect()->back()->with('deleted','Data has been updated');
      // return redirect()->route('admin.admin.index')->with('danger',$admin->name);
    }
}
