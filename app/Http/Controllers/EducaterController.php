<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Student;
use App\Models\Educater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Energy;
use Maatwebsite\Excel\Facades\Excel;
class EducaterController extends Controller
{
    public function index(){
        return view('educator.index', [
            'students_count' => Student::count(),
            'groups_count' => Group::count(),
            'exams_count' => Exam::count(),
            'groups_1' => Group::all()->where('class', '1'),
            'groups_2' => Group::all()->where('class', '2'),
            'groups_3' => Group::all()->where('class', '3')
        ]);
    }

    public function re_money()
    {
        /*DB::update('UPDATE students JOIN groups ON groups.id = students.groups_id SET students.money = 0 WHERE groups.class = ?', [$class]);*/
        DB::update('UPDATE students  SET money = 0 WHERE  code != \'0000\' ');
        return redirect()->back()->with('success', "تم إلغاء إشتراكات ");
    }

    public function logout(){

        Auth::logout();

        return redirect(route("index"));

    }

    public function add_group(int $class){

        return view('educator.add_group',[
            'class' => $class

        ]);
    }

    public function store_group(Request $request){
        $form_filed = $request->validate([
            'name' => 'required',
            'class' => 'required',
        ]);

        $group = Group::create([
            'name' => $request->name,
            'class' => $request->class
        ]);

        return redirect()->route('groups')->with('success','تم إضافة المجموعة بنجاح');
    }

    public function group_page(int $id)
    {
        $group = Group::findOrFail($id);

        $students = Student::where('groups_id', $group->id)
    ->orderBy('money', 'desc') // Order by money in descending order
    ->orderBy('name', 'asc')   // Order by name in ascending order
    ->get();
        // dd($students);
        $payed_students_count = $students->where('money', 1)->count();
        $n_payed_students_count = $students->count() - $payed_students_count;

        return view('educator.group', [
            'data' => [
                'payed' => $payed_students_count,
                'n_payed' => $n_payed_students_count,
                'total' => $students->count(),
                'name' => $group->name,
                'class' => Educater::class_human_read($group->class),
                'group_id' => $group['id'],
                'class_id' => $group->class,
            ],
            'group' => $group,
            'students' => $students,
        ]);

    }


    public function add_student_page(int $group)
    {
        $group = Group::find($group);
        $class = $group['class'];
        return view('educator.add_student', [
            'class' => $class,
            'class_human' => Educater::class_human_read($class),
            'groups' => Group::where('class', $class)->get(),
            'group'=> $group,
            'rand' => rand(1000 , 90000)
        ]);
    }


    public function add_student_store(Request $request)
    {
        $money = $request->has('money') ? 1 : 0;

        // Assuming you have a validation step for the input data
        $validatedData = $request->validate([
            'code' => 'required|unique:students',
            'name' => 'nullable',
            'phone' => 'nullable|digits:11',
            'parent_phone' => 'nullable|digits:11',
            'email' => 'nullable|email',
            'password' => 'required',
            'group' => 'required|exists:groups,id', // Ensure 'group' exists in the 'groups' table
        ]);

        // Create a new student record
        $student = new Student([
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'parent_phone' => $request->input('parent_phone'), // Assuming 'parent_phone' is optional
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'money' => $money,
        ]);

        // Associate the student with a group
        $student->groups()->associate($validatedData['group']); // Assuming 'group' corresponds to 'groups_id'
        $student->save();

        return redirect(route('add_student_page', $validatedData['group']))->with('success', "تم إضافة الطالب ". $validatedData['name']);
    }


    public function edit_student_page(int $group, int $id_student)
    {

        $group = Group::find($group);

        $class = $group['class'];

        $student = Student::findOrFail($id_student);


        return view('educator.edit', [
            'class' => $class,
            'class_human' => Educater::class_human_read($class),
            'groups' => Group::where('class', $class)->get(),
            'group'=> $group,
            'student' => $student,
        ]);
    }


    public function edit_student_store(Request $request, $group, $student)
    {
        $money = $request->has('money') ? 1 : 0;

        // $random_order = isset($form_fields['random_order']) ? ($form_fields['random_order'] == 'on' ? 1 : 0) : 0;


        // Assuming you have a validation step for the input data
        $validatedData = $request->validate([
            'code' => 'required',
            'name' => 'nullable|max:300',
            'phone' => 'nullable:digits:11',
            'parent_phone' => 'nullable:digits:11',
            'email' => 'nullable|email',
            'password' => 'required',
            // 'group' => 'required|exists:groups,id', // Ensure 'group' exists in the 'groups' table
        ]);

        // Create a new student record
        $student = Student::find($student)->update([
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'parent_phone' => $request->input('parent_phone'), // Assuming 'parent_phone' is optional
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'money' => $money,
        ]);

        // Associate the student with a group
        // $student->groups()->associate($validatedData['group']); // Assuming 'group' corresponds to 'groups_id'
        // $student->save();

        return redirect(route('group', $group))->with('success', "تم تعديل الطالب  ". $validatedData['name']);
    }

    public function delete_student_store(int $id, int $id_student){
        $student = Student::find($id_student)->delete();

        return redirect(route('group', $id))->with('success', 'تم حذف الطالب ');
    }


    // Exams Start
    public function exams_page()
    {


        $exams = Exam::all()->groupBy('class');

        return view('educator.exams', [

            'exams_1' => $exams->get('1', collect()),



            'exams_2' => $exams->get('2', collect()),

            'exams_3' => $exams->get('3', collect()),

        ]);


    }

    public function exam_data_page(int $class) // For parameters as name, time, ..act
    {

        return view('educator.exam.add', [

            'class' => $class,

            'class_human' => Educater::class_human_read($class),

        ]);

    }

    public function edit_exam_page(int $class, int $id) // For All Exam Editing Questions And Parameters
    {

        $exam = Exam::where('id', $id)->first();

        $images = ExamController::getAllImages($class, $id);

        return  view('educator.exam.edit', [
            'class'          => $class,
            'class_human'    => Educater::class_human_read($class),
            'exam_id'        => $id,
            'exam'           => [
                                'name' => $exam['name'],
                                'class' => $exam['class'],
                                'duration' => $exam['duration'],
                                'start_date' => $exam['start_date'],
                                'end_date' => $exam['end_date'],
                                'availability' => $exam['availability'],
                                'show_deg' => $exam['show_deg'],
                                'random_order' => $exam['random_order']
                            ],
            'exam_questions' => ExamController::get_questions($id, $class, false),
            'images'         => $images['images'] ?? [], // all images with extention
            'images_names'   => $images['names'] ?? [], // the namy only with out .extention .png
            'obs_names'      => $images['obs_names'] ?? [],
            'obs_images'     => $images['obs_images'] ?? []
        ]);


    }

    // Degrees Page
    public function degrees_page($id)
    {

        $degrees = DB::select("SELECT students.code, students.name, degree, duration, degrees.created_at, students_id
        FROM degrees
        JOIN students ON students.id = degrees.students_id
        WHERE
        degrees.exams_id = ?
        ORDER BY degree Desc, name Asc
        ",
        [$id]
        );

        return view('educator.degrees', [
            'exam_name' => Exam::where('id', $id)->first()['name'],
            "exam_id" => $id,
            'degrees' => $degrees]);

    }

    public function download_excel($group)
    {
        $degrees = DB::select("SELECT students.code, students.name, degree, duration, degrees.created_at, students_id
        FROM degrees
        JOIN students ON students.id = degrees.students_id
        WHERE
        degrees.exams_id = ?
        ORDER BY degree
        ",
            [$group]
        );

        $file_name = 'degrees_' . date('Y-m-d') . '.xls';

        $fields = ['code', 'name', 'degree', 'duration', 'created_at', 'students_id'];

        $excelData = implode("\t", array_values($fields)) . "\n";

        foreach ($degrees as $deg) {
            $line = [$deg->code, $deg->name, $deg->degree, $deg->duration, $deg->created_at, $deg->students_id];
            $excelData .= implode("\t", array_values($line)) . "\n";
        }

        return response()->stream(
            function () use ($excelData) {
                echo $excelData;
            },
            200,
            [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
            ]
        );
    }

    public function edit_money(Request $request, $group, $student)
      {

          $money = filter_var($request->money, FILTER_VALIDATE_BOOLEAN);

          $studentModel = Student::findOrFail($student);

          $studentModel->update(['money' => $money]);

          return response()->json(['status' => 'success']);

      }

    public function educater_show_exam(int $exam_id, int $student_id){

        $class = Exam::where('id', $exam_id)->first()['class'];

        $images = ExamController::getAllImages($class, $exam_id);

        return view('educator.show_exam', [
            'questions' => ExamController::get_questions($exam_id, $class, false),
            'answers' => ExamController::get_answers($exam_id, $student_id, $class, false),
            'exam' => Exam::where('id', $exam_id)->first(),
            'images'         => $images['images'] ?? [], // all images with extention
            'images_names'   => $images['names'] ?? [], // the namy only with out .extention .png
            'obs_names'      => $images['obs_names'] ?? [],
            'obs_images'     => $images['obs_images'] ?? []
        ]);

    }
    // public function export()
    // {
    //     $energy = Energy::orderBy('energyid', 'desc')->get();
    //     return Excel::download($energy, 'users.xlsx');
    // }

}
