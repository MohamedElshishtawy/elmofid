<?php

use App\Http\Controllers\EducaterController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ExamController;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\PdfController;


Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
//
Route::post('auth', [StudentController::class, 'authantication'])->name('auth');
//
Route::prefix('dashboard')->middleware(['auth', 'Educator'])->group(function () {

    Route::post('/upload/{class}/{exam}', [ExamController::class, 'upload_img'])->name('upload_img'); // for edition PAGE exam and data and questions 3



    Route::prefix('groups')->group(function (){

        Route::get('/', [EducaterController::class, 'index'])->name('groups');

        Route::get("/{id}/", [EducaterController::class, 'group_page'])->name('group');

        Route::get('/add_group/{class}', [EducaterController::class, 'add_group'])->name("add_group_page");

        Route::post('/add_group/{class}/store', [EducaterController::class, 'store_group'])->name("add_group_store");

        Route::get("/{id}/add_student", [EducaterController::class, 'add_student_page'])->name('add_student_page');

        Route::post("/{id}/add_student/store", [EducaterController::class, 'add_student_store'])->name('add_student_store');

        Route::get("/{id}/student/{id_student}", [EducaterController::class, 'edit_student_page'])->name('edit_student');

        Route::post("/{id}/student/{id_student}/save", [EducaterController::class, 'edit_student_store'])->name('edit_student_store');

        Route::post("/{id}/student/{id_student}/delete", [EducaterController::class, 'delete_student_store'])->name('delete_student');

        Route::post("/{id}/student/{id_student}/money", [EducaterController::class, 'edit_money'])->name('edit_money');


    });


    Route::prefix('exams')->group(function (){

        Route::get('/', [EducaterController::class, 'exams_page'])->name('exams'); // All Exams Page

        Route::get('/{class}/add', [EducaterController::class, 'exam_data_page'])->name('add_exam'); // add Data Page 1

        Route::post('/{class}/add/saveData', [ExamController::class, 'save_exam_data'])->name('saveData'); // for Save exam  data  only 2

        Route::get('/{class}/edit/{id}', [EducaterController::class, 'edit_exam_page'])->name('edit_exam_page'); // for edition PAGE exam and data and questions 3

        Route::post('/{class}/edit/{id}/save_exam', [ExamController::class, 'save_exam'])->name('save_exam'); // SAVE PAGE exam and data and questions 3

        Route::post('/{class}/edit/{id}/new_save', [ExamController::class, 'new_save'])->name('new_save'); // for edition PAGE exam and data and questions 3

        Route::put('/{class}/edit/{id}/saveEdit', [ExamController::class, 'save_exam'])->name('save_edit_exam'); // for SAVE edition exam and data and questions 4

        Route::post('/{class}/edit/{id}/delete', [ExamController::class, 'delete_exam'])->name('delete_exam'); // Delete Exam

        Route::post('/{class}/edit/{id}/save_questions', [ExamController::class, 'save_questions'])->name('save_questions'); // for SAVE edition exam and data and questions 4

        Route::get('/{id}', [EducaterController::class, 'exam'])->name('exam'); // Degrees

        Route::get('/{id}/degrees', [EducaterController::class, 'degrees_page'])->name('degrees_page');

        Route::get("/{id}/degrees/excel", [EducaterController::class, 'download_excel'])->name('download_excel');

        Route::get('/{id}/degrees/{student_id}', [EducaterController::class, 'educater_show_exam'])->name('educater_show_exam');

    });



    Route::prefix('pdfs')->group(function () {

        Route::get('/', [PdfController::class, 'index'])->name('pdf_index');

        Route::get('/{class}/add', [PdfController::class, 'add'])->name('add_pdf');

        Route::post('/{class}/add/store', [PdfController::class, 'uploadPdfForClass'])->name('store_pdf');

        Route::get('/{class}/edit/{pdf}', [PdfController::class, 'edit_pdf'])->name('edit_pdf');

        Route::post('/{class}/edit/{pdf}/save', [PdfController::class, 'save_edit_pdf'])->name('save_edit_pdf');

        Route::post('/{class}/edit/{pdf}/delete', [PdfController::class, 'delete'])->name('delete_pdf');

    });

    Route::prefix('imgs')->group(function () {

        Route::get('/', [ImageController::class, 'index'])->name('img_index');

        Route::get('/{class}/add', [ImageController::class, 'add'])->name('add_img');

        Route::post('/{class}/add/store', [ImageController::class, 'uploadImgForClass'])->name('store_img');

        Route::get('/{class}/edit/{img}', [ImageController::class, 'edit_img'])->name('edit_img');

        Route::post('/{class}/edit/{img}/save', [ImageController::class, 'save_edit_img'])->name('save_edit_img');

        Route::post('/{class}/edit/{img}/delete', [ImageController::class, 'delete'])->name('delete_img');

    });

    Route::prefix('videos')->group(function () {

        Route::get('/', [VideoController::class, 'index'])->name('video_index');

        Route::get('/{class}/add', [VideoController::class, 'add'])->name('add_video');

        Route::post('/{class}/add/store', [VideoController::class, 'uploadvideoForClass'])->name('store_video');

        Route::get('/{class}/edit/{img}', [VideoController::class, 'edit_video'])->name('edit_video');

        Route::post('/{class}/edit/{img}/save', [VideoController::class, 'save_edit_video'])->name('save_edit_video');

        Route::post('/{class}/edit/{img}/delete', [VideoController::class, 'delete'])->name('delete_video');

    });

    Route::prefix('homework')->group(function () {

        Route::get('/', [HomeworkController::class, 'index'])->name('homework_index');

        Route::get('/{class}/add', [HomeworkController::class, 'add'])->name('add_homework');

        Route::post('/{class}/add/store', [HomeworkController::class, 'uploadhomeworkForClass'])->name('store_homework');

        Route::get('/{class}/edit/{img}', [HomeworkController::class, 'edit_homework'])->name('edit_homework');

        Route::post('/{class}/edit/{img}/save', [HomeworkController::class, 'save_edit_homework'])->name('save_edit_homework');

        Route::post('/{class}/edit/{img}/delete', [HomeworkController::class, 'delete'])->name('delete_homework');

    });



});


Route::prefix('students')->middleware(['auth', 'Student', 'Money'])->group(function () {

    Route::get('/', [StudentController::class, 'index_page'])->name('index');
    Route::get('/not_valid', [StudentController::class, 'not_valid'])->name('not_valid')->middleware('NotValid')->withoutMiddleware('Money');
    Route::get('/{id}/set_data', [StudentController::class, 'set_data'])->name('set_data');
    Route::post('/{id}/set_data/save', [StudentController::class, 'save_data'])->name('save_data');
    Route::get('/{student_id}/exams/{exam_id}', [StudentController::class, 'exam_page'])->name('user');





    Route::prefix('exams')->group(function () {

        Route::get('/', [StudentController::class, 'exams_page'])->name('student_exams');

        Route::get('/{id}', [StudentController::class, 'ready'])->name('ready');

        Route::get('/{id}/do', [StudentController::class, 'do_exam_page'])->name('do_exam')->middleware('PreventBack:id');

        Route::post('/{id}/save_answers', [StudentController::class, 'save_answer'])->name('save_answers');

        Route::get('/{id}/show', [StudentController::class, 'show_exam'])->name('show_exam');

        Route::get('/{id}/study', [StudentController::class, 'study_exam'])->name('study_exam');

    });




    Route::get('/pdfs/', [StudentController::class, 'show_pdfs'])->name('show_pdfs');

    Route::get('/pdfs/{$pdf}', [StudentController::class, 'testme'])->name('testme');

    Route::get('/imgs/', [ImageController::class, 'show_images'])->name('show_images');

    Route::get('/videos/', [VideoController::class, 'show_videos'])->name('show_videos');

    Route::get('/videos/{id}', [VideoController::class, 'show_video'])->name('show_video');


    Route::get('/homework/', [HomeworkController::class, 'show_homeworks'])->name('show_homeworks');

    Route::get('/homework/{id}', [HomeworkController::class, 'show_homework'])->name('show_homework');

    Route::get('/account', [StudentController::class, 'account_page'])->name('account_page');
    Route::post('/account/save', [StudentController::class, 'save_account'])->name('save_account');


    Route::get('analysis', [StudentController::class, 'analysis_page'])->name('analysis_page');


})->middleware(['auth', 'student']);
