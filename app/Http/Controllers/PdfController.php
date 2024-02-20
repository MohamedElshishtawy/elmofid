<?php

namespace App\Http\Controllers;


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
          'availability' => $availability
        ]);

        return redirect()->route('pdf_index')->with('تم تحميل الكتاب');

    }


    public function edit_pdf(int $class, int $id)
    {
      $pdf = EBook::findOrFail($id);
      return view('educator.pdf.edit', [
          'pdf' => $pdf,
          'class_human' => Educater::class_human_read($class),
          'class' => $class
      ]);
    }

    public function save_edit_pdf(Request $request, int $class, int $id)
    {

      $availability = $request->has('availability') ? 1 : 0;

      $request->validate([
        'name' => 'required|string|max:25',
      ]);

      $pdf = EBook::findOrFail($id)->update([
        'name' => $request->name,
        'availability' => $availability
      ]);
      return redirect()->route('pdf_index')->with('success', 'تم تعديل الملف');
    }

    public function delete($class, $pdf_id){

      EBook::findOrFail($pdf_id)->delete();

      return redirect()->back()->with('success', 'تم حذف المذكرة');

    }







}
