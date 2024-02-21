<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Exam;
use App\Models\EBook;
use App\Models\Time;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
// use File;

class StudentController extends Controller
{


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function exam_page()
    {
        return view('student/exam', [
            'exam' => 'exam'
        ]);
    }

    // Auth the user (login)
    public function authantication(Request $request)
    {
        $form_fileds = $request->validate([
            'code' => 'required',
            'password' => 'required'
        ]);
        try {
            $user = Student::where('code', $form_fileds['code'])->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'code' => 'The code is wrong',
                ]);
            }

            if ($form_fileds['password'] != $user->password) { // !password_verify($form_fileds['password'], $user->password)
                throw ValidationException::withMessages([
                    'password' => ['The password is wrong'],
                ]);
            }

            Auth::login($user);
            $request->session()->regenerate();

            if ($request['code'] == 0000) {
                return redirect()->route('groups');
            } else {
                if ($user['name'] && $user['phone']) {
                    if (Auth::user()->money) {
                        return redirect()->route('index');
                    } else {
                        return redirect()->route('not_valid');
                    }
                } else {
                    return redirect()->route('set_data', $user['id']);
                }
            }
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function index_page()
    {
        return view('student.index');
    }


    public function exams_page()
    {
        DB::statement("SET time_zone = '+02:00'");
        $aveleble_exams = DB::select(
            "SELECT * FROM exam
            WHERE
                availability = 1
            AND
                class = ?
            AND id NOT IN (SELECT exams_id FROM degrees WHERE students_id = ?)
            AND
            (
                (exam.start_date <= CURRENT_TIMESTAMP AND exam.end_date >= CURRENT_TIMESTAMP)
                OR (exam.start_date  = '0000-00-00 00:00:00' OR exam.end_date = '0000-00-00 00:00:00')
                OR (exam.start_date IS NULL AND exam.end_date IS NULL)
            )
            AND
                full_mark > 0",

            [Auth::user()->groups->class, Auth::user()->id]
        );
        // dd($aveleble_exams);
        $pased_exams = DB::select(
            "SELECT *
            FROM exam
            WHERE
                availability = 1
            AND
                class = ?
            AND
                end_date < CURRENT_TIMESTAMP
            -- AND    id NOT IN (SELECT exams_id FROM degrees WHERE students_id = ?)
            AND
                full_mark > 0
            ",
            [Auth::user()->groups->class]
        );


        return view('student.exams', [
            'aveleble_exams' => $aveleble_exams,
            'pased_exams' => $pased_exams,
        ]);
    }

    public function ready($id){

        $name_array = explode(' ', Auth::user()->name);

        return view('student.ready', [
            'student_name' => $name_array[0],
            'exam' => Exam::where('id', $id)->first()
        ]);

    }

    public function do_exam_page(int $id)
    {
        $exam_data = Exam::where('id', $id)->first();

        // If he do the exam before
        $degree_before = Degree::where('students_id', Auth::user()->id)
                               ->where('exams_id', $id)
                               ->exists();

        if( $degree_before ){

            return redirect()->route('student_exams')->with('error', 'تم حل الإمتحان من قبل');

        }


        // Get the questions & images
        $questions = ExamController::get_questions($id);  // Delete the at from the array for security

        $images = ExamController::getAllImages(Auth::user()->groups->class, $exam_data['id']);


        /*if ($exam_data['random_order'] == 1) {

            shuffle($questions);
        }*/

        // set timer
        $student = auth()->user();

        $time = Time::where('students_id', $student->id)
            ->where('exams_id', $id)
            ->first();


        if (!$time) {

            $time = Time::create([
                'students_id' => $student->id,
                'exams_id' => $id,
            ]);

        }


        $dateTime = new DateTime($time['created_at']);

        // Format the DateTime object to the desired format
        $formattedDate = $dateTime->format('y-m-d H:i:s');

        return view('student.exam', [
            'exam' => $exam_data,
            'questions' => $questions,
            'start_time' => $formattedDate,
            'images' => $images['images'] ?? [],
            'images_names' => $images['names'] ?? [],
        ]);
    }

    public function save_answer(Request $request, int $id)
    {

        $answers = $request->input('answers');
        $student = auth()->user();

        // Duration
        $start = Time::where('students_id', $student->id)->where('exams_id', $id)->first();

        if ($start) {

            $start = $start->created_at;

            $duration = now()->diffInSeconds($start) / 60; // min

            Time::where('students_id', $student->id)
                ->where('exams_id', $id)
                ->delete();
        } else {
            return redirect()->back()->with('error', 'Error: Start time record not found.');
        }

        // Process or save answers as needed
        $data = ExamController::save_answers($student->groups->class, $id, $student->id, $answers);

        // Set the degree
        $degree = ExamController::get_degree($id , ExamController::get_questions($id), $answers);
        $degree_save = Degree::create([
            'students_id' => $student->id,
            'exams_id' => $id,
            'degree' => $degree,
            'duration' => $duration
        ]);

        // Redirect to the home with a success message
        return redirect(route('index'))->with('success', 'تم حل الإمتحان الحمد لله');
    }


    public function analysis_page()
    {

        // All about the degrrees nad exams
        $student = DB::select("SELECT
    students.name AS name,
    COUNT(degrees.id) AS exams,
    SUM(degrees.degree) AS points,
    ROW_NUMBER() OVER (ORDER BY SUM(degrees.degree) DESC) AS student_order
FROM
    students
JOIN
    degrees ON students.id = degrees.students_id
JOIN
    groups ON groups.id = students.groups_id
JOIN
    exam ON exam.id = degrees.exams_id
WHERE
    students.id = ?
    AND groups.class = ?
    AND exam.show_deg = 1
GROUP BY
    students.id, students.name
ORDER BY
    points DESC",
                        [Auth::user()->id, Auth::user()->groups->class]);
        return view('student.analysis', [
            'exams' => Degree::all()->where('students_id', Auth::user()->id),
            'student' => $student[0]
        ]);
    }

    public function show_exam(int $id)
    {

        $images = ExamController::getAllImages(Auth::user()->groups->class, $id);



        return view('student.show_exam', [
            'questions' => ExamController::get_questions($id),
            'answers' => ExamController::get_answers($id, Auth::user()->id),
            'exam' => Exam::where('id', $id)->first(),
            'images' =>  $images['images'] ?? [],
            'images_names' => $images['names'] ?? [],
            'obs_names'      => $images['obs_names'] ?? [],
            'obs_images'     => $images['obs_images'] ?? [],

        ]);
    }

    public function study_exam(int $id)
    {
        $questions = ExamController::get_questions($id);

        return view('student.show_exam', [
            'questions' => $questions,
            'answers' => array_fill(0, sizeof($questions), 0),
            'exam' => Exam::where('id', $id)->first(),
            'images' =>  $images['images'] ?? [],
            'images_names' => $images['names'] ?? [],
            'obs_names'      => $images['obs_names'] ?? [],
            'obs_images'     => $images['obs_images'] ?? []
        ]);
    }

    public function set_data(int $student_id)
    {
        $student = Student::where('id', $student_id)->first();
        return view('student.set_data', [
            'student_id' => $student_id,
            'student_code' => $student['code'],
            'student_name' => $student['name'] ?? '',
            'student_group' => $student->groups->name
        ]);
    }

    public function save_data(Request $request, int $id)
    {

        $request->validate([
            'name' => 'required|max:300',
            'phone' => 'required|digits:11',
            'parent_phone' => 'nullable|digits:11',
            'email' => 'nullable|email',
        ]);

        Student::where('id', $id)->update($request->only(['name', 'phone', 'parent_phone', 'email']));

        if (Auth::user()->money) {
            return redirect(route('index'))->with(['success' => 'تم حفظ البيانات']);
        } else {
            return redirect()->route('not_valid');
        }
    }


    public function not_valid()
    {

        return view('student.not_valid');
    }




    public function show_pdfs()
    {

        $class =  Auth::user()->groups->class;

        $pdfs = EBook::all()->where('class', $class)->where('availability', 1);

        return view('student.pdfs', [

            'aveleble_pdfs' => $pdfs

        ]);

    }

    public function watch_pdf($pdf_id)
    {

        return "12";

       /* $pdf = EBook::where('id', $pdf_id)->first();

        DB::table('pdf_student')->insert([
            'pdfs_id' => $pdf['id'],
            'studends_id' => Auth::user()->id
        ]);

        if (Str::startsWith($pdf['link'], 'http')){

            return redirect( $aveleble_pfd['link'] );

        }else{

            return redirect( asset('storage/' . $aveleble_pfd['link']) );

        }*/
    }

    public function testme($id)
    {
        return 1;
    }


    public function account_page()
    {
        $id = Auth::user()->id;
        return view('student.account', [
            'student' => Student::WHERE('id', $id)->first(),
        ]);
    }

    public function save_account(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'img' => 'required|file|mimes:jpg,jpeg,png|max:200000', // Allowed image types and max size in kilobytes
        ]);

        // Handle file upload
        if ($request->hasFile('img')) {
            // Get the uploaded file
            $img = $request->file('img');

            // Generate a unique filename
            $filename = Auth::user()->id . '.' . $img->getClientOriginalExtension();

            // Check if an image with the same name (without extension) already exists
            $existingImagePath = storage_path('app/public/students/') . Auth::user()->id;
            $existingImage = File::glob($existingImagePath . '.*');

            if (!empty($existingImage)) {
                // Delete the old image
                File::delete($existingImage[0]);
            }

            // Store the file in the public disk
            $img->storeAs('students', $filename, 'public');

            // You can also store the filename in the database if needed
            // Example: User::find(auth()->id())->update(['img_filename' => $filename]);

            // Return success response or redirect to another page
            return redirect()->route('index')->with("success", 'تم تحميل الصورة بنجاح');
        }

        // If validation fails or file is not present, return an error response
    }

}
