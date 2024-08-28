<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\ResidentsFiles;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffReportsController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('check.staff');
     }

    public function index()
    {
        $role = Auth::user()->role;
        $id = Auth::id();
        $bar = $this->BarangayID();

       

        if($role=='admin' || $role=='secondary'){
            $files = User::where(function($query) use($id,$bar){
                $query->where('barangay_id',$bar)
                ->orWhere('role','admin');
             })->with('files')->withCount('files')->get();
        }else if($role=='staff'){

            $files = User::where(function($query) use($id,$bar){
                $query->where('barangay_id',$bar)
                ->where('id',$id);
            })
            ->where('role','staff')
            ->with('files')
            ->withCount('files')->get();
        }

        return view('admin.staff.index',['certificates'=>$files]);
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
    public function show(Request $request, User $staff)
    {
        $user = User::findOrFail($staff->id);
        $bar = $this->BarangayID();

        $files = User::where('id', $staff->id)
        ->with(['files' => function ($query) use ($request) {
            if ($request->search != '') {
                $query->where('name', 'LIKE', "%{$request->search}%");
            }
    
            if ($request->from_date != '' && $request->to_date != '') {
                $from = $request->from_date;
                $to = Carbon::parse($request->to_date)->addDay();
                $query->whereBetween('created_at', [$from, $to]);
            }
        }])
        ->first();

       // dd($files);
        //dd($user);
        return view('admin.staff.show', [
            'certificates' => $files, // Assuming $files is the variable containing certificates data
            'users' => $user // Assuming $user is the variable containing user data
        ]);
        
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
