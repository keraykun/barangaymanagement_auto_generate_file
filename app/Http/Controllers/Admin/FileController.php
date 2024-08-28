<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\BarangayTraits;
use App\Models\Files;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\File;

//use Barryvdh\DomPDF\Facade as PDF;

class FileController extends Controller
{
    use BarangayTraits;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.file');
    }

    public function index()
    {
       // phpinfo();
         $files = Files::where('barangay_id',$this->BarangayID())
         ->where('status',1)
         ->get();
        return view('admin.file.index',['files'=>$files]);
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
        //return $request->file;

        $request->validate([
            'name'=>['required','string'],
            'price'=>['required'],
            'file' => ['required','mimes:doc,docx,xml'] // Allowed file types: DOCX and DOC
        ]);
        $originalName = $request->file('file')->getClientOriginalName();
        $timestamp = now()->timestamp;
        $filename = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $newFilename = $filename . '_' . $timestamp . '.' . $extension;

        // Move the uploaded file to the public/files directory with the new filename
        $request->file('file')->move(public_path('files'), $newFilename);

        Files::create([
            'barangay_id'=>$this->BarangayID(),
            'name'=>$request->name,
            //'otr'=>$request->otr,
            'price'=>$request->price,
            'content'=>$newFilename,
        ]);

        // Redirect the user to the public/files directory
        return redirect()->back()->with('success','File has been Upladed');
    }

    /**
     * Display the specified resource.
     */

    public function show(Files $file)
    {
        $filePath = public_path('files/'.$file->content);
        $phpWord = IOFactory::load($filePath);
        $tempHtmlFile = tempnam(sys_get_temp_dir(), 'phpword');
        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save($tempHtmlFile);
        $docxContent = file_get_contents($tempHtmlFile);
        return view('admin.file.show', ['docxContent' => $docxContent]);

    }


    // public function show(Files $file)
    // {
    //     $filePath = public_path('files/'.$file->content);
    //     $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
    //     $search = 'LEONARDO RILE ALMERO JR';
    //     $replace = 'JOHN DOE';
    //     foreach ($phpWord->getSections() as $section) {
    //         foreach ($section->getElements() as $element) {
    //             if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
    //                 $element->setText(str_replace($search, $replace, $element->getText()));
    //             }
    //         }
    //     }
    //     $tempHtmlFile = tempnam(sys_get_temp_dir(), 'phpword');
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    //     $objWriter->save($tempHtmlFile);
    //     $docxContent = file_get_contents($tempHtmlFile);
    //     return view('admin.file.show', ['docxContent' => $docxContent]);
    // }



    // public function show(Files $file)
    // {

    //     Settings::setOutputEscapingEnabled(true);
    //     Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
    //     Settings::setPdfRendererName('DomPDF');


    //     $filePath = public_path('files/'.$file->content);
    //     $phpWord = IOFactory::load($filePath);


    //     $tempFilePath = tempnam(sys_get_temp_dir(), 'phpword_') . '.pdf';
    //     $phpWord->save($tempFilePath, 'PDF');


    //     $pdfContent = file_get_contents($tempFilePath);


    //     unlink($tempFilePath);

    //     return response($pdfContent, 200)
    //         ->header('Content-Type', 'application/pdf')
    //         ->header('Content-Disposition', 'inline; filename="business.pdf"');
    // }

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
    public function update(Request $request, Files $file)
    {


        $request->validate([
            'name'=>['required','string'],
            'price'=>['required'],
        ]);

        Files::where('id',$file->id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
        ]);

        return redirect()->back()->with('updated','File has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Files $file)
    {

        $filePath = public_path('files/' . $file->content);

    //     if (File::exists($filePath)) {
    //         File::delete($filePath);
    //     }

    //    Files::destroy($file->id);

      Files::where('id',$file->id)->update(['status'=>0]);

        return redirect()->back()->with('deleted', 'deleted');
    }
}
