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
	return view('auth.login');
});

Auth::routes();




Route::post('/simpandaftar', [App\Http\Controllers\DaftarController::class, 'simpandaftar'])->name('simpandaftar');

	// Klasifikasi Kerja
Route::get('/klasifikasi-kerja', [App\Http\Controllers\KlasifikasiKerjaController::class, 'index'])->name('klasifikasi_kerja');
	Route::get('/klasifikasi-kerja/create', [App\Http\Controllers\KlasifikasiKerjaController::class, 'create'])->name('klasifikasi.create'); // Form Tambah Klasifikasi
	Route::post('/klasifikasi-kerja', [App\Http\Controllers\KlasifikasiKerjaController::class, 'store'])->name('klasifikasi_kerja.store'); // Proses Penyimpanan Data
	Route::get('/klasifikasi-kerja/edit/{id}', [App\Http\Controllers\KlasifikasiKerjaController::class, 'edit'])->name('klasifikasi.edit');
	Route::put('/klasifikasi-kerja/update/{id}', [App\Http\Controllers\KlasifikasiKerjaController::class, 'update'])->name('klasifikasi.update');
	Route::delete('/klasifikasi-kerja/delete/{id}', [App\Http\Controllers\KlasifikasiKerjaController::class, 'destroy'])->name('klasifikasi.destroy');

	
	

	

	Route::group(['middleware' => ['auth']], function() {

		Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
		Route::get('/profile', [App\Http\Controllers\DaftarController::class, 'profile'])->name('profile')->middleware('auth');

		Route::get('/profile/edit', [App\Http\Controllers\DaftarController::class, 'editProfile'])->name('profile.edit');
		Route::put('/profile/update', [App\Http\Controllers\DaftarController::class, 'updateProfile'])->name('profile.update');


		
    // User-specific routes
		Route::group(['middleware' => ['checkRole:user']], function() {

			Route::get('/job', [App\Http\Controllers\JobController::class, 'job'])->name('job');
			Route::get('/job/add', [App\Http\Controllers\JobController::class, 'add'])->name('job.add');
			Route::post('/job/save', [App\Http\Controllers\JobController::class, 'save'])->name('job.save');    	
			Route::get('/job/edit/{id}', [App\Http\Controllers\JobController::class, 'edit'])->name('job.edit');
			Route::post('/job/update/{id}', [App\Http\Controllers\JobController::class, 'update'])->name('job.update');
			Route::get('/job/delete/{id}', [App\Http\Controllers\JobController::class, 'delete'])->name('job.delete');
			Route::get('/job/detail/{id}', [App\Http\Controllers\JobController::class, 'detail'])->name('job.detail');

			Route::get('job/download-pdf/{id}', [App\Http\Controllers\JobController::class, 'downloadPDF'])->name('job.downloadPDF');
			Route::get('job/print/{id}', [App\Http\Controllers\JobController::class, 'print'])->name('job.print'); 

			Route::get('/job/request_email_hsse/{id}', [App\Http\Controllers\JobController::class, 'request_email_hsse'])->name('job.request_email_hsse');
			Route::get('/job/request_email_fungsional/{id}', [App\Http\Controllers\JobController::class, 'request_email_fungsional'])->name('job.request_email_fungsional');

			Route::post('/person/save/{id}', [App\Http\Controllers\PersonController::class, 'save'])->name('person.save');  
			Route::get('/person/delete/{id}/{job_id}', [App\Http\Controllers\PersonController::class, 'delete'])->name('person.delete');

			Route::post('/tool/save/{id}', [App\Http\Controllers\ToolController::class, 'save'])->name('tool.save');
			Route::get('/tool/delete/{id}/{job_id}', [App\Http\Controllers\ToolController::class, 'delete'])->name('tool.delete');  

			Route::post('/tool2/save/{id}', [App\Http\Controllers\Tool2Controller::class, 'save'])->name('tool2.save');	
			Route::post('/tool2/update/{id}', [App\Http\Controllers\Tool2Controller::class, 'update'])->name('tool2.update');	

		});

    // Admin-specific routes
		Route::group(['middleware' => ['checkRole:admin']], function() {
			
			Route::get('/job_desc', [App\Http\Controllers\JobDescController::class, 'job_desc'])->name('job_desc');   	
			Route::post('/job_desc/status/approve_hsse/{id}', [App\Http\Controllers\JobDescController::class, 'approve_hsse'])->name('job_desc.approve_hsse');
			Route::get('/job_desc/status/approve_fungsional/{id}', [App\Http\Controllers\JobDescController::class, 'approve_fungsional'])->name('job_desc.approve_fungsional');

			Route::get('/job_desc/detail/{id}', [App\Http\Controllers\JobDescController::class, 'detail'])->name('job_desc.detail');

			Route::get('job_desc/download-pdf/{id}', [App\Http\Controllers\JobDescController::class, 'downloadPDF'])->name('job_desc.downloadPDF');
			Route::get('job_desc/print/{id}', [App\Http\Controllers\JobDescController::class, 'print'])->name('job_desc.print'); 

			Route::get('/email', [App\Http\Controllers\EmailController::class, 'email'])->name('email');
			Route::get('/email/edit/{id}', [App\Http\Controllers\EmailController::class, 'edit'])->name('email.edit');
			Route::post('/email/update/{id}', [App\Http\Controllers\EmailController::class, 'update'])->name('email.update');

			Route::get('/monitoring', [App\Http\Controllers\MonitoringController::class, 'monitoring'])->name('monitoring');
			


		});



	});