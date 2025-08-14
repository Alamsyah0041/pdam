<?php

use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\LaporanBulananController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokasiInstalasiController;
use App\Http\Controllers\LaporanHarianLabController;
use App\Http\Controllers\LaporanBulananLabController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleOrPermissionController;


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
    if(auth()->check()) {
        return redirect()->route(route: 'dashboard.index');
    }else{
        return redirect()->route('login');
    }
});
Route::get('admin', function () {
    return '<h1>Welcome Admin</h1>';
})->middleware(['auth','verified','role:admin']);

Route::get('direktur', function () {
    return view('pelaporan.index');
})->middleware(['auth','verified','role:direktur|admin']);

route::get('show', function () {
    return '<h1>selamat datangg alammm</h1>';
})->middleware(['auth','verified','role_or_permission:show-penulis|admin']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['role:admin|operator'])->group(function(){
    Route::get('/mas', function () {
        return view('pelaporan.operator');
    })->middleware(['auth', 'verified'])->name('master');
    
    //route Resource 
});

    
//     //route Resource 
// });
Route::middleware(['role:admin|operator'])->group(function(){
    Route::get('/master', function () {
        return view('pelaporan.master');
    })->middleware(['auth', 'verified'])->name('master');
    
    //route Resource 
});
Route::resource('/Operator', OperatorController::class);
Route::resource('/lab', LabController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('/lokasi', LokasiInstalasiController::class);
Route::resource('/laporanharian', LaporanHarianController::class);
Route::resource('/laporanbulanan', LaporanBulananController::class);
Route::resource('/laporanharianlab', LaporanHarianLabController::class);
Route::resource('/laporanbulananlab', LaporanBulananLabController::class);

Route::view('/tes', 'pelaporan.tes');


// route::
// Route::put('/Operator/{id}', [OperatorController::class, 'update'])->name('Operator.update');


route::resource('login', loginController::class);



require __DIR__.'/auth.php';
