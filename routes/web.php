<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('result', [App\Http\Controllers\ResultController::class, 'index'])->name('result');
Route::get('get_data', [App\Http\Controllers\ResultController::class, 'getTickerPair'])->name('get_data');

Route::get('compare', [App\Http\Controllers\ResultController::class, 'compareTicket'])->name('compare');
// Route::get('compare-result', [App\Http\Controllers\ResultController::class, 'compareResult'])->name('compare_result');

// Route::controller('datatables', 'DatatablesController', [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);