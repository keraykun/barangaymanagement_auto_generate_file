<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officials;
use Illuminate\Http\Request;
use App\Http\Traits\BarangayTraits;
use App\Models\OfficialsPositions;
use App\Models\Positions;
use App\Models\ResidentsFiles;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OfficialsController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     if(isset($request->search)){
    //         $search = $request->search;
    //          $officials = Officials::where('is_active','Yes')
    //          ->where(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('firstname','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('middlename','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('lastname','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('contact','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('gender','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->whereRaw(
    //                 'CONCAT_WS(" ",
    //                 trim(firstname),
    //                 trim(middlename),
    //                 trim(lastname)) LIKE "%' . $search. '%"');
    //         })
    //         ->with('positions')
    //         ->paginate(10);
    //         return view('admin.official.index',['officials'=>$officials]);
    //     }else{
    //         $officials = Officials::where('is_active','Yes')
    //         ->where('barangay_id',$this->BarangayID())
    //         ->with('positions')
    //         ->paginate(10);
    //         return view('admin.official.index',['officials'=>$officials]);
    //     }

    // }

    public function __construct()
    {
        $this->middleware('check.official');
    }

    public function index(Request $request)
    {

        $barangayID = $this->BarangayID();


        if(isset($request->search)){
            $search = $request->search;
            $positions = Positions::where('name',$search)->withCount(['officials'=>function($query) use($barangayID){
                $query->where('officials.barangay_id', $barangayID);
            }])->paginate(10);
             return view('admin.official.index',['positions'=>$positions]);
        }else{
            $positions = Positions::withCount(['officials'=>function($query) use($barangayID){
                $query->where('officials.barangay_id', $barangayID);
            }])->paginate(10);
             return view('admin.official.index',['positions'=>$positions]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Positions::all();
        return view('admin.official.create',['positions'=>$positions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


       // abort_if(auth()->user()->role!='admin',403);
        $request->merge([
            'barangay_id'=>$this->BarangayID(),
            'status' => 'Living',
            'is_active'=>'Yes',
            'image'=>'noimage.jpg'
        ]);
         $limit = OfficialsPositions::where(function($where) use($request){
            $where->where('barangay_id',$this->BarangayID())
            ->where('positions_id',$request->positions_id)
            ->where('unique',0);
        })->count();

        // if($limit>=7){
        //    return redirect()->back()->withErrors(['kagawad_limit'=>'Max kagawads reached limit 7'])->withInput();
        // }
        $positions = $request->validate([
            'positions_id' =>['required'],
        ],[
            //'positions_id' => 'Position '.$request->unique_name.' has been taken cannot be duplicate.',
            'positions_id.required' => 'Name field is required.',
        ]);

            $validate = $request->validate([
                'firstname'=>['required','min:3'],
                'middlename'=>['required','min:3'],
                'lastname'=>['required','min:3'],
                'birthdate'=>['required'],
                'contact'=>['required','min:11'],
                'gender'=>['required'],
                'barangay_id'=>['required'],
                'status'=>['required'],
                'is_active'=>['required'],
                'image'=>['required']
            ]);

        DB::transaction(function () use($request,$positions,$validate){
            $user = Officials::create($validate);
            $user->positions()->attach($positions,['barangay_id'=>$this->BarangayID(),'unique'=>$request->unique_role]);
        });
        return redirect()->route('admin.official.index')->with('success','New official has been Added !');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Request $request, Positions $official)
    // {


    //     if(isset($request->search)){
    //         $search = $request->search;
    //          $officials = Officials::where('id',$official->id)->where('is_active','Yes')
    //          ->where(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('firstname','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('middlename','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('lastname','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('contact','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->where('gender','LIKE',"%$search%");
    //         })->orWhere(function($query) use ($search){
    //             $query->where('barangay_id',$this->BarangayID());
    //             $query->whereRaw(
    //                 'CONCAT_WS(" ",
    //                 trim(firstname),
    //                 trim(middlename),
    //                 trim(lastname)) LIKE "%' . $search. '%"');
    //         })
    //         ->with('positions')
    //         ->paginate(10);
    //         return view('admin.official.show',['officials'=>$officials]);
    //     }else{
    //         $officials = Officials::where('id',$official->id)->where('is_active','Yes')
    //         ->where('barangay_id',$this->BarangayID())
    //         ->with('positions')
    //         ->paginate(10);
    //         return view('admin.official.show',['officials'=>$officials]);
    //     }
    // }

    public function show(Request $request, Positions $official)
    {


        $barangayID = $this->BarangayID();


         ResidentsFiles::all();

          $position = Positions::where('id', $official->id)
         ->with(['officials' => function($query) use ($barangayID) {
             $query->where('officials.barangay_id', $barangayID)
                 ->select('officials.*', DB::raw('(SELECT COUNT(*) FROM residents_files WHERE
                     content LIKE CONCAT("%", CONCAT(officials.firstname, " ", officials.middlename, " ", officials.lastname), "%")) AS files_count'))
                     ->orderBy('officials.is_active', 'desc');
         }])
         ->first();


        // return $position = Positions::where('id', $official->id)
        //     ->with(['officials' => function($query) use ($barangayID) {
        //         $query->where('officials.barangay_id', $barangayID);
        //     }])
        //     ->first();

        $officialsPaginated = $position->officials()->paginate(10);

        return view('admin.official.show', ['position' => $position, 'officialsPaginated' => $officialsPaginated]);



    }


    public function certificate(Request $request, Officials $official)
    {


       $firstPositionID = $official->positions->first()->id;
       $barangayID = $this->BarangayID();
       $search = $request->search;

        $officials = Officials::with('barangay')->where('officials.id', $official->id)
       ->first();



        if($search){
            $officials =  Officials::where('officials.id', $official->id)
            ->where('residents_files.name','like','%'.$search.'%')
            ->leftJoin('residents_files', function($join) {
                $join->on(DB::raw('1'), '=', DB::raw('1'))
                     ->whereRaw('residents_files.content LIKE CONCAT("%", CONCAT(officials.firstname, " ", officials.middlename, " ", officials.lastname), "%")')
                     ->leftJoin('users', 'residents_files.user_id', '=', 'users.id')
                     ;
            })
            ->select(
                '*',
                'residents_files.name as name',
                'users.name as prepared'
                )
            ->orderBy('residents_files.created_at','desc')
            ->get();
        }

        return view('admin.official.certificate', ['officials' => $officials,'back'=>$firstPositionID]);
       //$officialsPaginated = $position->officials()->paginate(10);

        //return view('admin.official.certificate', ['position' => $position, 'officialsPaginated' => $officialsPaginated]);



    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Officials $official)
    {
        //abort_if(auth()->user()->role!='admin',403);
        $official = Officials::where('id',$official->id)
        ->where('barangay_id',$this->BarangayID())
        ->with('positions')
        ->first();

        return view('admin.official.edit',['official'=>$official]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Officials $official)
    {

       // abort_if(auth()->user()->role!='admin',403);
        $request->validate([
            'firstname'=>['required','min:3'],
            'middlename'=>['required','min:2'],
            'lastname'=>['required','min:2'],
            'birthdate'=>['required'],
            'contact'=>['required','min:11'],
            'gender'=>['required'],
        ]);
        if($request->file('image')!=null ){
            if($request->old_image!='noimage.jpg'){
                if(file_exists(public_path('images/officials/'.$request->old_image))){
                    unlink(public_path('images/officials/'.$request->old_image));
                }
            }
             $imageName = time().'.'.$request->image->extension();
             $request->image->move(public_path('images/officials'), $imageName);
             Officials::where('id',$official->id)->update([
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'lastname'=>$request->lastname,
                'birthdate'=>$request->birthdate,
                'contact'=>$request->contact,
                'gender'=>$request->gender,
                'image'=>$imageName
            ]);
        }else{
            Officials::where('id',$official->id)->update([
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'lastname'=>$request->lastname,
                'birthdate'=>$request->birthdate,
                'contact'=>$request->contact,
                'gender'=>$request->gender,
                'is_active'=>$request->active,
            ]);
        }

        return redirect()->back()->with('updated','Data has been Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Officials $official)
    {
       //abort_if(auth()->user()->role!='admin',403);
       if($official->image!='noimage.jpg'){
        unlink(public_path('images/officials/'.$official->image));
       }
       Officials::destroy($official->id);
       return redirect()->route('admin.official.index')->with('danger',$official->firstname.' '.$official->middlename.' '.$official->middlename);
    }

}
