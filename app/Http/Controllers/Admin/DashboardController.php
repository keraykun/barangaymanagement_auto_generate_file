<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Districts;
use App\Models\Residents;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.dashobard');
    }

    public function index()
    {

       // return $this->BarangayID();
        $ageBetween = Districts::orderBy('name', 'asc')
        ->where('barangay_id', $this->BarangayID())
        ->withCount(['residents as one_to_eightteen' => function ($query) {
            $minDate = now()->subYears(19)->format('Y-m-d');
            $maxDate = now()->subYears(1)->format('Y-m-d');
            $query->whereBetween('birthdate', [$minDate, $maxDate]);
        }])
        ->withCount(['residents as nineteen_to_fiftynine' => function ($query) {
            $minDate = now()->subYears(59)->format('Y-m-d');
            $maxDate = now()->subYears(19)->format('Y-m-d');
            $query->whereBetween('birthdate', [$minDate, $maxDate]);
        }])
        ->withCount(['residents as sexty_years_plus' => function ($query) {
            $minDate = now()->subYears(200)->format('Y-m-d');
            $maxDate = now()->subYears(60)->format('Y-m-d');
            $query->whereBetween('birthdate', [$minDate, $maxDate]);}])
        ->get();

        $age = [
            collect($ageBetween)->pluck('one_to_eightteen')->values()->sum(),
            collect($ageBetween)->pluck('nineteen_to_fiftynine')->values()->sum(),
            collect($ageBetween)->pluck('sexty_years_plus')->values()->sum(),
        ];

        $genders = Districts::orderBy('name','asc')
        ->where('barangay_id',$this->BarangayID())
        ->withCount(['residents as male_count'=>function($query){
            return $query->where('gender','male');
        }])
        ->withCount(['residents as female_count'=>function($query){
            return $query->where('gender','female');
        }])
        ->get();
        $name = collect($genders->pluck('name'))->sort()->unique()->values()->toArray();

        $purok = array_fill_keys($name,['name'=>'','male'=>0,'female'=>0]);
        $purok_female = 0;
        $purok_male = 0;
        foreach($genders as $gender){
            $name = $gender->name;
            $purok_female += $gender->female_count;
            $purok_male += $gender->male_count;
            if (array_key_exists($name,$purok)){
                $purok[$name]['name'] = $name;
                $purok[$name]['male'] += $gender->male_count;
                $purok[$name]['female'] += $gender->female_count;
            }
        }
        $resultArray = [];
        foreach ($purok as $key => $pur) {
            $resultArray[] = [
                'name' => $pur['name'],
                'male' => $pur['male'],
                'female' => $pur['female'],
            ];
        }

        $pluckYear = Residents::where('barangay_id',$this->BarangayID())->get();

         $yearlyResidentsCount = $pluckYear->pluck('created_at')->map(function($date) {
            return Carbon::parse($date)->year;
        })->countBy();

        $yearlyResidentsCountArray = $yearlyResidentsCount->toArray();




        $districts = Districts::orderBy('name','asc')
        ->where('barangay_id',$this->BarangayID())
        ->withCount('residents')->get();

        $names = collect($districts->pluck('name'))->sort()->unique()->values()->toArray();
        $resident_count = 0;
        $datas = array_fill_keys($names,0);
          foreach($districts as $district){
              $resident_count +=  $district->residents_count;
              $name = $district->name;
              if (array_key_exists($name,$datas)){
                  $datas[$name] += $district->residents_count;
              }
          }



      return view('admin.dashboard.index',[
        'resident_count'=>$resident_count,
        'purok_female'=>$purok_female,
        'purok_male'=>$purok_male,
        'purok'=>[
            collect($resultArray)->pluck('name')->values(),
            collect($resultArray)->pluck('male')->values(),
            collect($resultArray)->pluck('female')->values(),
        ],
        'datas'=>[
            collect($datas)->keys(),
            collect($datas)->values()],
        'age'=>$age,
        'age_sum'=>collect($age)->sum(),
        'yearlyresidentKeys'=>collect($yearlyResidentsCountArray)->keys(),
        'yearlyresidentValues'=>collect($yearlyResidentsCountArray)->values()
        ]);


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
