<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\DashboardController;
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

Route::group(['domain' => '127.0.0.1'], function()
{
	// Dashboard pages defined
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::get('/paginate', [DashboardController::class, 'paginate'])->name('dashboard.paginate');
	Route::post('/pdf', [DashboardController::class, 'pdf'])->name('dashboard.pdf');	
});
