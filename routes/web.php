<?php

use App\Http\Controllers\StudentController;
use App\Models\student;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('index');
// });



Route::get('/',[StudentController::class,'index']);
Route::post('/',[StudentController::class,'create']);
Route::get('/student/delete/{id}',[StudentController::class,'destroy'])->name('student.destroy');
// Route::get('/student/{id}',[StudentController::class,'show'])->name('student.show');    
Route::get('student/{student}',[StudentController::class,'show'])->name('student.show');
Route::put('/student',[StudentController::class,'update'])->name('student.update');
// Route::put('/student/{student}',[StudentController::class,'update'])->name('student.update');
Route::get('/get-more-students',[StudentController::class,'getMoreStudents'])->name('student.get-more-students');

/********************* LiveWire Routes *********************/

// Route::get('/counter',function(){
//     return view('livewire');
// });

// Route::get('/show',function(){
//     return view('livewire-show');
// });