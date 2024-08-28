<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Files;
use App\Models\Residents;
use App\Models\ResidentsFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

class CertificatesController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('check.certificate');
     }

     public function index(Request $request)
     {

         $search  = $request->search;
         $certificates = Files::where('barangay_id',$this->BarangayID())
         ->withCount('residents as total')

         ->withSum('residents as amount', 'price')
         ->paginate(10);
         if($search){
             $certificates = Files::where('barangay_id',$this->BarangayID())
             ->where(function($query) use($search){
                 $query->where('name','like','%'.$search.'%')
                 ->orWhere('price','like','%'.$search.'%');
             })->withCount('residents as total')
             ->withSum('residents as amount', 'price')
             ->paginate(10);
         }

         return view('admin.certificate.index',['certificates'=>$certificates]);
     }


    // public function index(Request $request)
    // {
    //     $search  = $request->search;
    //      $certificates = ResidentsFiles::with('resident')->paginate(10);
    //     if($search){
    //         $certificates = ResidentsFiles::where(function($query) use($search){
    //             $query->where('name','like','%'.$search.'%')
    //             ->orWhere('price','like','%'.$search.'%');
    //         })
    //         ->orWhereHas('resident',function($query) use($search){
    //             $query->where('firstname','like','%'.$search.'%')
    //             ->orWhere('middlename','like','%'.$search.'%')
    //             ->orWhere('lastname','like','%'.$search.'%')
    //             ->orWhereRaw("CONCAT(lastname, ' ', firstname, ' , ', middlename) LIKE ?", ['%' . $search . '%']);
    //         })
    //         ->paginate(10);
    //     }
    //     $certificates = Files::withCount('residents as total')
    //     ->withSum('residents as amount', 'price')
    //     ->paginate(10);
    //     return view('admin.certificate.index',['certificates'=>$certificates]);
    // }

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
    public function show(Request $request , Files $certificate)
     {


         $search  = $request->search;
          $certificates = ResidentsFiles::with('resident', 'belongsToFile', 'staff')
            ->where('file_id',$certificate->id)
            ->paginate(10);
        if($search){

            $from = $request->from_date;
            $to = $request->to_date;

            $certificates = ResidentsFiles::with('resident', 'belongsToFile', 'staff')
            ->where('residents_files.otr', 'like', '%' . $search . '%')
            ->where('file_id',$certificate->id)
            ->orWhere(function($query) use($search) {
                $query->where('residents.lastname', 'like', '%' . $search . '%')
                    ->orWhere('residents.middlename', 'like', '%' . $search . '%')
                    ->orWhere('residents.firstname', 'like', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(residents.lastname, ' ', residents.firstname, ' ', residents.middlename) LIKE ?", ['%' . $search . '%']);
            })
            ->orWhere('residents_files.id', 'like', '%' . $search . '%')
            ->whereBetween('residents_files.created_at', [$from, $to])
            ->paginate(10);

        }
        return view('admin.certificate.show',['certificates'=>$certificates]);
    }


    public function showfile(Residents $resident, Files $file){



         $file = ResidentsFiles::where(function($query) use($resident,$file){
            $query->where('resident_id',$resident->id)->where('file_id',$file->id);
        })->first();
       // $file = ResidentsFiles::where('id',$file-)
        // Get the content of the file
        $content = $file->content;

        // Create a Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($content);

        // (Optional) Set options
        $options = new Options();
        $options->set('isPhpEnabled', true); // Enable PHP rendering if your HTML content has PHP code
        $dompdf->setOptions($options);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF inline
       return $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResidentsFiles $certificate)
    {
       ResidentsFiles::destroy($certificate->id);
       return redirect()->back()->with('deleted','Successfully');
    }
}
