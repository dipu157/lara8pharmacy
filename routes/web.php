<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Common\DoctorController;
use App\Http\Controllers\Common\ShelfController;
use App\Http\Controllers\Medicine\GenericController;
use App\Http\Controllers\Medicine\StrengthController;
use App\Http\Controllers\Medicine\MedicineTypeController;
use App\Http\Controllers\Accounts\AccountsController;
use App\Http\Controllers\Accounts\IncomeController;
use App\Http\Controllers\Accounts\ExpenseController;
use Illuminate\Routing\RouteGroup;

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

Route::get('/home', function () { return view('dashboard');})->name('home')->middleware('auth');
Route::get('/passwordChange', function () { return view('auth.change-password');})->name('changePassword')->middleware('auth');
Route::post('/updatePass', [HomeController::class, 'updatePassword'])->name('updatePass');
Route::get('/settings', [HomeController::class, 'templateSettings'])->name('company')->middleware('auth');
Route::post('/settingsEdit', [HomeController::class, 'editSettings'])->name('editCompany')->middleware('auth');


// Employee Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageEmployee', function () { return view('Employee.employeeIndex'); })->name('manageEmployee');
	Route::get('/allEmployee', [EmployeeController::class, 'index'])->name('allEmployee');
	Route::post('/saveEmployee', [EmployeeController::class, 'create'])->name('save');
	Route::get('/editEmployee', [EmployeeController::class, 'edit'])->name('edit');
	Route::post('/employeeUpdate', [EmployeeController::class, 'update'])->name('update');
	Route::post('/updateEmployee', [EmployeeController::class, 'updateEmployee'])->name('update.employee');
	Route::delete('/deleteEmployee', [EmployeeController::class, 'delete'])->name('delete');

	Route::get('/updateProfile', [EmployeeController::class, 'profileUpdate'])->name('profile');

});


// User Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageUser', [UserController::class, 'index'])->name('user');
	Route::get('/allUser', [UserController::class, 'getAllUser'])->name('allUser');
	Route::delete('/deleteUser', [UserController::class, 'delete'])->name('deleteUser');
	Route::get('/editUser', [UserController::class, 'edit'])->name('edit.user');
	Route::post('/updateUser', [UserController::class, 'update'])->name('update.user');
});


// Doctor Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageDoctors', [DoctorController::class, 'index'])->name('doctors');
	Route::get('/allDoctors', [DoctorController::class, 'getAllDoctor'])->name('allDoctors');
	Route::post('/saveDoctor', [DoctorController::class, 'create'])->name('save.doctor');
	Route::delete('/deleteDoctors', [DoctorController::class, 'delete'])->name('delete.doctor');
	Route::get('/editDoctors', [DoctorController::class, 'edit'])->name('edit.doctor');
	Route::post('/updateDoctors', [DoctorController::class, 'update'])->name('update.doctor');
});


// Generics Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageGenerics', [GenericController::class, 'index'])->name('generics');
	Route::get('/allGenerics', [GenericController::class, 'getAllGeneric'])->name('allGenerics');
	Route::post('/saveGenerics', [GenericController::class, 'create'])->name('save.generic');
	Route::delete('/deleteGenerics', [GenericController::class, 'delete'])->name('delete.generic');
	Route::get('/editGenerics', [GenericController::class, 'edit'])->name('edit.generic');
	Route::post('/updateGenerics', [GenericController::class, 'update'])->name('update.generic');
});


// Strength Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageStrength', [StrengthController::class, 'index'])->name('strength');
Route::get('/allStrength', [StrengthController::class, 'getAllStrength'])->name('allStrengths');
	Route::post('/saveStrength', [StrengthController::class, 'create'])->name('save.strength');
Route::delete('/deleteStrength', [StrengthController::class, 'delete'])->name('delete.strength');
	Route::get('/editStrength', [StrengthController::class, 'edit'])->name('edit.strength');
	Route::post('/updateStrength', [StrengthController::class, 'update'])->name('update.strength');
});


// Medicine Type Route
Route::group(['middleware' => ['auth']], function () {

Route::get('/manageMedicineType', [MedicineTypeController::class, 'index'])->name('medicineType');
	Route::get('/allMedicineType', [MedicineTypeController::class, 'getAllMedicineType'])->name('allMedicineTypes');
	Route::post('/saveMedicineType', [MedicineTypeController::class, 'create'])->name('save.medicineType');
	Route::delete('/deleteMedicineType', [MedicineTypeController::class, 'delete'])->name('delete.medicineType');
	Route::get('/editMedicineType', [MedicineTypeController::class, 'edit'])->name('edit.medicineType');
	Route::post('/updateMedicineType', [MedicineTypeController::class, 'update'])->name('update.medicineType');
});

// Shelf Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageShelf', [ShelfController::class, 'index'])->name('shelf');
	Route::get('/allShelf', [ShelfController::class, 'getAllShelf'])->name('allShelf');
	Route::post('/saveShelf', [ShelfController::class, 'create'])->name('save.Shelf');
	Route::delete('/deleteShelf', [ShelfController::class, 'delete'])->name('delete.Shelf');
	Route::get('/editShelf', [ShelfController::class, 'edit'])->name('edit.Shelf');
	Route::post('/updateShelf', [ShelfController::class, 'update'])->name('update.Shelf');
});

// Income-Expense Route
Route::group(['middleware' => ['auth']], function () {

    Route::get('/openingBalanceIndex', [AccountsController::class, 'index'])->name('openingBalance');
    Route::post('/openingBalanceSave', [AccountsController::class, 'create'])->name('save.openBalance');

	Route::get('/otherIncomeIndex', [IncomeController::class, 'index'])->name('otherIncome');

    Route::get('/otherExpenseIndex', [ExpenseController::class, 'index'])->name('otherExpense');
});


