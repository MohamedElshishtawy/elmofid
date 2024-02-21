<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Models\EBook;
use \App\Models\Educater;
use \App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class PdfController extends Controller
{
    public function index()
    {

      $pdfs = EBook::all()->groupBy('class');

      return view('educator.pdf.index', [

          'pdfs_1' => $pdfs->get('1', collect()),

          'pdfs_2' => $pdfs->get('2', collect()),

          'pdfs_3' => $pdfs->get('3', collect()),

      ]);

    }

    public function add(int $class)
    {

          return view('educator.pdf.add', [

              'class' => $class,

              'class_human' => Educater::class_human_read($class),

              'groups' => Group::where('class', $class)->get(),

          ]);

    }

    public function uploadPdfForClass(Request $request,int $class)
    {

      $availability = $request->has('availability') ? 1 : 0;
      $request->validate([
        'name' => 'required|string|max:25',
        'pdf' => 'nullable|file',
          'start_date' => 'nullable',
          'end_date' => 'nullable',
        'pdf_url' => ['nullable', 'url', Rule::requiredIf(empty($request->file('pdf')))],
      ]);


        $path = '';

        // Determine if the input is a file or URL
        if ($request->hasFile('pdf')) {

          $pdfFile = $request->file('pdf');

          $location = "pdfs/{$class}/";

          $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

          $path = $pdfFile->storeAs($location, $pdfFileName, 'public');

        } elseif (filter_var($request->input('pdf_url'), FILTER_VALIDATE_URL)) {

          $path = filter_var($request->input('pdf_url'), FILTER_VALIDATE_URL);

        } else {

            return redirect()->back()->with('error', 'Invalid PDF input.');

        }

        // Store data in the EBooks database table
        EBook::create([
          'name' => $request->name,
          'class' => $class,
          'link' => $path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
          'availability' => $availability
        ]);

        return redirect()->route('pdf_index')->with('تم تحميل الكتاب');

    }


    public function edit_pdf(int $class, int $id)
    {
      $pdf = EBook::findOrFail($id);
      return view('educator.pdf.edit', [
          'pdf' => $pdf,
          'availability' => $pdf['availability'],
          'class_human' => Educater::class_human_read($class),
          'class' => $class,
          'start_date' => $pdf['start_date'],
          'end_date' => $pdf['end_date'],

      ]);
    }

    public function save_edit_pdf(Request $request, int $class, int $id)
    {
        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        if (isset($request->start_date) && Carbon::createFromFormat('Y-m-d\TH:i', $request->start_date) !== false) {
            // Parse the date and format it as needed
            $request->start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        }

        if (isset($request->end_date) && Carbon::createFromFormat('Y-m-d\TH:i', $request->end_date) !== false) {
            // Parse the date and format it as needed
            $request->end_date = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        }

        // Find the record
        $pdf = EBook::findOrFail($id);

        // Update the record attributes
        $pdf->name = $request->name;
        $pdf->availability = $availability;
        $pdf->start_date = $request->start_date;
        $pdf->end_date = $request->end_date;

        // Save the changes
        $pdf->save();

        return redirect()->route('pdf_index')->with('success', 'تم تعديل الملف');
    }

    public function delete($class, $pdf_id){

      EBook::findOrFail($pdf_id)->delete();

      return redirect()->back()->with('success', 'تم حذف المذكرة');

    }







}
