<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () { return view('auth.login'); });
Route::view('home','dashboard')->middleware('auth');
Route::get('/home', function () { return view('dashboard'); })->name('home')->middleware('auth');



Route::get('/settings', [HomeController::class, 'templateSettings'])->name('company')->middleware('auth');
Route::post('/settingsEdit', [HomeController::class, 'editSettings'])->name('editCompany')->middleware('auth');


Route::get('/manageEmployee', function () { return view('Employee.employeeIndex'); })->name('manageEmployee')->middleware('auth');
Route::get('/allEmployee', [EmployeeController::class, 'index'])->name('allEmployee')->middleware('auth');
Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
