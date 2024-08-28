<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Barangays;
use App\Models\Districts;
use App\Models\Files;
use App\Models\Municipal;
use App\Models\Officials;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Residents;
use App\Models\ResidentsFiles;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Carbon;
use App\Models\OfficialsPositions;


class ResidentsListController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('check.resident');
     }


    public function storefile(Request $request){

      //  return $request;
        $fileContent = $request->input('content');
        $resident = $request->input('resident');
        $file = $request->input('file');
        $otr = $request->input('otr');
        $fileID = $request->input('fileID');
        $prepared = $request->input('prepared');
        $price = $request->input('price');

        //dd(' filecontent' .$fileContent. ' resident'. $resident. ' otr'. $otr. ' fileID'. $fileID. 'prepared'. $prepared. 'price'. $price);
        $file = ResidentsFiles::create([
            'resident_id'=>$resident,
            'file_id'=>$fileID,
            //'name'=>$file,
            'otr'=>$otr,
            'content'=>$fileContent,
            'price'=>$price,
            'user_id'=>$prepared
        ]);
        $file = $file->id;
        return response()->json(['success' => true,'resident'=>$resident,'file'=>$file]);
    }

    public function reprint(Request $request, ResidentsFiles $file){

        $kagawads = [];
        $kapitan = [];
        $secretarys = [];
        $treasurers =[];

        $activeKapitan = [];
        $activeKagawad = [];
        $activeSecretary = [];
        $activeTreasurer = [];

         $users = OfficialsPositions::where('barangay_id',$this->BarangayID())
        ->with(['position','official'])->get();

        $active = OfficialsPositions::where('barangay_id',$this->BarangayID())
        ->whereHas('official',function($query){
            $query->where('is_active','yes');
        })
        ->with(['position','official'])->get();


        foreach ($users as $key => $user) {
            $tempArray = [];
            if($user->position->name=="Kapitan"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $tempArray['is_active'] = $user->official->is_active;
                $kapitan[] = $tempArray;
            }
            if($user->position->name=="Secretary"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $tempArray['is_active'] = $user->official->is_active;
                $secretary[] = $tempArray;
            }
            if($user->position->name=="Treasurer"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $tempArray['is_active'] = $user->official->is_active;
                $treasurer[] = $tempArray;
            }
            if($user->position->name=="Kagawad"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $tempArray['is_active'] = $user->official->is_active;
                $kagawads[] = $tempArray;
            }
        }


        /*Kapitan*/
        foreach ($kapitan as $kap) {
            if($kap['is_active'] == 'Yes'){
                $activeKapitan = $kap['name'];
            }
        }
        $content = $file->content;
        $kapitanNames = array_column($kapitan, 'name');
        foreach ($kapitanNames as $name) {
            $content = str_replace($name, $activeKapitan, $content);
        }
        /*kapitan*/

         /*kagawad*/
         foreach ($kagawads as $kag) {

            if($kag['is_active'] == 'Yes'){
                $activeKagawad = $kag['name'];
            }
        }
        $kagawadNames = array_column($kagawads, 'name');
        foreach ($kagawadNames as $name) {
            $content = str_replace($name, $activeKagawad, $content);
        }
        /*kagawad*/


        /*secretary*/
          foreach ($secretarys as $sec) {

            if($sec['is_active'] == 'Yes'){
                $activeSecretary = $sec['name'];
            }
        }
        $secretaryNames = array_column($secretarys, 'name');
        foreach ($secretaryNames as $name) {
            $content = str_replace($name, $activeSecretary, $content);
        }
        /*secretary*/


        /*treasurer*/
        foreach ($treasurers as $trea) {

            if($trea['is_active'] == 'Yes'){
                $activeTreasurer = $trea['name'];
            }
        }
        $treasurerNames = array_column($treasurers, 'name');
        foreach ($treasurerNames as $name) {
            $content = str_replace($name, $activeTreasurer, $content);
        }
        /*treasurer*/

        //return $file;

        ResidentsFiles::create([
            'resident_id'=>$file->resident_id,
            'file_id'=>$file->file_id,
            // 'name'=>$file->name,
            'price'=>$request->price,
            'otr'=>$file->otr,
            'content'=>$content,
            'created_at'=>$file->created_at,
            'user_id'=>$file->user_id,
            'reprint'=>'Reprint',
        ]);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($content);

        $options = new Options();
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        $dompdf->render();
        return $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }

    public function showfile(ResidentsFiles $file){

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
     * Display the specified resource.
     */
    public function viewfile(Files $file, Residents $resident)
    {


        $kagawads = [];
        $kapitan = [];
        $secretary = [];
        $treasurer =[];

         $users = OfficialsPositions::where('barangay_id',$this->BarangayID())
        ->whereHas('official',function($query){
            $query->where('is_active','yes');
        })
        ->with(['position','official'])->get();


        foreach ($users as $key => $user) {
            $tempArray = [];
            if($user->position->name=="Kapitan"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $kapitan = $tempArray;
            }
            if($user->position->name=="Secretary"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $secretary = $tempArray;
            }
            if($user->position->name=="Treasurer"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $treasurer = $tempArray;
            }
            if($user->position->name=="Kagawad"){
                $tempArray['picture'] = $user->official->image;
                $tempArray['role'] = $user->position->name;
                $tempArray['name'] = $user->official->firstname.' '.$user->official->middlename.' '.$user->official->lastname;
                $kagawads = $tempArray;
            }
        }


        $name = ' '.$resident->lastname.' '.$resident->firstname.' , '.$resident->middlename.' ';
        $filePath = public_path('files/'.$file->content);
        $phpWord = IOFactory::load($filePath);

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $text) {
                        $newText = str_replace('_', $name, $text->getText(), $count);
                        if ($count ==1) {
                            $text->setText($newText);
                        }
                        $newTextKagawd = str_replace('KAGAWAD',$kagawads['name']??'_______________', $text->getText(), $count);
                        if ($count ==1) {
                            $text->setText($newTextKagawd);
                        }

                        $newTextKapitan = str_replace('KAPITAN',$kapitan['name']??'_______________', $text->getText(), $count);
                        if ($count ==1) {
                            $text->setText($newTextKapitan);
                        }

                        $newTextTreasurer = str_replace('TREASURER',$treasurer['name']??'_______________', $text->getText(), $count);
                        if ($count ==1) {
                            $text->setText($newTextTreasurer);
                        }

                        $newTextSecretary = str_replace('SECRETARY',$secretary['name']??'_______________', $text->getText(), $count);
                        if ($count ==1) {
                            $text->setText($newTextSecretary);
                        }
                    }
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $newText = str_replace('_', $name, $element->getText(), $count);
                    if ($count ==1) {
                        $element->setText($newText);
                    }
                    $newTextKagawd = str_replace('KAGAWAD', $kagawads['name']??'_______________', $text->getText(), $count);
                    if ($count ==1) {
                        $text->setText($newTextKagawd);
                    }

                    $newTextKapitan = str_replace('KAPITAN',$kapitan['name']??'_______________', $text->getText(), $count);
                    if ($count ==1) {
                        $text->setText($newTextKapitan);
                    }

                    $newTextTreasurer = str_replace('TREASURER',$treasurer['name']??'_______________', $text->getText(), $count);
                    if ($count ==1) {
                        $text->setText($newTextTreasurer);
                    }

                    $newTextSecretary = str_replace('SECRETARY',$secretary['name']??'_______________', $text->getText(), $count);
                    if ($count ==1) {
                        $text->setText($newTextSecretary);
                    }
                }
            }
        }


        $tempHtmlFile = tempnam(sys_get_temp_dir(), 'phpword');
        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save($tempHtmlFile);
        $docxContent = file_get_contents($tempHtmlFile);
        $kapitan = $kapitan['name'];
        return view('admin.list.show', ['docxContent' => $docxContent, 'resident' => $resident, 'file' => $file,'kapitan'=>$kapitan]);
    }

    public function display($resident)
    {

        $filename = $resident;
        $docxPath = public_path("files/{$filename}");

        if (file_exists($docxPath)) {
            $phpWord = IOFactory::load($docxPath);
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');


            $tempFile = tempnam(sys_get_temp_dir(), 'phpword');


            $htmlWriter->save($tempFile);


            $htmlContent = file_get_contents($tempFile);

            $htmlContent = preg_replace('/\n+/', "\n", $htmlContent);
            unlink($tempFile);


            return view('admin.list.upload', compact('htmlContent'));
        }

        return 'error';
    }

    public function upload(Request $request){

        $request->validate([
            'docx_file' => 'required|mimes:docx|max:10240',
        ]);


         $file = $request->file('docx_file');
         $user_id = $request->user_id;

         // Append a timestamp to the original file name
         $timestamp = now()->timestamp;
         $fileNameWithTimestamp = $timestamp . '_' . $file->getClientOriginalName();


        // Store the file and get its path
       // $filePath = $file->storeAs('docx_files', $fileNameWithTimestamp);
       $file->move(public_path('files'), $fileNameWithTimestamp);

        ResidentsFiles::create([
            'resident_id'=>$request->resident_id,
            'name' => $fileNameWithTimestamp,
            // Add other fields as needed
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully');

      //  return view('admin.list.upload', ['filePath' => $filePath]);
    }


    public function index(Request $request)
    {


        $barangay = $this->BarangayID();

        $residents =  Residents::whereHas('district',function($where) use($barangay){
            return $where->where('barangay_id',$barangay);
        })->with('district.barangay')->orderBy('lastname',
        'asc')->paginate(20);

        if($request->search!=''){
            $search = $request->search;
            $residents =  Residents::where(function($where) use($search,$barangay){
                $where->where('firstname','like','%'.$search.'%')->where('barangay_id',$barangay);
            })
            ->orWhere(function($where)  use($search,$barangay){
                $where->where('middlename','like','%'.$search.'%')->where('barangay_id',$barangay);
            })
            ->orWhere(function($where)  use($search,$barangay){
                $where->where('lastname','like','%'.$search.'%')->where('barangay_id',$barangay);
            })
            ->orWhere(function($where)  use($search,$barangay){
                $where->where('gender','like','%'.$search.'%')->where('barangay_id',$barangay);
            })
            ->orWhere(function($where)  use($search,$barangay){
                $where->where('contact','like','%'.$search.'%')->where('barangay_id',$barangay);
            })
            ->orWhereHas('district',function($where) use($barangay,$search){
                 $where->where(function($query) use($barangay,$search){
                    $query->where('barangay_id',$barangay)
                    ->where('name','like','%'.$search.'%');
                });
            })
            ->orderBy('lastname',
            'asc')->paginate(20);
        }

        if ($request->gender != '') {
            $gender = $request->gender;
            $residents = Residents::whereHas('district', function ($where) use ($barangay) {
                    $where->where('barangay_id', $barangay);
                })
                ->where('gender',$gender)
                ->with('district.barangay')
                ->orderBy('lastname',
                'asc')->paginate(20);
        }

        if ($request->from_age != '' && $request->to_age != ''  && $request->gender=='') {
            //return 'empty gender';
            $fromAge = (int)$request->input('from_age');
            $toAge = (int)$request->input('to_age');

            $residents = Residents::whereHas('district', function ($where) use ($barangay) {
                    $where->where('barangay_id', $barangay);
                })
                ->whereBetween('age', [$fromAge, $toAge]) // Corrected the order of age boundaries
                ->with('district.barangay')
                ->orderBy('lastname',
                'asc')->paginate(20);
        }

        if ($request->from_age != '' && $request->to_age != '' && $request->gender!='') {

            $fromAge = (int)$request->input('from_age');
            $toAge = (int)$request->input('to_age');
             $gender = $request->gender;
             $residents = Residents::whereHas('district', function ($where) use ($barangay) {
                    $where->where('barangay_id', $barangay);
                })
                ->where(function($query) use($fromAge,$toAge,$gender){
                    $query->whereBetween('age', [$fromAge, $toAge])
                    ->where('gender',$gender);
                })
                ->with('district.barangay')
                ->orderBy('lastname',
                'asc')->paginate(20);
        }



        return view('admin.list.index',['residents'=>$residents]);
    }

    public function detail(Residents $resident){

         $files = Files::where('status',1)->where('barangay_id',$this->BarangayID())->get();
          $contents = ResidentsFiles::where("resident_id",$resident->id)->with('file')->get();
        $resident = Residents::where('id',$resident->id)
        ->with(['district.barangay.municipal','allfiles'])
        ->first();
        abort_if($this->BarangayID()!=$resident->district->barangay->id,500);
        return view('admin.list.detail',['resident'=>$resident,'files'=>$files,'contents'=>$contents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = Districts::where('barangay_id',$this->BarangayID())->get();
        return view('admin.list.create',['districts'=>$districts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $birthdate = Carbon::parse($request->birthdate);
        $age = $birthdate->diffInYears(Carbon::now('Asia/Manila'));
        $request->merge([
            'barangay_id'=>$this->BarangayID(),
            'district_id'=>$request->district_id,
            'is_active'=>'Yes',
            'image'=>'noimage.jpg',
            'age'=>$age+1,
        ]);

        $validate = $request->validate([
            'firstname'=>[Rule::unique('residents')->where(function ($query) use ($request) {
                return $query
                ->where('firstname',$request->firstname)
                ->where('middlename',$request->middlename)
                ->where('lastname',$request->lastname);
            }),
            'required','min:3'],
            'barangay_id'=>['required'],
            'middlename'=>['required','min:3'],
            'lastname'=>['required','min:3'],
            'birthdate'=>['required'],
            'contact'=>['required','min:11'],
            'gender'=>['required'],
            'district_id'=>['required'],
            'status'=>['required'],
            'is_active'=>['required'],
            'image'=>['required'],
            'age'=>['required'],
        ],[
            'firstname' => $request->firstname.' '.$request->middlename.' '.$request->lastname.' , Already exist cannot be duplicate.',
        ]);


        DB::transaction(function () use($validate){
            Residents::create($validate);
        });
        return redirect()->route('admin.residentlist.index')->with('success','New Resident has been Added !');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residents $residentlist)
    {
        $resident = Residents::where('barangay_id',$this->BarangayID())->where('district_id',$residentlist->district_id)->first();
        // if($resident!=$residentlist){
        //     return redirect()->route('admin.error301');
        // }

        $session = $this->BarangaySession();
        $provinces = Province::all();
        $municipals = Municipal::where('province_id',$session->municipal->province->id)->get();
        $barangays =  Barangays::where('municipal_id',$session->municipal->id)->get();
        $districts = Districts::where('barangay_id',$this->barangayID())->get();
        $resident = Residents::where('id',$residentlist->id)
        ->with(['district.barangay.municipal.province'])
        ->first();

        return view('admin.list.edit',[
            'resident'=>$resident,
            'provinces'=>$provinces,
            'municipals'=>$municipals,
            'barangays'=>$barangays,
            'districts'=>$districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residents $residentlist)
    {
       // return $request;


       $request->validate([
         'municipal_id'=>['required'],
         'barangay_id'=>['required'],
         'district_id'=>['required'],
         'firstname'=>['required'],
         'middlename'=>['required'],
         'middlename'=>['required'],
         'birthdate'=>['required'],
         'contact'=>['required'],
         'gender'=>['required'],
       ]);


       if($request->file('image')!=null ){
            if($request->old_image!='noimage.jpg'){
                if(file_exists(public_path('images/residents/'.$request->old_image))){
                    unlink(public_path('images/residents/'.$request->old_image));
                }
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/residents'), $imageName);
            Residents::where('id',$residentlist->id)->update([
                'barangay_id'=>$request->barangay_id,
                'district_id'=>$request->district_id,
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'middlename'=>$request->middlename,
                'birthdate'=>$request->birthdate,
                'contact'=>$request->contact,
                'status'=>$request->status,
                'gender'=>$request->gender,
                'image'=>$imageName
            ]);
        }else{
            Residents::where('id',$residentlist->id)->update([
                'barangay_id'=>$request->barangay_id,
                'district_id'=>$request->district_id,
                'firstname'=>$request->firstname,
                'middlename'=>$request->middlename,
                'middlename'=>$request->middlename,
                'birthdate'=>$request->birthdate,
                'contact'=>$request->contact,
                'status'=>$request->status,
                'gender'=>$request->gender,
            ]);
        }

        // $resident = Residents::where('barangay_id',$this->BarangayID())->where('district_id',$residentlist->district_id)->first();
        // if($resident!=$residentlist){
        //     return redirect()->route('admin.error301');
        // }
        return redirect()->back()->with('updated','Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Residents $residentlist)
    {
        Residents::destroy($residentlist->id);
        return redirect()->route('admin.residentlist.index')->with('deleted',$residentlist->firstname.' '.$residentlist->middlename.' '.$residentlist->lastname);
    }

    public function province(String $resident){
      $municipal = Municipal::where('province_id',$resident)->get();
      return response()->json($municipal);
    }

    public function municipal(String $resident){
        $barangay = Barangays::where('municipal_id',$resident)->get();
        return response()->json($barangay);
    }

    public function barangay(String $resident){
        $barangay = Districts::where('barangay_id',$resident)->get();
        return response()->json($barangay);
    }
}
