<?php

use App\Http\Controllers\Api\JenisKelaminController;
use App\Http\Controllers\Api\PendaftaranOsisController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;

// Endpoint Master
Route::apiResource('/kelas', KelasController::class);
Route::apiResource('/jenis-kelamin', JenisKelaminController::class);
Route::apiResource('/siswa', SiswaController::class);

// Endpoint Pendaftaran OSIS
Route::apiResource('/pendaftaran-osis', PendaftaranOsisController::class);

