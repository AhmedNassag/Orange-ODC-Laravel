<?php

use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Api\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Api\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Api\Admin\RevisionController as AdminRevisionController;
use App\Http\Controllers\Api\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\WrongController as AdminWrongController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\TrainerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//Auth apis
Route::group(['middleware' => 'api','prefix' => 'auth'], function($router)
{
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});



//User must be have token to be able to visit these apis
Route::group(['middleware' => 'JwtMiddleware'],function()
{
    //users api
    Route::get('/users',[UserController::class,'index']);
    Route::get('/user/{id}',[UserController::class,'show']);
    Route::get('/userCourses/{id}',[UserController::class,'userCourses']);
    Route::get('/userRevisions/{id}',[UserController::class,'userRevisions']);
    Route::get('/successStudent',[UserController::class,'successStudent']);
    Route::get('/failingStudents',[UserController::class,'failingStudents']);

    //courses api
    Route::get('/courses',[CourseController::class,'index']);
    Route::get('/course/{id}',[CourseController::class,'show']);
    Route::get('/courseByCategory/{id}',[CourseController::class,'courseByCategory']);

    //categories api
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/category/{id}',[CategoryController::class,'show']);

    //trainers api
    Route::get('/trainers',[TrainerController::class,'index']);
    Route::get('/trainer/{id}',[TrainerController::class,'show']);

    //exams api
    Route::get('/exams',[ExamController::class,'index']);
    Route::get('/exam/{id}',[ExamController::class,'show']);
    Route::get('/examCourse/{id}',[ExamController::class,'examCourse']);
    Route::get('/examQuestions/{id}',[ExamController::class,'examQuestions']);
    Route::get('/examRevisions/{id}',[ExamController::class,'examRevisions']);

    //questions api
    Route::get('/questions',[QuestionController::class,'index']);
    Route::get('/question/{id}',[QuestionController::class,'show']);
    Route::get('/questionWrongs/{id}',[QuestionController::class,'questionWrongs']);
    Route::get('/questionExam/{id}',[QuestionController::class,'questionExam']);
});



############################## Start Admin Api ##############################
//user api
Route::get('/users',[AdminUserController::class,'index']);
Route::get('/user/{id}',[AdminUserController::class,'show']);
Route::post('/users',[AdminUserController::class,'store']);
Route::post('/users/{id}',[AdminUserController::class,'update']);
Route::post('/user/{id}',[AdminUserController::class,'destroy']);

//category api
Route::get('/categories',[AdminCategoryController::class,'index']);
Route::get('/category/{id}',[AdminCategoryController::class,'show']);
Route::post('/category',[AdminCategoryController::class,'store']);
Route::post('/categories/{id}',[AdminCategoryController::class,'update']);
Route::post('/category/{id}',[AdminCategoryController::class,'destroy']);

//courses api
Route::get('/courses',[AdminCourseController::class,'index']);
Route::get('/course/{id}',[AdminCourseController::class,'show']);
Route::post('/course',[AdminCourseController::class,'store']);
Route::post('/courses/{id}',[AdminCourseController::class,'update']);
Route::post('/course/{id}',[AdminCourseController::class,'destroy']);

//trainers api
Route::get('/trainers',[AdminTrainerController::class,'index']);
Route::get('/trainer/{id}',[AdminTrainerController::class,'show']);
Route::post('/trainer',[AdminTrainerController::class,'store']);
Route::post('/trainers/{id}',[AdminTrainerController::class,'update']);
Route::post('/trainer/{id}',[AdminTrainerController::class,'destroy']);

//exams api
Route::get('/exams',[AdminExamController::class,'index']);
Route::get('/exam/{id}',[AdminExamController::class,'show']);
Route::post('/exam',[AdminExamController::class,'store']);
Route::post('/exams/{id}',[AdminExamController::class,'update']);
Route::post('/exam/{id}',[AdminExamController::class,'destroy']);

//questions api
Route::get('/questions',[AdminQuestionController::class,'index']);
Route::get('/question/{id}',[AdminQuestionController::class,'show']);
Route::post('/question',[AdminQuestionController::class,'store']);
Route::post('/questions/{id}',[AdminQuestionController::class,'update']);
Route::post('/question/{id}',[AdminQuestionController::class,'destroy']);

//wrongs api
Route::get('/wrongs',[AdminWrongController::class,'index']);
Route::get('/wrong/{id}',[AdminWrongController::class,'show']);
Route::post('/wrong',[AdminWrongController::class,'store']);
Route::post('/wrongs/{id}',[AdminWrongController::class,'update']);
Route::post('/wrong/{id}',[AdminWrongController::class,'destroy']);

//revisions api
Route::get('/revisions',[AdminRevisionController::class,'index']);
Route::get('/revision/{id}',[AdminRevisionController::class,'show']);
Route::post('/revision',[AdminRevisionController::class,'store']);
Route::post('/revisions/{id}',[AdminRevisionController::class,'update']);
Route::post('/revision/{id}',[AdminRevisionController::class,'destroy']);

Route::get('/successStudent',[AdminRevisionController::class,'successStudent']);
Route::get('/failingStudents',[AdminRevisionController::class,'failingStudents']);
############################## Start Admin Api ##############################
