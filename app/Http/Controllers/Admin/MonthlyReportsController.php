<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reports;

use Illuminate\Http\Request;

class MonthlyReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('check.monthly');
     }


    public function print(Reports $monthly)
    {
        return 'here';
    }

    public function index(Request $request)
    {

        $reports = Reports::where('barangay_id', auth()->user()->bangaray_id)->paginate(50);
        $search = $request->search;
        if($search!=''){
            $reports = Reports::where('barangay_id', auth()->user()->bangaray_id)->where('name', 'like', '%' . $search . '%')
           ->paginate(50);
        }

        $from = $request->from_date;
        $to = $request->to_date;

        if($from!='' && $to!=''){
            $reports = Reports::where('barangay_id', auth()->user()->bangaray_id)->where('name', 'like', '%' . $search . '%')
           ->whereBetween('date_reported',[$from,$to])
           ->paginate(50);
        }
        //dd($reports);
        return view('admin.monthly.index',['reports'=>$reports]);


        // if(isset($request)){
        //     $reports = Reports::whereMonth('date_reported',$request->month)
        //    ->whereYear('date_reported',$request->year)
        //    ->paginate(10);
        //    return view('admin.monthly.index',['reports'=>$reports,'year'=>$request->year,'month'=>$request->month]);
        // }else{
        //     $reports = Reports::paginate(10);
        //     return view('admin.monthly.index',['reports'=>$reports]);
        // }
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
    public function show(Reports $monthly)
    {
      //  return view('admin.report.show',['report'=>$report]);
      return view('admin.monthly.show',['report'=>$monthly]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
