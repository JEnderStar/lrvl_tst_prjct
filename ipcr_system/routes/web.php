<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/registeraccount', [App\Http\Controllers\RegisterController::class, 'createAccount']);

// For Employee View
Route::middleware(['role.access:employee'])->group(function () {
    Route::get('/employee', [App\Http\Controllers\IPCRFormController::class, 'EmployeeIPCRFormList']);
    Route::post('/employee', [App\Http\Controllers\IPCRFormController::class, 'EmployeeStoreIPCRForm']);
    Route::get('/employee/create', [App\Http\Controllers\IPCRFormController::class, 'EmployeeCreateIPCRForm']);
    Route::get('/employee/{employee}', [App\Http\Controllers\IPCRFormController::class, 'EmployeeViewIPCRForm']);
    Route::get('/employee/{employee}/edit', [App\Http\Controllers\IPCRFormController::class, 'EmployeeEditIPCRForm']);
    Route::match(['put', 'patch'], '/employee/{employee}', [App\Http\Controllers\IPCRFormController::class, 'EmployeeUpdateIPCRForm']);
    Route::post('/deleteform/{id}', [App\Http\Controllers\IPCRFormController::class, 'EmployeeDeleteIPCRForm']);

    //print
    Route::post("/printform/{id}", [App\Http\Controllers\PDFController::class, "printform"])->name("printform");
});

// For HR View
Route::middleware(['role.access:hr'])->group(function () {
    // Read and Update IPCR Form
    Route::get('/hr', [App\Http\Controllers\IPCRFormController::class, 'HRListIPCRForm']);
    Route::get('/hr/{hr}/edit', [App\Http\Controllers\IPCRFormController::class, 'HRViewIPCRForm']);
    Route::match(['put', 'patch'], '/hr/{hr}', [App\Http\Controllers\IPCRFormController::class, 'HRUpdateIPCRForm']);
    
    // Create Schedule Form
    Route::get('/hr/create', [App\Http\Controllers\ScheduleController::class, 'createSchedule']);
    Route::post('hr', [App\Http\Controllers\ScheduleController::class, 'storeSchedule']);
});

// For Division Chief View
Route::middleware(['role.access:division_chief'])->group(function () {
    // For Approving IPCR Form
    Route::get('/approvedc', [App\Http\Controllers\IPCRFormController::class, 'DCListPendingIPCRForm']);
    Route::get('/approvedc/{approvedc}/edit', [App\Http\Controllers\IPCRFormController::class, 'DCEditPendingIPCRForm']);
    Route::match(['put', 'patch'], '/approvedc/{approvedc}', [App\Http\Controllers\IPCRFormController::class, 'DCUpdatePendingIPCRForm']);
    
    // For Grading IPCR Form
    Route::get('/gradedc', [App\Http\Controllers\IPCRFormController::class, 'DCListGradingIPCRForm']);
    Route::get('/gradedc/{gradedc}/edit', [App\Http\Controllers\IPCRFormController::class, 'DCEditGradingIPCRForm']);
    Route::match(['put', 'patch'], '/gradedc/{gradedc}', [App\Http\Controllers\IPCRFormController::class, 'DCUpdateGradingIPCRForm']);
    
});

// For Director View
Route::middleware(['role.access:director'])->group(function () {
    Route::get('/approvedir', [App\Http\Controllers\IPCRFormController::class, 'DirectorListGradedIPCRForm']);
    Route::get('/approvedir/{approvedir}/edit', [App\Http\Controllers\IPCRFormController::class, 'DirectorEditGradedIPCRForm']);
    Route::match(['put', 'patch'], '/approvedir/{approvedir}', [App\Http\Controllers\IPCRFormController::class, 'DirectorUpdateGradedIPCRForm']);
});

Auth::routes();
