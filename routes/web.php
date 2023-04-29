<?php

use App\Models\Job;
use Dompdf\Dompdf;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\ServiceController::class, 'index'])->name('welcome');
Route::post('/store', [App\Http\Controllers\ServiceController::class, 'store'])->name('store');

Route::get('/jobs/{job}/pdf', function (Job $job){
    $dompdf = new Dompdf();

    // Eager load the related Service model
    $job->load('service');
    $job->load('service.department');
    $job->load('user');

    // Pass data to the view and render
    $data = ['job' => $job];
    $html = view('job-details', $data)->render();

    // Load HTML into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF
    $dompdf->render();

    // output the generated PDF to the browser
    return $dompdf->stream('job-details.pdf');
})->name('job-pdf');