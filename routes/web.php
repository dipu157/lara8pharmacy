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
use App\Http\Controllers\Medicine\MedicineController;
use App\Http\Controllers\Accounts\AccountsController;
use App\Http\Controllers\Accounts\IncomeController;
use App\Http\Controllers\Accounts\ExpenseController;
use App\Http\Controllers\Authorization\RolesController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\Customer_ledgerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Inventory\InventoryController;
use App\Http\Controllers\Report\ReportController;
use App\Models\User;
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

// Common Route
Route::group(['middleware' => ['auth']], function () {

    Route::view('home','dashboard');

    Route::get('/home', function () { return view('dashboard');})->name('home');
    Route::get('/passwordChange', function () { return view('auth.change-password');})->name('changePassword');
    Route::post('/updatePass', [HomeController::class, 'updatePassword'])->name('updatePass');
    Route::get('/settings', [HomeController::class, 'templateSettings'])->name('company');
    Route::post('/settingsEdit', [HomeController::class, 'editSettings'])->name('editCompany');
});

// Authorization Route
Route::group(['middleware' => ['auth']], function () {
    Route::get('/createRollIndex', [RolesController::class, 'rollIndex'])->name('create.roll');
    Route::get('/allRoll', [RolesController::class, 'fetchRoll'])->name('allRolls');
    Route::post('/saveRoll', [RolesController::class, 'saveRoll'])->name('save.roll');

	Route::get('/createPermissionIndex', [RolesController::class, 'permissionIndex'])->name('create.permission');
    Route::get('/allPermission', [RolesController::class, 'fetchPermission'])->name('allPermission');
    Route::post('/savePermission', [RolesController::class, 'savePermission'])->name('save.permission');

	Route::get('/rollPermissionIndex', [RolesController::class, 'rollPermissionIndex'])->name('roll.permission');
	Route::post('/updateRolePermission', [RolesController::class, 'UpdateRolePermission'])->name('updateRolePermission');

	Route::get('/userPermissionIndex', [RolesController::class, 'userPermissionIndex'])->name('user.permission');
	Route::get('/getallUsers', [RolesController::class, 'getallUsers'])->name('allUsers');
});

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
    Route::post('/register', [UserController::class, 'store'])->name('register');
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

// Accounts/Income-Expense Route
Route::group(['middleware' => ['auth']], function () {

    Route::get('/openingBalanceIndex', [AccountsController::class, 'index'])->name('openingBalance');
    Route::post('/openingBalanceSave', [AccountsController::class, 'create'])->name('save.openBalance');

	Route::get('/otherIncomeIndex', [IncomeController::class, 'index'])->name('otherIncome');
	Route::get('/getAllIncomes', [IncomeController::class, 'fetchAll'])->name('allIncomes');
	Route::post('/otherIncomeCreate', [IncomeController::class, 'create'])->name('save.otherIncome');

    Route::get('/otherExpenseIndex', [ExpenseController::class, 'index'])->name('otherExpense');
    Route::get('/getAllExpense', [ExpenseController::class, 'fetchAll'])->name('allExpenses');
    Route::post('/otherExpenseCreate', [ExpenseController::class, 'create'])->name('save.otherExpense');
});

// Customer Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageCustomer', [CustomerController::class, 'index'])->name('customerIndex');
	Route::get('/allCustomer', [CustomerController::class, 'getAllCustomer'])->name('allCustomers');
	Route::post('/saveCustomer', [CustomerController::class, 'create'])->name('save.Customer');
	Route::get('/editCustomer', [CustomerController::class, 'edit'])->name('edit.Customer');
    Route::post('/updateCustomer', [CustomerController::class, 'update'])->name('update.Customer');

    Route::get('/customerLedger', [Customer_ledgerController::class, 'index'])->name('customerLedger');
    Route::get('/allCustomersLedger', [Customer_ledgerController::class, 'fatchAll'])->name('allCustomersLedger');
});

// Supplier Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageSupplier', [SupplierController::class, 'index'])->name('manageSupplier');
	Route::get('/allSupplier', [SupplierController::class, 'getAllSupplier'])->name('allSuppliers');
	Route::post('/saveSupplier', [SupplierController::class, 'create'])->name('save.Supplier');
	Route::delete('/deleteSupplier', [SupplierController::class, 'delete'])->name('delete.Supplier');
	Route::get('/editSupplier', [SupplierController::class, 'edit'])->name('edit.Supplier');
	Route::post('/updateSupplier', [SupplierController::class, 'update'])->name('update.Supplier');

    Route::get('/manageSupplierLedger', [SupplierController::class, 'supplierLedgerIndex'])->name('supplierLedger');
    Route::get('/allSupplierLedger', [SupplierController::class, 'fetchAll'])->name('allSuppliersLedger');

	Route::get('/invoicesBySupplier', [SupplierController::class, 'invoiceDetails'])->name('supplierAllInvoice');
    Route::get('/billSupplier', [SupplierController::class, 'bill'])->name('bill.Supplier');
    Route::post('/paySupplier', [SupplierController::class, 'pay'])->name('pay.Supplier');
});


// Medicine Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/manageMedicine', [MedicineController::class, 'index'])->name('manageMedicine');
	Route::get('/allMedicine', [MedicineController::class, 'getAllMedicine'])->name('allMedicine');
	Route::post('/saveMedicine', [MedicineController::class, 'create'])->name('save.Medicine');
	Route::get('/editMedicine', [MedicineController::class, 'edit'])->name('edit.Medicine');
	Route::post('/updateMedicine', [MedicineController::class, 'update'])->name('update.Medicine');
});

// Purchase Route
Route::group(['middleware' => ['auth']], function () {
    Route::get('/createPurchase', [PurchaseController::class, 'index'])->name('createPurchase');
    Route::post('/purchaseReview', [PurchaseController::class, 'purchaseReview'])->name('purchaseReview');
    Route::get('/GetMedicineBySupplierid', [PurchaseController::class, 'medicinebysupplierId'])->name('medicineBySupplier');
    Route::post('/purchaseFinalSave', [PurchaseController::class, 'purchaseSave'])->name('purchaseFinalSave');


    // Purchase Details Route
    Route::get('/purchaseHistory', [PurchaseController::class, 'purchaseHistoryIndex'])->name('purchaseHistory');
    Route::get('/allPurchase', [PurchaseController::class, 'getallPurchase'])->name('allPurchase');
    Route::get('/invoiceDetailsByinvoice', [PurchaseController::class, 'invoiceDetails'])->name('invoiceDetails');

    // Purchase Return Route
    Route::get('/returnPurchase', [PurchaseController::class, 'purchaseReturn'])->name('purchaseReturn');
    Route::post('/searchInvoice', [PurchaseController::class, 'invoiceSearch'])->name('searchInvoice');
    Route::post('/purchaseReturn', [PurchaseController::class, 'purchaseReturnSave'])->name('savePurchaseReturn');
});

// Sales Route
Route::group(['middleware' => ['auth']], function () {

	Route::get('/createSales', [SalesController::class, 'index'])->name('createSales');
	Route::post('/GetCustomerInfobyId', [SalesController::class, 'customerById'])->name('GetCustomerId');
	Route::get('/GetcustomerBalance', [SalesController::class, 'customerBalancebyID'])->name('customerBalance');
	Route::get('/AllsalesHistory', [SalesController::class, 'allSale'])->name('salesHistory');
	Route::get('/Allsales', [SalesController::class, 'allSalelist'])->name('allSale');
    Route::get('/saleinvoiceDetails', [SalesController::class, 'invoiceDetails'])->name('saleInvoiceDetails');


    Route::get('/getSpecificMedicine', [SalesController::class, 'specificMedicine'])->name('getSpecificMedicine');
    Route::post('/addMedicinetorow', [SalesController::class, 'medicineTorow'])->name('addMedicinetorow');
    Route::post('/getMedicineAutoComp', [SalesController::class, 'medicineAuTorow'])->name('getMedicineauto');
    Route::get('/getsimilarGenericMed', [SalesController::class, 'similarGenericMed'])->name('similarGenericMed');
    Route::post('/posInvoiceSave', [SalesController::class, 'sellMedicine'])->name('savePosInvoice');


    // Sates Return Route
    Route::get('/salesReturn', [SalesController::class, 'returnMedicine'])->name('salesReturn');
    Route::post('/searchSaleInvoice', [SalesController::class, 'invoiceSearch'])->name('searchSaleInvoice');
    Route::post('/saveSalesReturn', [SalesController::class, 'salesReturnSave'])->name('saveSalesReturn');
});

// Inventory Route
Route::group(['middleware' => ['auth']], function () {
    Route::get('/medicineStock', [InventoryController::class, 'index'])->name('medicineStock');
    Route::get('/shortStock', [InventoryController::class, 'shortStockMedicine'])->name('shortStock');
    Route::get('/outStock', [InventoryController::class, 'outStockMedicine'])->name('outStock');
    Route::get('/expiredMedicine', [InventoryController::class, 'expiredMedicineList'])->name('expiredMedicine');
    Route::get('/soonExpiredMedicine', [InventoryController::class, 'soonExpiredMedicineList'])->name('soonExpiredMedicine');
});

// Report Route
Route::group(['middleware' => ['auth']], function () {
    Route::get('/otherReportIndex', [ReportController::class, 'otherIndex'])->name('otherReport');
});

