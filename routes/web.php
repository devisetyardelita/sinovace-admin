<?php

use GuzzleHttp\Middleware;
use App\Models\LayananPengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Models\LegalisirPiagamPenghargaan;
use App\Models\SuratKeteranganRalatIjazahSTTB;
use App\Models\SuratPenggantiIjazahSTTBHilang;
use App\Http\Controllers\MutasisiswaController;
use App\Http\Controllers\PengelolaanBOSController;
use App\Http\Controllers\LayananPengaduanController;
use App\Http\Controllers\PelayananDAPODIKController;
use App\Http\Controllers\LegalisirPiagamPenghargaanController;
use App\Http\Controllers\LegalisirFotokopiIjazahSTTBController;
use App\Http\Controllers\SuratKeteranganRalatIjazahSTTBController;
use App\Http\Controllers\SuratPenggantiIjazahSTTBHilangController;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('registration', [AuthController::class, 'registrationProcess'])->name('registration.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', function () {
        return 'Hai';
    });


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('home', function () {
    return view('home');
});

Route::get('mutasi_siswa', function () {
    return view('mutasi_siswa/data');
});

// Route::get('mutasi_siswa', [MutasisiswaController::class, 'data']);
// Route::get('mutasi_siswa/add', [MutasisiswaController::class, 'add']);
// Route::post('mutasi_siswa', [MutasisiswaController::class, 'addProcess']);
// Route::get('mutasi_siswa/edit/{id}', [MutasisiswaController::class, 'edit']);
// Route::patch('mutasi_siswa/{id}', [MutasisiswaController::class, 'editProcess']);
// Route::delete('mutasi_siswa/{id}', [MutasisiswaController::class, 'delete']);

Route::get('layanan_pengaduan', [LayananPengaduanController::class, 'index']);
Route::get('layanan_pengaduan/create', [LayananPengaduanController::class, 'create']);
Route::post('layanan_pengaduan/create', [LayananPengaduanController::class, 'store']);
Route::get('layanan_pengaduan/edit/{id}', [LayananPengaduanController::class, 'edit']);
Route::put('layanan_pengaduan/edit/{id}', [LayananPengaduanController::class, 'update']);
Route::delete('layanan_pengaduan/delete/{id}', [LayananPengaduanController::class, 'destroy']);
Route::get('layanan_pengaduan/show/{id}', [LayananPengaduanController::class, 'show']);
Route::get('layanan_pengaduan/filter', [LayananPengaduanController::class, 'filter'])->name('filter');
Route::get('layanan_pengaduan/generate_layanan_pengaduan_pdf', [PDFController::class, 'generatePDF']);
Route::get('layanan_pengaduan/export/', [LayananPengaduanController::class, 'export']);

Route::get('legalisir_fotokopi_ijazah_sttb', [LegalisirFotokopiIjazahSTTBController::class, 'index']);
Route::get('legalisir_fotokopi_ijazah_sttb/create', [LegalisirFotokopiIjazahSTTBController::class, 'create']);
Route::post('legalisir_fotokopi_ijazah_sttb/create', [LegalisirFotokopiIjazahSTTBController::class, 'store']);
Route::get('legalisir_fotokopi_ijazah_sttb/edit/{id}', [LegalisirFotokopiIjazahSTTBController::class, 'edit']);
Route::put('legalisir_fotokopi_ijazah_sttb/edit/{id}', [LegalisirFotokopiIjazahSTTBController::class, 'update']);
Route::delete('legalisir_fotokopi_ijazah_sttb/delete/{id}', [LegalisirFotokopiIjazahSTTBController::class, 'destroy']);
Route::get('legalisir_fotokopi_ijazah_sttb/show/{id}', [LegalisirFotokopiIjazahSTTBController::class, 'show']);
Route::get('legalisir_fotokopi_ijazah_sttb/filter', [LegalisirFotokopiIjazahSTTBController::class, 'filter'])->name('filter');
Route::get('legalisir_fotokopi_ijazah_sttb/pdf', [LegalisirFotokopiIjazahSTTBController::class, 'generatePDF']);
Route::get('legalisir_fotokopi_ijazah_sttb/excel/', [LegalisirFotokopiIjazahSTTBController::class, 'export']);

Route::get('legalisir_piagam_penghargaan', [LegalisirPiagamPenghargaanController::class, 'index']);
Route::get('legalisir_piagam_penghargaan/create', [LegalisirPiagamPenghargaanController::class, 'create']);
Route::post('legalisir_piagam_penghargaan/create', [LegalisirPiagamPenghargaanController::class, 'store']);
Route::get('legalisir_piagam_penghargaan/edit/{id}', [LegalisirPiagamPenghargaanController::class, 'edit']);
Route::put('legalisir_piagam_penghargaan/edit/{id}', [LegalisirPiagamPenghargaanController::class, 'update']);
Route::delete('legalisir_piagam_penghargaan/delete/{id}', [LegalisirPiagamPenghargaanController::class, 'destroy']);
Route::get('legalisir_piagam_penghargaan/show/{id}', [LegalisirPiagamPenghargaanController::class, 'show']);
Route::get('legalisir_piagam_penghargaan/filter', [LegalisirPiagamPenghargaanController::class, 'filter'])->name('filter');
Route::get('legalisir_piagam_penghargaan/generate_legalisir_piagam_penghargaan_pdf', [LegalisirPiagamPenghargaanController::class, 'generatePDF']);
Route::get('legalisir_piagam_penghargaan/export/', [LegalisirPiagamPenghargaanController::class, 'export']);

Route::get('mutasi_siswa', [MutasiSiswaController::class, 'index']);
Route::get('mutasi_siswa/create', [MutasiSiswaController::class, 'create']);
Route::post('mutasi_siswa/create', [MutasiSiswaController::class, 'store']);
Route::get('mutasi_siswa/edit/{id}', [MutasiSiswaController::class, 'edit']);
Route::put('mutasi_siswa/edit/{id}', [MutasiSiswaController::class, 'update']);
Route::delete('mutasi_siswa/delete/{id}', [MutasiSiswaController::class, 'destroy']);
Route::get('mutasi_siswa/show/{id}', [MutasiSiswaController::class, 'show']);
Route::get('mutasi_siswa/filter', [MutasiSiswaController::class, 'filter'])->name('filter');
Route::get('mutasi_siswa/pdf', [MutasiSiswaController::class, 'generatePDF']);
Route::get('mutasi_siswa/excel/', [MutasiSiswaController::class, 'export']);

Route::get('pelayanan_dapodik', [PelayananDAPODIKController::class, 'index']);
Route::get('pelayanan_dapodik/create', [PelayananDAPODIKController::class, 'create']);
Route::post('pelayanan_dapodik/create', [PelayananDAPODIKController::class, 'store']);
Route::get('pelayanan_dapodik/edit/{id}', [PelayananDAPODIKController::class, 'edit']);
Route::put('pelayanan_dapodik/edit/{id}', [PelayananDAPODIKController::class, 'update']);
Route::delete('pelayanan_dapodik/delete/{id}', [PelayananDAPODIKController::class, 'destroy']);
Route::get('pelayanan_dapodik/show/{id}', [PelayananDAPODIKController::class, 'show']);
Route::get('pelayanan_dapodik/filter', [PelayananDAPODIKController::class, 'filter'])->name('filter');
Route::get('pelayanan_dapodik/pdf', [PelayananDAPODIKController::class, 'generatePDF']);
Route::get('pelayanan_dapodik/excel/', [PelayananDAPODIKController::class, 'export']);

Route::get('pengelolaan_dana_bos', [PengelolaanBOSController::class, 'index']);
Route::get('pengelolaan_dana_bos/create', [PengelolaanBOSController::class, 'create']);
Route::post('pengelolaan_dana_bos/create', [PengelolaanBOSController::class, 'store']);
Route::get('pengelolaan_dana_bos/edit/{id}', [PengelolaanBOSController::class, 'edit']);
Route::put('pengelolaan_dana_bos/edit/{id}', [PengelolaanBOSController::class, 'update']);
Route::delete('pengelolaan_dana_bos/delete/{id}', [PengelolaanBOSController::class, 'destroy']);
Route::get('pengelolaan_dana_bos/show/{id}', [PengelolaanBOSController::class, 'show']);
Route::get('pengelolaan_dana_bos/filter', [PengelolaanBOSController::class, 'filter'])->name('filter');
Route::get('pengelolaan_dana_bos/pdf', [PengelolaanBOSController::class, 'generatePDF']);
Route::get('pengelolaan_dana_bos/excel/', [PengelolaanBOSController::class, 'export']);

Route::get('surat_keterangan_ralat_ijazah_sttb', [SuratKeteranganRalatIjazahSTTBController::class, 'index']);
Route::get('surat_keterangan_ralat_ijazah_sttb/create', [SuratKeteranganRalatIjazahSTTBController::class, 'create']);
Route::post('surat_keterangan_ralat_ijazah_sttb/create', [SuratKeteranganRalatIjazahSTTBController::class, 'store']);
Route::get('surat_keterangan_ralat_ijazah_sttb/edit/{id}', [SuratKeteranganRalatIjazahSTTBController::class, 'edit']);
Route::put('surat_keterangan_ralat_ijazah_sttb/edit/{id}', [SuratKeteranganRalatIjazahSTTBController::class, 'update']);
Route::delete('surat_keterangan_ralat_ijazah_sttb/delete/{id}', [SuratKeteranganRalatIjazahSTTBController::class, 'destroy']);
Route::get('surat_keterangan_ralat_ijazah_sttb/show/{id}', [SuratKeteranganRalatIjazahSTTBController::class, 'show']);
Route::get('surat_keterangan_ralat_ijazah_sttb/filter', [SuratKeteranganRalatIjazahSTTBController::class, 'filter'])->name('filter');
Route::get('surat_keterangan_ralat_ijazah_sttb/pdf', [SuratKeteranganRalatIjazahSTTBController::class, 'generatePDF']);
Route::get('surat_keterangan_ralat_ijazah_sttb/excel/', [SuratKeteranganRalatIjazahSTTBController::class, 'export']);

Route::get('surat_pengganti_ijazah_sttb_hilang', [SuratPenggantiIjazahSTTBHilangController::class, 'index']);
Route::get('surat_pengganti_ijazah_sttb_hilang/create', [SuratPenggantiIjazahSTTBHilangController::class, 'create']);
Route::post('surat_pengganti_ijazah_sttb_hilang/create', [SuratPenggantiIjazahSTTBHilangController::class, 'store']);
Route::get('surat_pengganti_ijazah_sttb_hilang/edit/{id}', [SuratPenggantiIjazahSTTBHilangController::class, 'edit']);
Route::put('surat_pengganti_ijazah_sttb_hilang/edit/{id}', [SuratPenggantiIjazahSTTBHilangController::class, 'update']);
Route::delete('surat_pengganti_ijazah_sttb_hilang/delete/{id}', [SuratPenggantiIjazahSTTBHilangController::class, 'destroy']);
Route::get('surat_pengganti_ijazah_sttb_hilang/show/{id}', [SuratPenggantiIjazahSTTBHilangController::class, 'show']);
Route::get('surat_pengganti_ijazah_sttb_hilang/filter', [SuratPenggantiIjazahSTTBHilangController::class, 'filter'])->name('filter');
Route::get('surat_pengganti_ijazah_sttb_hilang/pdf', [SuratPenggantiIjazahSTTBHilangController::class, 'generatePDF']);
Route::get('surat_pengganti_ijazah_sttb_hilang/excel/', [SuratPenggantiIjazahSTTBHilangController::class, 'export']);
 

});