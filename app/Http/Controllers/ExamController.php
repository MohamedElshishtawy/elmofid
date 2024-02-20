<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ExamController extends Controller
{
    function deleteAllFilesInDirectory($directory)
    {
        if (is_dir($directory)) {
            $files = glob($directory . '/*');

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        return true;
    }

    /*
    public function upload_img(Request $request, $class, $id)
    {

        $location = storage_path('app/public/exams/' . $class . '/' . $id . '/questions/images');

        $this->deleteAllFilesInDirectory($location);

        foreach ($request->files as $imageName => $img)
        {

            // Extract the question index from the image name
            $questionIndex = substr($imageName, 3); // img32 => 32

            $name = substr($imageName, 0, 3); // img

            if ($img->isValid()) {

                $imgExtension = $img->getClientOriginalExtension();

                // Check if the image name starts with 'obs'
                if ($name == 'obs') {

                    // Modify the file location for 'obs' images
                    $fileLocation = 'exams/' . $class . '/' . $id . '/questions/images/q_obs_' . $questionIndex . '.' . $imgExtension;

                } else {

                    // Use the existing file location for other images
                    $fileLocation = 'exams/' . $class . '/' . $id . '/questions/images/q_img_' . $questionIndex . '.' . $imgExtension;


                }

                $path = Storage::disk('public')->put($fileLocation, file_get_contents($img->getRealPath()));

            } else {

                return 'Invalid file.';

            }
        }

        return redirect()->back()->with('success', "تم حفظ الإمتحان");
    }
    */

    public function new_save(Request $request, $class, $id)
    {
        /**What Is the steps for this method [V2 (Update the exam)] [12-2-2024]
         * collect all questions, answers, at, images, images for obs
         * Note: at in js file is arranges according to qCounter so when you delelte a question in the middle there will be a gap between index
         * rearrange the at
         * Note: when we updatet for v3 you will not be able to rearrange the (at) int this simple way
         * check images:
         *      if there is image in the input => upload it, store it in uploaded array
         *      if there is value in the input =>            store it in uploaded array
         *      if there is no thing no thing will done
         * now we upladed all new images and remian the neaded old images
         * delete other elements
         * return to the exam with message
         */

        if (!isset($request['q']) || sizeof($request['q']) == 0) {
            return 'There are no questions';
        }

        $exam = [];

        $uploaded_images = [];

        $directory = 'exams/' . $class . '/' . $id . '/questions/images';

        $at = array_values($request['at']); // Rearrange 'at' according to the key

        $fullmark = array_sum($request['deg']);

        $set_Deg = Exam::where('id', $id)->update(['full_mark' => $fullmark]);


        for ($i = 0; $i < sizeof($request['q']); $i++) {

            $img_path = '';

            $obs_path = '';

            $question_img = $request->file('img')[$i] ?? ($request['img'][$i] ?? '');

            $obs_img = $request->file('obsImg')[$i] ?? ($request['obsImg'][$i] ?? '');

            // For Images
            if ($question_img instanceof \Illuminate\Http\UploadedFile) {
                $img_new_name = 'q_' . $i . '_' . time() . '.' . $question_img->getClientOriginalExtension(); // q_1_3442311.png

                $img_path = $question_img->storeAs($directory, $img_new_name, 'public');

                $paths_array = explode('/', $img_path);

                $uploaded_images[] = array_pop($paths_array); // Save the [name.png] only not the path
            } elseif ($question_img) {
                $img_paths = explode('/', $question_img);

                $uploaded_images[] = array_pop($img_paths);

                $img_path = $question_img;
            }
            // For Obs Images
            if ($obs_img instanceof \Illuminate\Http\UploadedFile) {
                $img_new_name = 'o_' . $i . '_' . time() . '.' . $obs_img->getClientOriginalExtension(); // q_1_3442311.png

                $obs_path = $obs_img->storeAs($directory, $img_new_name, 'public');

                $img_paths = explode('/', $obs_path);

                $uploaded_images[] = array_pop($img_paths);
            } elseif ($obs_img) {
                $img_paths = explode('/', $obs_img);

                $uploaded_images[] = array_pop($img_paths);

                $obs_path = $obs_img;
            }

            $exam[] = [
                'deg' => $request['deg'][$i],
                'q' => $request['q'][$i],
                'img' => $img_path,
                'a0' => $request['a0'][$i],
                'a1' => $request['a1'][$i],
                'a2' => $request['a2'][$i],
                'a3' => $request['a3'][$i],
                'at' => $at[$i],
                'obs' => $request['obs'][$i] ?? '',
                'obsImg' => $obs_path,
            ];
        }

        // Storing the exam in the file
        try {
            $this->save_in_file($exam, $id, $class);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء حفظ الإمتحان: ' . $e->getMessage());
        }

        // Delete the old Images
        $location = 'exams/' . $class . '/' . $id . '/questions/images';

        if (is_dir($directory)) {
            $files = glob($directory . '/*');

            foreach ($files as $file) {
                if (!in_array($file, $uploaded_images)) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'تم حفظ الإمتحان');
    }

    public function upload_img($files, $class, $id)
    {
        // no need
        $location = storage_path('app/public/exams/' . $class . '/' . $id . '/questions/images');

        $this->deleteAllFilesInDirectory($location);

        foreach ($files as $imageName => $img) {
            // Extract the question index from the image name
            $questionIndex = substr($imageName, 3); // img32 => 32

            $name = substr($imageName, 0, 3); // img

            if ($img->isValid()) {

                $imgExtension = $img->getClientOriginalExtension();

                // Check if the image name starts with 'obs'
                if ($name == 'obs') {
                    // Modify the file location for 'obs' images
                    $fileLocation = 'exams/' . $class . '/' . $id . '/questions/images/q_obs_' . $questionIndex . '.' . $imgExtension;
                } else {
                    // Use the existing file location for other images
                    $fileLocation = 'exams/' . $class . '/' . $id . '/questions/images/q_img_' . $questionIndex . '.' . $imgExtension;
                }

                $path = Storage::disk('public')->put($fileLocation, file_get_contents($img->getRealPath()));
            } else {
                return 'Invalid file.';
            }
        }

        return redirect()->back()->with('success', 'تم حفظ الإمتحان');
    }

    public static function getAllImages($class, $id)
    {
        // no need
        $location = storage_path('app/public/exams/' . $class . '/' . $id . '/questions/images');

        // Check if the directory exists
        if (!is_dir($location)) {
            // Handle the case where the directory does not exist
            return [
                'error' => 'Directory not found',
            ];
        }

        $files = scandir($location);
        $fileNames = array_diff($files, ['.', '..']);

        $result = [
            'names' => [],
            'images' => [],
            'obs_names' => [],
            'obs_images' => [],
        ];

        foreach ($fileNames as $fileName) {
            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);

            if (strpos($nameWithoutExtension, 'q_img_') === 0) {
                $result['names'][] = $nameWithoutExtension;

                $result['images'][] = $fileName;
            } elseif (strpos($nameWithoutExtension, 'q_obs_') === 0) {
                $result['obs_names'][] = $nameWithoutExtension;

                $result['obs_images'][] = $fileName;
            }
        }

        return $result;
    }

    public function add_page(int $class)
    {
        // Add Exam Page
        /** How I save exams
         * We save exams [questions, images, student_answers] in php file
         * The files in public/exams/class
         * Questions location: exam_id/questions/questions.php
         * Question images location: exam_id/imgs/*.jpg
         * Student Answers location: exam_id/answers/studet_id*.php
         * =====
         * Why we store in php files?
         * becouse the questions are many data and i don't good at data structure and algorithism
         * q
        img
        a0
        a1
        a2
        a3
        at
        obs
        obsImg
         *
         *  */
        return view('educator/exam/add', [
            'class' => $class,
        ]);
    }

    public function save_in_file($data, $file_id, $class)
    {
        $data_to_serialize = serialize($data);
        $location = 'exams/' . $class . '/' . $file_id . '/questions/questions' . '.php';
        Storage::disk('local')->put($location, "<?php return '" . $data_to_serialize . "';");

        return $data_to_serialize;
    }

    public function save_exam_data(Request $request, int $class)
    {
        // save name and another parameters AS NEW
        $form_fields = [];

        $form_fields = $request->validate([
            'duration' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'name' => 'required|string',
            'random_order' => 'nullable',
            'show_deg' => 'nullable',
            'availability' => 'nullable',
        ]);

        $random_order = isset($form_fields['random_order']) ? ($form_fields['random_order'] == 'on' ? 1 : 0) : 0;

        $availability = isset($form_fields['availability']) ? ($form_fields['availability'] == 'on' ? 1 : 0) : 0;

        $show_deg = isset($form_fields['show_deg']) ? ($form_fields['show_deg'] == 'on' ? 1 : 0) : 0;

        try {
            // Log the validated form fields for debugging
            $exam = Exam::create([
                'name' => $form_fields['name'],
                'class' => $class,
                'duration' => $form_fields['duration'],
                'start_date' => $form_fields['start_date'],
                'end_date' => $form_fields['end_date'],
                'availability' => $availability,
                'show_deg' => $show_deg,
                'random_order' => $random_order,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error saving the exam: ' . $e->getMessage());
        }

        return redirect(route('edit_exam_page', [$class, $exam->id]))->with('success', 'تم تحديد الإمتحان بنجاح.. ضع الأسئلة');
    }

    public function save_exam(Request $request, int $class, int $id)
    {
        // save name and another parameters AS UPDATING
        $data = $request;

        $questions = $request['exam'];

        $exam = Exam::find($id);

        if (!$exam) {
            return 0;
        }
        // Edit Random order & show_deg fileds from the form
        $availability = isset($request['availability']) ? ($request['availability'] == 'on' ? 1 : 0) : 0;

        $random_order = isset($request['random_order']) ? ($request['random_order'] == 'on' ? 1 : 0) : 0;

        $show_deg = isset($request['show_deg']) ? ($request['show_deg'] == 'on' ? 1 : 0) : 0;

        $exam->update([
            'name' => $data['name'],
            'class' => $class,
            'duration' => $data['duration'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'random_order' => $random_order,
            'availability' => $availability,
            'show_deg' => $show_deg,
        ]);

        return redirect()->back();
    }

    public function save_questions(Request $request, int $class, int $id)
    {
        $questions = $request->input('exam');

        $exam = Exam::find($id);

        if (!$exam) {
            return 0;
        }

        $this->save_in_file($questions, $id, $class);
    }

    public static function get_questions($exam_id, $class = 0, $student = true)
    {
        if ($student) {
            $class = Auth::user()->groups->class;
        }

        $filePath = 'exams/' . $class . '/' . $exam_id . '/questions/questions.php';

        // Check if the file exists
        if (Storage::disk('local')->exists($filePath)) {
            $path = storage_path('app/' . $filePath);
            $exam = include $path;
            return unserialize($exam);
        }

        return 0;
    }

    public static function get_answers($exam_id, $student_id, $class = 0, $student = true)
    {
        if ($student) {
            $class = Auth::user()->groups->class;
        }

        $filePath = 'exams/' . $class . '/' . $exam_id . '/answers/' . $student_id . '.php';
        if ( Storage::disk('local')->exists($filePath) ) {
            $path = storage_path('app/' . $filePath);
            $exam = include $path;
            return unserialize($exam);
        }
        return 0;
    }

    public static function save_answers($class, $exam_id, $student_id, $answers)
    {
        // FOR STUNDENTS
        $data_to_serialize = serialize($answers);
        $location = 'exams/' . $class . '/' . $exam_id . '/answers/' . $student_id . '.php';
        Storage::disk('local')->put($location, "<?php return '" . $data_to_serialize . "';");
        return $data_to_serialize;
    }

    public static function get_degree($exam_id, $exam_questions, $answers)
    {
        try {
            $full_mark = Exam::findOrFail($exam_id)->full_mark;
        } catch (ModelNotFoundException $e) {
            // Handle the case when the exam with the given ID is not found
            // For example, you might want to log an error or return a default value
            return 0;
        }

        $n = 0;
        $degree = $full_mark;

        foreach ($exam_questions as $question) {
            if ( ($question['at']) != ( $answers[$n++] ?? 0 )) {
                $degree -= (int)$question['deg'];
            }
        }

        return $degree;
    }

    public function delete_exam(int $class, int $exam)
    {

        Exam::find($exam)->delete();

        // Delete exam file
        $examFileLocation = 'exams/' . $class . '/' . $exam . '/questions/questions.php';
        Storage::disk('local')->delete($examFileLocation);

        // Delete answers files
        $answersFileLocation = 'exams/' . $class . '/' . $exam . '/answers/';
        Storage::disk('local')->deleteDirectory($answersFileLocation);

        // Delete images
        $imagesLocation = 'exams/' . $class . '/' . $exam . '/images/';
        Storage::disk('public')->deleteDirectory($imagesLocation);

        return redirect()->back()->with('success', 'تم حذف الإمتحان');
    }
}
