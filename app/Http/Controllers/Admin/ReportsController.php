<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Reports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['check.blotter']);
    }

    public function index(Request $request)
    {

        if($request->case){
            $search = $request->search;
            $case = $request->case;
            $reports = Reports::where('barangay_id', auth()->user()->barangay_id)->where(function($query) use($case,$search){
                $query->where('resident_name','like','%'.$search.'%')->where('remark',$case);
            })
            ->orWhere(function($query) use($case,$search){
                $query->where('name','like','%'.$search.'%')->where('remark',$case);
            })
            ->orWhere(function($query) use($case,$search){
                $query->where('statements','like','%'.$search.'%')->where('remark',$case);
            })
            ->orWhere(function($query) use($case,$search){
                $query->where('actions','like','%'.$search.'%')->where('remark',$case);
            })
            ->orWhere(function($query) use($case,$search){
                $query->where('involved','like','%'.$search.'%')->where('remark',$case);
            })
            ->orWhere(function($query) use($case,$search){
                $query->where('location','like','%'.$search.'%')->where('remark',$case);
            })
            ->orderBy('name', 
            'asc')->paginate(10);
        }else{
            $reports = Reports::where('barangay_id', auth()->user()->barangay_id)->orderBy('name', 
            'asc')->paginate(10);
        }
        //dd($reports);
       return view('admin.report.index',['reports'=>$reports]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $request->validate([
            'name'=>['required'],
            'resident'=>['required'],
            'involved'=>['required'],
            'location'=>['required'],
            'action'=>['required'],
            'statement'=>['required'],
            'date_reported'=>['required'],
            'date_incident'=>['required'],
            // 'date_recorded'=>['required'],
        ]);


        Reports::create([
            'barangay_id'=>$this->BarangayID(),
            'name'=>$request->name,
            'resident_name'=>$request->resident,
            'involved'=>$request->involved,
            'location'=>$request->location,
            'actions'=>$request->action,
            'statements'=>$request->statement,
            'date_reported'=>$request->date_reported,
            'date_incident'=>$request->date_incident,
             'date_recorded'=>$request->date_reported,
        ]);
        return redirect()->route('admin.report.index')->with('success','Successfully report has been created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reports $report)
    {
        return view('admin.report.show',['report'=>$report]);
    }

    public function file(Reports $report)
    {

        return view('admin.report.file',['report'=>$report]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $report)
    {

        return view('admin.report.edit',['report'=>$report]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $report)
    {

//return $request;
        $request->validate([
            'name'=>['required'],
            'resident'=>['required'],
            'involved'=>['required'],
            'location'=>['required'],
            'action'=>['required'],
            'statement'=>['required'],
            'date_recorded'=>['required'],
            'date_incident'=>['required'],
            // 'date_recorded'=>['required'],
        ]);
       // return 'okay';
        //return $request;
        Reports::where('id',$report->id)->update([
            'name'=>$request->name,
            'resident_name'=>$request->resident,
            'involved'=>$request->involved,
            'location'=>$request->location,
            'actions'=>$request->action,
            'statements'=>$request->statement,
            'date_recorded'=>$request->date_recorded,
            'date_incident'=>$request->date_incident,
        ]);


        return redirect()->back()->with('updated','Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function done(Reports $report)
     {
         Reports::where('id',$report->id)->update(['remark'=>3]);
         return redirect()->back()->with('updated','Updated Successfull');
     }

     public function progress(Reports $report)
     {
         Reports::where('id',$report->id)->update(['remark'=>2]);
         return redirect()->back()->with('updated','Updated Successfull');
     }

     public function pending(Reports $report)
     {
         Reports::where('id',$report->id)->update(['remark'=>1]);
         return redirect()->back()->with('updated','Updated Successfull');
     }

    public function destroy(Reports $report)
    {
        Reports::destroy('id',$report->id);
        return redirect()->route('admin.report.index')->with('deleted',$report->name);
    }
}
