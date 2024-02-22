<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Educater;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomeworkController extends Controller
{
    public function index()
    {

        $homeworks = Homework::all()->groupBy('class');

        return view('educator.homework.index', [

            'homeworks_1' => $homeworks->get('1', collect()),

            'homeworks_2' => $homeworks->get('2', collect()),

            'homeworks_3' => $homeworks->get('3', collect()),

        ]);

    }

    public function add(int $class)
    {

        return view('educator.homework.add', [

            'class' => $class,

            'class_human' => Educater::class_human_read($class),

            'groups' => Group::where('class', $class)->get(),

        ]);

    }

    public function uploadhomeworkForClass(Request $request,int $class)
    {

        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'nullable|max:255',
            'homework' => 'nullable|file',
        ]);

        // Determine if the input is a file or URL
        if ($request->hasFile('homework')) {

            $imgFile = $request->file('homework');

            $location = "homeworks/{$class}/";

            $imgFileName = time() . '.' . $imgFile->getClientOriginalExtension();

            $path = $imgFile->storeAs($location, $imgFileName, 'public');

        }


        // Store data in the Homeworks database table
        Homework::create([
            'name' => $request->name,
            'description' => $request->description,
            'class' => $class,
            'link' => $path ?? '',
            'availability' => $availability
        ]);

        return redirect()->route('homework_index')->with('success', 'تم تحميل الواجب');

    }


    public function edit_homework(int $class, int $id)
    {

        $homework = Homework::findOrFail($id);



        return view('educator.homework.edit', [
            'homework' => $homework,
            'class_human' => Educater::class_human_read($class),
            'class' => $class
        ]);
    }

    public function save_edit_homework(Request $request, int $class, int $id)
    {
        $homework = Homework::findOrFail($id);

        $availability = $request->has('availability') ? 1 : 0;

        $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'nullable|max:255',
            'homework' => 'nullable|file',
        ]);

        if ($request->hasFile('homework')) {
            // Delete the old homework file
            if ($homework->link) {
                Storage::disk('public')->delete($homework->link);
            }

            // Upload the new homework file
            $imgFile = $request->file('homework');
            $location = "homeworks/{$class}/";
            $imgFileName = time() . '.' . $imgFile->getClientOriginalExtension();
            $path = $imgFile->storeAs($location, $imgFileName, 'public');

            $homework->update(['link' => $path]);

        }

        // Update the homework record with the new information
        $homework->update([
            'name' => $request->name,
            'availability' => $availability,
            'description' => $request->description,
        ]);

        return redirect()->route('homework_index')->with('success', 'تم تعديل الواجب');
    }


    public function delete($class, $homework_id){

        Homework::findOrFail($homework_id)->delete();

        return redirect()->back()->with('success', 'تم حذف الواجب');

    }

    public function show_homeworks() // For Students
    {

        $class =  Auth::user()->groups->class;

        $homeworks = Homework::all()->where('class', $class)->where('availability', 1);

        return view('student.homework.homeworks', [

            'aveleble_homeworks' => $homeworks

        ]);


    }

    public function show_homework(int $homework)
    {
        $homework = Homework::where('id', $homework)->first();

        return view('student.homework.homework', [
            'homework' => $homework,
        ]);

    }

}
