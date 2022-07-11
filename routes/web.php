<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Common\DoctorController;
use App\Http\Controllers\Medicine\GenericController;
use App\Http\Controllers\Medicine\StrengthController;
use App\Http\Controllers\Medicine\MedicineTypeController;

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
Route::get('/home', function () 
	{ return view('dashboard');})->name('home')->middleware('auth');



Route::get('/settings', [HomeController::class, 'templateSettings'])->name('company')->middleware('auth');
Route::post('/settingsEdit', [HomeController::class, 'editSettings'])->name('editCompany')->middleware('auth');


Route::get('/manageEmployee', function () { return view('Employee.employeeIndex'); })->name('manageEmployee')->middleware('auth');
Route::get('/allEmployee', [EmployeeController::class, 'index'])->name('allEmployee')->middleware('auth');
Route::post('/saveEmployee', [EmployeeController::class, 'create'])->name('save');
Route::get('/editEmployee', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/updateEmployee', [EmployeeController::class, 'update'])->name('update');
Route::delete('/deleteEmployee', [EmployeeController::class, 'delete'])->name('delete');



Route::get('/manageUser', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::get('/allUser', [UserController::class, 'getAllUser'])->name('allUser')->middleware('auth');
Route::delete('/deleteUser', [UserController::class, 'delete'])->name('deleteUser')->middleware('auth');
Route::get('/editUser', [UserController::class, 'edit'])->name('edit.user');
Route::post('/updateUser', [UserController::class, 'update'])->name('update.user');



Route::get('/manageDoctors', [DoctorController::class, 'index'])->name('doctors')->middleware('auth');
Route::get('/allDoctors', [DoctorController::class, 'getAllDoctor'])->name('allDoctors')->middleware('auth');
Route::post('/saveDoctor', [DoctorController::class, 'create'])->name('save.doctor');
Route::delete('/deleteDoctors', [DoctorController::class, 'delete'])->name('delete.doctor')->middleware('auth');
Route::get('/editDoctors', [DoctorController::class, 'edit'])->name('edit.doctor');
Route::post('/updateDoctors', [DoctorController::class, 'update'])->name('update.doctor');



Route::get('/manageGenerics', [GenericController::class, 'index'])->name('generics')->middleware('auth');
Route::get('/allGenerics', [GenericController::class, 'getAllGeneric'])->name('allGenerics')->middleware('auth');
Route::post('/saveGenerics', [GenericController::class, 'create'])->name('save.generic');
Route::delete('/deleteGenerics', [GenericController::class, 'delete'])->name('delete.generic')->middleware('auth');
Route::get('/editGenerics', [GenericController::class, 'edit'])->name('edit.generic');
Route::post('/updateGenerics', [GenericController::class, 'update'])->name('update.generic');


Route::get('/manageStrength', [StrengthController::class, 'index'])->name('strength')->middleware('auth');
Route::get('/allStrength', [StrengthController::class, 'getAllStrength'])->name('allStrengths')->middleware('auth');
Route::post('/saveStrength', [StrengthController::class, 'create'])->name('save.strength');
Route::delete('/deleteStrength', [StrengthController::class, 'delete'])->name('delete.strength')->middleware('auth');
Route::get('/editStrength', [StrengthController::class, 'edit'])->name('edit.strength');
Route::post('/updateStrength', [StrengthController::class, 'update'])->name('update.strength');


Route::get('/manageMedicineType', [MedicineTypeController::class, 'index'])->name('medicineType')->middleware('auth');
Route::get('/allMedicineType', [MedicineTypeController::class, 'getAllMedicineType'])->name('allMedicineTypes')->middleware('auth');
Route::post('/saveMedicineType', [MedicineTypeController::class, 'create'])->name('save.medicineType');
Route::delete('/deleteMedicineType', [MedicineTypeController::class, 'delete'])->name('delete.medicineType')->middleware('auth');
Route::get('/editMedicineType', [MedicineTypeController::class, 'edit'])->name('edit.medicineType');
Route::post('/updateMedicineType', [MedicineTypeController::class, 'update'])->name('update.medicineType');