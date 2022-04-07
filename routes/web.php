<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WrongController;
use App\Http\Controllers\RevisionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Auth::routes();
Route::get('/home', [HomeController::class,'index'])->name('home');


############################## Start Admin Routes ##############################
Route::get('admin/login',[AdminController::class,'login']);
Route::post('admin/check-admin',[AdminController::class,'checkAdmin'])->name('check-admin');

Route::group(['middleware'=>['auth:admin']],function ()
{
    //Routes That Related With Admin Model
    Route::get('/admins',[AdminController::class,'index']);
    Route::get('/admin-create',[AdminController::class,'create']);
    Route::post('/admin-store',[AdminController::class,'store']);
    Route::get('/admin-edit/{id}',[AdminController::class,'edit']);
    Route::post('/admin-update/{id}',[AdminController::class,'update']);
    Route::get('/admin-delete/{id}',[AdminController::class,'delete']);

    //Routes That Related With SubAdmin Model
    Route::get('/subAdmins',[SubAdminController::class,'index']);
    Route::get('/subAdmin-create',[SubAdminController::class,'create']);
    Route::post('/subAdmin-store',[SubAdminController::class,'store']);
    Route::get('/subAdmin-edit/{id}',[SubAdminController::class,'edit']);
    Route::post('/subAdmin-update/{id}',[SubAdminController::class,'update']);
    Route::get('/subAdmin-delete/{id}',[SubAdminController::class,'delete']);

    //Routes That Related With User Model
    Route::get('/users',[UserController::class,'index']);

    //Routes That Related With Category Model
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/category-create',[CategoryController::class,'create']);
    Route::post('/category-store',[CategoryController::class,'store']);
    Route::get('/category-edit/{id}',[CategoryController::class,'edit']);
    Route::post('/category-update/{id}',[CategoryController::class,'update']);
    Route::get('/category-delete/{id}',[CategoryController::class,'delete']);

    //Routes That Related With Course Model
    Route::get('/courses',[CourseController::class,'index']);
    Route::get('/course-create',[CourseController::class,'create']);
    Route::post('/course-store',[CourseController::class,'store']);
    Route::get('/course-edit/{id}',[CourseController::class,'edit']);
    Route::post('/course-update/{id}',[CourseController::class,'update']);
    Route::get('/course-delete/{id}',[CourseController::class,'delete']);

    //Routes That Related With Trainer Model
    Route::get('/trainers',[TrainerController::class,'index']);
    Route::get('/trainer-create',[TrainerController::class,'create']);
    Route::post('/trainer-store',[TrainerController::class,'store']);
    Route::get('/trainer-edit/{id}',[TrainerController::class,'edit']);
    Route::post('/trainer-update/{id}',[TrainerController::class,'update']);
    Route::get('/trainer-delete/{id}',[TrainerController::class,'delete']);

    //Routes That Related With Exam Model
    Route::get('/exams',[ExamController::class,'index']);
    Route::get('/exam-create',[ExamController::class,'create']);
    Route::post('/exam-store',[ExamController::class,'store']);
    Route::get('/exam-edit/{id}',[ExamController::class,'edit']);
    Route::post('/exam-update/{id}',[ExamController::class,'update']);
    Route::get('/exam-delete/{id}',[ExamController::class,'delete']);

    //Routes That Related With Question Model
    Route::get('/questions',[QuestionController::class,'index']);
    Route::get('/question-create',[QuestionController::class,'create']);
    Route::post('/question-store',[QuestionController::class,'store']);
    Route::get('/question-edit/{id}',[QuestionController::class,'edit']);
    Route::post('/question-update/{id}',[QuestionController::class,'update']);
    Route::get('/question-delete/{id}',[QuestionController::class,'delete']);

    //Routes That Related With Wrong Model
    Route::get('/wrongs',[WrongController::class,'index']);
    Route::get('/wrong-create',[WrongController::class,'create']);
    Route::post('/wrong-store',[WrongController::class,'store']);
    Route::get('/wrong-edit/{id}',[WrongController::class,'edit']);
    Route::post('/wrong-update/{id}',[WrongController::class,'update']);
    Route::get('/wrong-delete/{id}',[WrongController::class,'delete']);

    //Routes That Related With Wrong Model
    Route::get('/revisions',[RevisionController::class,'index']);
    Route::get('/revision-create',[RevisionController::class,'create']);
    Route::post('/revision-store',[RevisionController::class,'store']);
    Route::get('/revision-edit/{id}',[RevisionController::class,'edit']);
    Route::post('/revision-update/{id}',[RevisionController::class,'update']);
    Route::get('/revision-delete/{id}',[RevisionController::class,'delete']);
});
############################## End Admin Routes ##############################



############################## Start Sub Admin Routes ##############################
// Route::get('subAdmin/login',[SubAdminController::class,'login']);
// Route::post('subAdmin/check-subAdmin',[SubAdminController::class,'checkSubAdmin'])->name('check-subAdmin');

// Route::group(['middleware'=>['auth:subAdmin']],function ()
// {
//     //Routes That Related With Admin Model
//     Route::get('/admins',[AdminController::class,'index']);

//     //Routes That Related With SubAdmin Model
//     Route::get('/subAdmins',[SubAdminController::class,'index']);

//     //Routes That Related With User Model
//     Route::get('/users',[UserController::class,'index']);

//     //Routes That Related With Category Model
//     Route::get('/categories',[CategoryController::class,'index']);

//     //Routes That Related With Course Model
//     Route::get('/courses',[CourseController::class,'index']);

//     //Routes That Related With Trainer Model
//     Route::get('/trainers',[TrainerController::class,'index']);

//     //Routes That Related With Exam Model
//     Route::get('/exams',[ExamController::class,'index']);

//     //Routes That Related With Question Model
//     Route::get('/questions',[QuestionController::class,'index']);

//     //Routes That Related With Wrong Model
//     Route::get('/wrongs',[WrongController::class,'index']);

//     //Routes That Related With Wrong Model
//     Route::get('/revisions',[RevisionController::class,'index']);
//     Route::get('/revision-create',[RevisionController::class,'create']);
//     Route::post('/revision-store',[RevisionController::class,'store']);
//     Route::get('/revision-edit/{id}',[RevisionController::class,'edit']);
//     Route::post('/revision-update/{id}',[RevisionController::class,'update']);
//     Route::get('/revision-delete/{id}',[RevisionController::class,'delete']);
// });
############################## End  Sub Admin Routes ##############################