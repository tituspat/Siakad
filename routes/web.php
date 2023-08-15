<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RapotController;
use App\Http\Controllers\SikapController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TestController;



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
    return view('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
  });
  
  Auth::routes();
  Route::get('/login/cek_email/json', [UserController::class, 'cek_email']);
  Route::get('/login/cek_password/json', [UserController::class, 'cek_password']);
  Route::post('/cek-email', [UserController::class, 'email'])->name('cek-email')->middleware('guest');
  Route::get('/reset/password/{id}', [UserController::class, 'password'])->name('reset.password')->middleware('guest');
  Route::patch('/reset/password/update/{id}', [UserController::class, 'update_password'])->name('reset.password.update')->middleware('guest');
  
  // auth || Global
  Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/jadwal/sekarang', [JadwalController::class, 'jadwalSekarang']);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/pengaturan/profile', [UserController::class, 'edit_profile'])->name('pengaturan.profile');
    Route::post('/pengaturan/ubah-profile', [UserController::class, 'ubah_profile'])->name('pengaturan.ubah-profile');
    Route::get('/pengaturan/edit-foto', [UserController::class, 'edit_foto'])->name('pengaturan.edit-foto');
    Route::post('/pengaturan/ubah-foto', [UserController::class, 'ubah_foto'])->name('pengaturan.ubah-foto');
    Route::get('/pengaturan/email', [UserController::class, 'edit_email'])->name('pengaturan.email');
    Route::post('/pengaturan/ubah-email', [UserController::class, 'ubah_email'])->name('pengaturan.ubah-email');
    Route::get('/pengaturan/password', [UserController::class, 'edit_password'])->name('pengaturan.password');
    Route::post('/pengaturan/ubah-password', [UserController::class, 'ubah_password'])->name('pengaturan.ubah-password');

    Route::resource('/data-spp', SppController::class);
    Route::get('/spp/histori', [HistoryController::class, 'index'])->name('spp.history');
    Route::resource('/spp/pembayaran', PembayaranController::class);

    Route::resource('/materi', MateriController::class);


  // Siswa
    Route::middleware(['siswa'])->group(function () {
      Route::get('/jadwal/siswa', [JadwalController::class, 'siswa'])->name('jadwal.siswa');
      Route::get('/sikap/siswa', [SikapController::class, 'siswa'])->name('sikap.siswa');
      Route::get('/rapot/siswa', [RapotController::class, 'siswa'])->name('rapot.siswa');
      Route::get('/spp/siswa', [TagihanController::class, 'siswa'])->name('spp.siswa');
      Route::get('/siswa/materi', [MateriController::class, 'siswa'])->name('materi.siswa');

    });
  // Guru
    Route::middleware(['guru'])->group(function () {
      Route::get('/absen/harian', [SiswaController::class, 'absen'])->name('absen.harian');
      Route::post('/absen/simpan', [SiswaController::class, 'simpan'])->name('absen.simpan');
      Route::get('/jadwal/guru', [JadwalController::class, 'guru'])->name('jadwal.guru');
      Route::get('/guru/materi', [GuruController::class, 'materiKelas'])->name('materi.kelas.guru');
      Route::get('/guru/materi/ajar/{id}', [GuruController::class, 'materiAjar'])->name('materi.ajar.guru');
      Route::resource('/nilai', NilaiController::class);
      Route::resource('/test', TestController::class);
      Route::post('/test/selesai/{id}', [TestController::class, 'selesai'])->name('test.selesai');
      Route::resource('/sikap', SikapController::class);
      Route::get('/rapot/predikat', [RapotController::class, 'predikat']);
      Route::resource('/rapot', RapotController::class);
      Route::resource('/guru/soal', TestController::class);
    });
    // Owner
    Route::middleware(['owner'])->group(function (){
      Route::get('/owner/data-siswa', [OwnerController::class, 'show'])->name('owner.data-siswa');
    });

    
  // Admin
    Route::middleware(['admin'])->group(function () {
      Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
      Route::get('/siswa/absensi', [SiswaController::class, 'absensi'])->name('siswa.absensi');
      Route::get('/siswa/kehadiran/{id}', [SiswaController::class, 'kehadiran'])->name('siswa.kehadiran');
      Route::get('/absen/json', [GuruController::class, 'json']);
      Route::get('/guru/kelas/{id}', [GuruController::class, 'kelas'])->name('guru.kelas');
      Route::get('/guru/ubah-foto/{id}', [GuruController::class, 'ubah_foto'])->name('guru.ubah-foto');
      Route::post('/guru/update-foto/{id}', [GuruController::class, 'update_foto'])->name('guru.update-foto');
      Route::post('/guru/upload', [GuruController::class, 'upload'])->name('guru.upload');
      Route::get('/guru/export_excel', [GuruController::class, 'export_excel'])->name('guru.export_excel');
      Route::post('/guru/import_excel', [GuruController::class, 'import_excel'])->name('guru.import_excel');
      Route::delete('/guru/deleteAll', [GuruController::class, 'deleteAll'])->name('guru.deleteAll');
      Route::resource('/guru', GuruController::class);
      Route::get('/kelas/edit/json', [KelasController::class, 'getEdit']);
      Route::resource('/kelas', KelasController::class);
      Route::get('/siswa/kelas/{id}', [SiswaController::class, 'kelas'])->name('siswa.kelas');
      Route::get('/siswa/view/json', [SiswaController::class, 'view']);
      Route::get('/listsiswapdf/{id}', [SiswaController::class, 'cetak_pdf']);
      Route::get('/siswa/ubah-foto/{id}', [SiswaController::class, 'ubah_foto'])->name('siswa.ubah-foto');
      Route::post('/siswa/update-foto/{id}', [SiswaController::class, 'update_foto'])->name('siswa.update-foto');
      Route::get('/siswa/export_excel', [SiswaController::class, 'export_excel'])->name('siswa.export_excel');
      Route::post('/siswa/import_excel', [SiswaController::class, 'import_excel'])->name('siswa.import_excel');
      Route::delete('/siswa/deleteAll', [SiswaController::class, 'deleteAll'])->name('siswa.deleteAll');
      Route::get('/tagihan/siswa', [SiswaController::class, 'tagihan'])->name('tagihan.siswa');
      Route::resource('/siswa', SiswaController::class);
      Route::get('/mapel/getMapelJson', [MapelController::class, 'getMapelJson']);
      Route::resource('/mapel', MapelController::class);
      Route::get('/jadwal/view/json', [JadwalController::class, 'view']);
      Route::get('/jadwalkelaspdf/{id}', [JadwalController::class, 'cetak_pdf']);
      Route::get('/jadwal/export_excel', [JadwalController::class, 'export_excel'])->name('jadwal.export_excel');
      Route::post('/jadwal/import_excel', [JadwalController::class, 'import_excel'])->name('jadwal.import_excel');
      Route::delete('/jadwal/deleteAll', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');
      Route::resource('/jadwal', JadwalController::class);
      Route::get('/sikap-kelas', [SikapController::class, 'create'])->name('sikap-kelas');
      Route::get('/sikap-siswa/{id}', [SikapController::class, 'edit'])->name('sikap-siswa');
      Route::get('/sikap-show/{id}', [SikapController::class, 'sikap'])->name('sikap-show');
      Route::get('/rapot-kelas', [RapotController::class, 'create'])->name('rapot-kelas');
      Route::get('/rapot-siswa/{id}', [RapotController::class, 'edit'])->name('rapot-siswa');
      Route::get('/rapot-show/{id}', [RapotController::class, 'rapot'])->name('rapot-show');
      Route::get('/predikat', [NilaiController::class, 'create'])->name('predikat');
      Route::resource('/materi', MateriController::class);
      Route::resource('/user', UserController::class);
    });
  });
