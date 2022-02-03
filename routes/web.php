<?php

use App\Http\Controllers\admin\{RekapitulasiController,VillageController, HomeController, PatientController, ServicecenterController, ServicesubunitController, RecordController, DiagnosaController, SettingController};
use App\Http\Controllers\Auth\{LoginController, LogoutController};



Route::middleware('guest')->group(function(){ 
Route::get( '/login', [LoginController::class, 'formlogin']) -> name('login');
Route::post( '/login', [LoginController::class, 'login']) -> name('login');
Route::get('/', App\Http\Controllers\HomeController::class)->name('home');
});

Route::middleware('auth')->group(function(){ 
    Route::post( '/logout', LogoutController::class) -> name('logout');
});

// ADMIN
Route::middleware('auth', 'admin')->group(function(){ 

Route::get('/admin', HomeController::class)->name('admin.dashboard');
Route::get('/admin/rekapitulasi/{year}/lb1', [RekapitulasiController::class, 'yearlb1'])->name('admin.year.lb1');
Route::get('/admin/rekapitulasi/{year}/topten', [RekapitulasiController::class, 'yeartopten'])->name('admin.year.topten');

Route::get('/admin/rekapitulasi/{year}/lb2', [RekapitulasiController::class, 'yearlb2'])->name('admin.year.lb2');
Route::get('/admin/rekapitulasi/{year}/lb3', [RekapitulasiController::class, 'yearlb3'])->name('admin.year.lb3');

Route::get('/admin/top10year/{year}', [RekapitulasiController::class, 'toptenyear']);
Route::get('/admin/top10month/{year}/{month}', [RekapitulasiController::class, 'toptenmonth']);

Route::get('/admin/rekapitulasi/{year}/{month}/lb1', [RekapitulasiController::class, 'monthlb1'])->name('admin.month.lb1');
Route::get('/admin/rekapitulasi/{year}/{month}/topten', [RekapitulasiController::class, 'monthtopten'])->name('admin.month.topten');

Route::get('/admin/rekapitulasi/{year}/{month}/lb2', [RekapitulasiController::class, 'monthlb2'])->name('admin.month.lb2');
Route::get('/admin/rekapitulasi/{year}/{month}/lb3', [RekapitulasiController::class, 'monthlb3'])->name('admin.month.lb3');


Route::get('/admin/daftar-diagnosa', [DiagnosaController::class, 'diagnosa'])->name('admin.diagnosa');
Route::get('/admin/diagnosa', [DiagnosaController::class, 'getdiag']);
Route::get('/admin/diagnosa/{diagnosa}', [DiagnosaController::class, 'getdiagbyid']);

Route::get('/admin/desa', [VillageController::class, 'index'])->name('admin.village');
Route::post('/admin/desa', [VillageController::class, 'store'])->name('admin.village.create');
Route::get('/admin/desa/{id}/edit', [VillageController::class, 'edit'])->name('admin.village.edit');
Route::patch('/admin/desa/{id}/edit', [VillageController::class, 'update'])->name('admin.village.edit');
Route::delete('/admin/desa/{id}', [VillageController::class, 'destroy'])->name('admin.village.delete');

Route::get('/admin/tempatpelayanan', [ServicecenterController::class, 'index'])->name('admin.servicecenter');
Route::post('/admin/tempatpelayanan', [ServicecenterController::class, 'store'])->name('admin.servicecenter.create');
Route::get('/admin/tempatpelayanan/{id}/edit', [ServicecenterController::class, 'edit'])->name('admin.servicecenter.edit');
Route::patch('/admin/tempatpelayanan/{id}/edit', [ServicecenterController::class, 'update'])->name('admin.servicecenter.edit');
Route::delete('/admin/tempatpelayanan/{id}', [ServicecenterController::class, 'destroy'])->name('admin.servicecenter.delete');

Route::post('/admin/tempatpelayanan/{tempatpelayanan}', [ServicecenterController::class, 'adduser'])->name('admin.servicecenter.adduser');
Route::delete('/admin/tempatpelayanan/{tempatpelayanan}/{user}', [ServicecenterController::class, 'deleteuser'])->name('admin.servicecenter.deleteuser');

Route::get('/admin/poli', [ServicesubunitController::class, 'index'])->name('admin.servicesubunit');
Route::post('/admin/poli', [ServicesubunitController::class, 'store'])->name('admin.servicesubunit.create');
Route::get('/admin/poli/{id}/edit', [ServicesubunitController::class, 'edit'])->name('admin.servicesubunit.edit');
Route::patch('/admin/poli/{id}/edit', [ServicesubunitController::class, 'update'])->name('admin.servicesubunit.edit');
Route::delete('/admin/poli/{id}', [ServicesubunitController::class, 'destroy'])->name('admin.servicesubunit.delete');

Route::post('/admin/poli/{poli}', [ServicesubunitController::class, 'adduser'])->name('admin.servicesubunit.adduser');
Route::delete('/admin/poli/{poli}/{user}', [ServicesubunitController::class, 'deleteuser'])->name('admin.servicesubunit.deleteuser');

Route::get('/admin/kunjungan/{tahun}/{bulan}/{tempatpelayanan}', [RecordController::class, 'servicecenter'])->name('admin.record.servicecenter');
Route::get('/admin/pasien/desa/{desa}', [PatientController::class, 'village'])->name('admin.patient.village');
Route::get('/admin/pasien/create', [PatientController::class, 'create'])->name('admin.patient.create');
Route::post('/admin/pasien/create', [PatientController::class, 'store'])->name('admin.patient.create');
Route::get('/admin/pasien/{id}', [PatientController::class, 'show'])->name('admin.patient');
Route::get('/admin/pasien/{id}/edit', [PatientController::class, 'edit'])->name('admin.patient.edit');
Route::patch('/admin/pasien/{id}/edit', [PatientController::class, 'update'])->name('admin.patient.edit');
Route::delete('/admin/pasien/{id}/delete', [PatientController::class, 'destroy'])->name('admin.patient.delete');
Route::get('/admin/pasien', [PatientController::class, 'index'])->name('admin.patient.index');
Route::post('/admin/pasien', [PatientController::class, 'search'])->name('admin.patient.search');
Route::get('/admin/pasien/{nama}/{nik}/{desa}', [PatientController::class, 'result'])->name('admin.patient.result');

Route::get('/admin/pengaturan', [SettingController::class, 'pengaturan']) -> name('admin.setting');
Route::patch('/admin/change-password', [SettingController::class, 'password']) -> name('admin.password');
Route::patch('/admin/change-username', [SettingController::class, 'username']) -> name('admin.username');
});

// PUSKESMAS
Route::middleware('auth', 'puskesmas')->group(function(){ 
Route::get('/puskesmas', App\Http\Controllers\puskesmas\HomeController::class)->name('puskesmas.dashboard');

Route::get('/puskesmas/pasien/desa/{desa}', [App\Http\Controllers\puskesmas\PatientController::class, 'village'])->name('puskesmas.patient.village');
Route::get('/puskesmas/pasien/create', [App\Http\Controllers\puskesmas\PatientController::class, 'create'])->name('puskesmas.patient.create');
Route::post('/puskesmas/pasien/create', [App\Http\Controllers\puskesmas\PatientController::class, 'store'])->name('puskesmas.patient.create');
Route::get('/puskesmas/pasien/{id}', [App\Http\Controllers\puskesmas\PatientController::class, 'show'])->name('puskesmas.patient');
Route::get('/puskesmas/pasien/{id}/edit', [App\Http\Controllers\puskesmas\PatientController::class, 'edit'])->name('puskesmas.patient.edit');
Route::patch('/puskesmas/pasien/{id}/edit', [App\Http\Controllers\puskesmas\PatientController::class, 'update'])->name('puskesmas.patient.edit');
Route::delete('/puskesmas/pasien/{id}/delete', [App\Http\Controllers\puskesmas\PatientController::class, 'destroy'])->name('puskesmas.patient.delete');
Route::get('/puskesmas/pasien', [App\Http\Controllers\puskesmas\PatientController::class, 'index'])->name('puskesmas.patient.index');
Route::post('/puskesmas/pasien', [App\Http\Controllers\puskesmas\PatientController::class, 'search'])->name('puskesmas.patient.search');
Route::get('/puskesmas/pasien/{nama}/{nik}/{desa}', [App\Http\Controllers\puskesmas\PatientController::class, 'result'])->name('puskesmas.patient.result');


Route::get('/puskesmas/kunjungan/{tahun}/{bulan}', [App\Http\Controllers\puskesmas\RecordController::class, 'index'])->name('puskesmas.record.yearmonth');
Route::get('/puskesmas/kunjungan-pasien/{id}', [App\Http\Controllers\puskesmas\RecordController::class, 'show'])->name('puskesmas.record');
Route::get('/puskesmas/kunjungan-pasien/{id}/create', [App\Http\Controllers\puskesmas\RecordController::class, 'create'])->name('puskesmas.record.create');
Route::post('/puskesmas/kunjungan-pasien/{id}/create', [App\Http\Controllers\puskesmas\RecordController::class, 'store'])->name('puskesmas.record.create');
Route::get('/puskesmas/kunjungan-pasien/{id}/edit', [App\Http\Controllers\puskesmas\RecordController::class, 'edit'])->name('puskesmas.record.edit');
Route::put('/puskesmas/kunjungan-pasien/{id}', [App\Http\Controllers\puskesmas\RecordController::class, 'update']);
Route::delete('/puskesmas/kunjungan-pasien/{id}/delete', [App\Http\Controllers\puskesmas\RecordController::class, 'destroy'])->name('puskesmas.record.delete');

Route::get('/puskesmas/daftar-diagnosa', [App\Http\Controllers\puskesmas\DiagnosaController::class, 'diagnosa'])->name('puskesmas.diagnosa');
Route::get('/puskesmas/diagnosa/{diagnosa}', [App\Http\Controllers\puskesmas\DiagnosaController::class, 'getdiagbyid']);

Route::get('/puskesmas/diagnosa', [App\Http\Controllers\puskesmas\RecordController::class, 'getdiag']);
Route::get('/puskesmas/poli', [App\Http\Controllers\puskesmas\RecordController::class, 'poli']);
Route::get('/puskesmas/nakes/{id}', [App\Http\Controllers\puskesmas\RecordController::class, 'nakes']);

Route::get('/puskesmas/pengaturan', [App\Http\Controllers\puskesmas\SettingController::class, 'pengaturan']) -> name('puskesmas.setting');
Route::patch('/puskesmas/change-password', [App\Http\Controllers\puskesmas\SettingController::class, 'password']) -> name('puskesmas.password');
Route::patch('/puskesmas/change-username', [App\Http\Controllers\puskesmas\SettingController::class, 'username']) -> name('puskesmas.username');
});

// PUSTU
Route::middleware('auth', 'pustu')->group(function(){ 
Route::get('/pustu', App\Http\Controllers\pustu\HomeController::class)->name('pustu.dashboard');
Route::get('/pustu/pasien/desa/{desa}', [App\Http\Controllers\pustu\PatientController::class, 'village'])->name('pustu.patient.village');
Route::get('/pustu/pasien', [App\Http\Controllers\pustu\PatientController::class, 'index'])->name('pustu.patient.index');
Route::post('/pustu/pasien', [App\Http\Controllers\pustu\PatientController::class, 'search'])->name('pustu.patient.search');
Route::get('/pustu/pasien/{nama}/{nik}/{desa}', [App\Http\Controllers\pustu\PatientController::class, 'result'])->name('pustu.patient.result');

Route::get('/pustu/pasien/{id}', [App\Http\Controllers\pustu\PatientController::class, 'show'])->name('pustu.patient');
Route::get('/pustu/kunjungan/{tahun}/{bulan}', [App\Http\Controllers\pustu\RecordController::class, 'index'])->name('pustu.record.yearmonth');
Route::get('/pustu/kunjungan-pasien/{id}/create', [App\Http\Controllers\pustu\RecordController::class, 'create'])->name('pustu.record.create');
Route::post('/pustu/kunjungan-pasien/{id}/create', [App\Http\Controllers\pustu\RecordController::class, 'store'])->name('pustu.record.create');
Route::get('/pustu/kunjungan-pasien/{id}/edit', [App\Http\Controllers\pustu\RecordController::class, 'edit'])->name('pustu.record.edit');
Route::patch('/pustu/kunjungan-pasien/{id}/edit', [App\Http\Controllers\pustu\RecordController::class, 'update'])->name('pustu.record.edit');
Route::delete('/pustu/kunjungan-pasien/{id}/delete', [App\Http\Controllers\pustu\RecordController::class, 'destroy'])->name('pustu.record.delete');

Route::get('/pustu/daftar-diagnosa', [App\Http\Controllers\pustu\DiagnosaController::class, 'diagnosa'])->name('pustu.diagnosa');
Route::get('/pustu/diagnosa', [App\Http\Controllers\pustu\DiagnosaController::class, 'getdiag']);
Route::get('/pustu/diagnosa/{diagnosa}', [App\Http\Controllers\pustu\DiagnosaController::class, 'getdiagbykey']);

Route::get('/pustu/pengaturan', [App\Http\Controllers\pustu\SettingController::class, 'pengaturan']) -> name('pustu.setting');
Route::patch('/pustu/change-password', [App\Http\Controllers\pustu\SettingController::class, 'password']) -> name('pustu.password');
Route::patch('/pustu/change-username', [App\Http\Controllers\pustu\SettingController::class, 'username']) -> name('pustu.username');
});
