<?php

namespace App\Http\Controllers;


use App\Models\EBook;
use App\Models\Educater;
use App\Models\Group;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index()
    {

        $imgs = Image::all()->groupBy('class');

        return view('educator.img.index', [

            'imgs_1' => $imgs->get('1', collect()),

            'imgs_2' => $imgs->get('2', collect()),

            'imgs_3' => $imgs->get('3', collect()),

        ]);

    }

    public function add(int $class)
    {

        return view('educator.img.add', [

            'class' => $class,

            'class_human' => Educater::class_human_read($class),

            'groups' => Group::where('class', $class)->get(),

        ]);



    }

    public function uploadImgForClass(Request $request,int $class)
    {

        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
            'img' => 'nullable|file',
        ]);


        $path = '';

        // Determine if the input is a file or URL
        if ($request->hasFile('img')) {

            $imgFile = $request->file('img');

            $location = "imgs/{$class}/";

            $imgFileName = time() . '.' . $imgFile->getClientOriginalExtension();

            $path = $imgFile->storeAs($location, $imgFileName, 'public');

        }  else {

            return redirect()->back()->with('error', 'Invalid img input.');

        }

        // Store data in the EBooks database table
        Image::create([
            'name' => $request->name,
            'class' => $class,
            'link' => $path,
            'availability' => $availability
        ]);

        return redirect(route('img_index') )->with('success', 'تم تحميل الصورة بنجاح');

    }


    public function edit_img(int $class, int $id)
    {
        $img = Image::findOrFail($id);
        return view('educator.img.edit', [
            'img' => $img,
            'class_human' => Educater::class_human_read($class),
            'class' => $class
        ]);
    }

    public function save_edit_img(Request $request, int $class, int $id)
    {

        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
        ]);

        $img = Image::findOrFail($id)->update([
            'name' => $request->name,
            'availability' => $availability
        ]);
        return redirect()->route('img_index')->with('success', 'تم تعديل الصورة');
    }

    public function delete($class, $img_id){

        Image::findOrFail($img_id)->delete();

        return redirect()->back()->with('success', 'تم حذف الصورة');

    }


    public function show_images() // For Students
    {

        $class =  Auth::user()->groups->class;

        $imgs = Image::all()->where('class', $class)->where('availability', 1);

        return view('student.img.imgs', [

            'aveleble_imgs' => $imgs

        ]);
        

    }
}
