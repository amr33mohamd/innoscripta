<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use App\Jobs\ProcessFetchGNews;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard',[DashboardController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/test', function () {
//     // $response = Http::get('https://content.guardianapis.com/search', [
//     //     'q' => 'debate',
//     //     'api-key' => env('GUARDIAN_API_KEY'),
//     //     'page-size' => 200,
//     //     'page' => 1,
//     //     'show-blocks'=>'all'
//     // ])->json();
//     // print_r( $response['response']['results'][0]['blocks']['body'][0]['bodyTextSummary']);
//     // $pages = 190;
//     // for($i = 1;$i <= $pages;$i++ ){
//     //     //echo "fetching page $i <br>";
//     // }

//      ProcessFetchGNews::dispatch();


    
//     return 'done';
// });

require __DIR__.'/auth.php';
