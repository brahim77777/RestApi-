<?php

use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\RelationshipController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LoginController;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1' ], function () {


    Route::redirect('lesson', 'lessons');
    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('tags', TagController::class); 
    Route::apiResource('users', UserController::class);

    Route::get('users/{id}/lessons', [RelationshipController::class , 'userLessons']);
    Route::get('lessons/{id}/tags', [RelationshipController::class , 'lessonTags']);
    Route::get('tags/{id}/lessons', [RelationshipController::class , 'tagLessons']);

    Route::get('lesson' , function(){
        return Response::json(['error'=>'Not Found'] , 404);
    });
    Route::get('login' , [LoginController::class , 'login'])->name('login');


});



