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
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RapotController;
use App\Http\Controllers\SikapController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UlanganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\MateriController;



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

    Route::get('/data-spp', [SppController::class, 'index'])->name('data-spp');
    Route::post('/data-spp', [SppController::class, 'store'])->name('data-spp.store');
    Route::get('/spp/histori', [HistoryController::class, 'index'])->name('spp.history');
    Route::resource('/spp/pembayaran', PembayaranController::class);

    Route::resource('/materi', MateriController::class);


  
    Route::middleware(['siswa'])->group(function () {
      Route::get('/jadwal/siswa', [JadwalController::class, 'siswa'])->name('jadwal.siswa');
      Route::get('/ulangan/siswa', [UlanganController::class, 'siswa'])->name('ulangan.siswa');
      Route::get('/sikap/siswa', [SikapController::class, 'siswa'])->name('sikap.siswa');
      Route::get('/rapot/siswa', [RapotController::class, 'siswa'])->name('rapot.siswa');
    });
  
    Route::middleware(['guru'])->group(function () {
      Route::get('/absen/harian', [GuruController::class, 'absen'])->name('absen.harian');
      Route::post('/absen/simpan', [GuruController::class, 'simpan'])->name('absen.simpan');
      Route::get('/jadwal/guru', [JadwalController::class, 'guru'])->name('jadwal.guru');
      Route::resource('/nilai', NilaiController::class);
      Route::resource('/ulangan', UlanganController::class);
      Route::resource('/sikap', SikapController::class);
      Route::get('/rapot/predikat', [RapotController::class, 'predikat']);
      Route::resource('/rapot', RapotController::class);
    });
    
    Route::middleware(['owner'])->group(function (){
      Route::get('/owner/data-siswa', [OwnerController::class, 'show'])->name('owner.data-siswa');
    });
  
    Route::middleware(['admin'])->group(function () {
      Route::middleware(['trash'])->group(function () {
        Route::get('/jadwal/trash', [JadwalController::class, 'trash'])->name('jadwal.trash');
        Route::get('/jadwal/restore/{id}', [JadwalController::class, 'restore_jadwal'])->name('jadwal.restore');
        Route::delete('/jadwal/kill/{id}', [JadwalController::class, 'kill'])->name('jadwal.kill');
        Route::get('/guru/trash', [GuruController::class, 'trash'])->name('guru.trash');
        Route::get('/guru/restore/{id}', [GuruController::class, 'restore_guru'])->name('guru.restore');
        Route::delete('/guru/kill/{id}', [GuruController::class, 'kill'])->name('guru.kill');
        Route::get('/kelas/trash', [KelasController::class, 'trash'])->name('kelas.trash');
        Route::get('/kelas/restore/{id}', [KelasController::class, 'restore_kelas'])->name('kelas.restore');
        Route::delete('/kelas/kill/{id}', [KelasController::class, 'kill'])->name('kelas.kill');
        Route::get('/siswa/trash', [SiswaController::class, 'trash'])->name('siswa.trash');
        Route::get('/siswa/restore/{id}', [SiswaController::class, 'restore_siswa'])->name('siswa.restore');
        Route::delete('/siswa/kill/{id}', [SiswaController::class, 'kill'])->name('siswa.kill');
        Route::get('/mapel/trash', [MapelController::class, 'trash'])->name('mapel.trash');
        Route::get('/mapel/restore/{id}', [MapelController::class, 'restore_mapel'])->name('mapel.restore');
        Route::delete('/mapel/kill/{id}', [MapelController::class, 'kill'])->name('mapel.kill');
        Route::get('/user/trash', [UserController::class, 'trash'])->name('user.trash');
        Route::get('/user/restore/{id}', [UserController::class, 'restore_user'])->name('user.restore');
        Route::delete('/user/kill/{id}', [UserController::class, 'kill'])->name('user.kill');
      });
      

      Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
      Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman');
      Route::post('/admin/pengumuman/simpan', [PengumumanController::class, 'simpan'])->name('admin.pengumuman.simpan');
      Route::get('/guru/absensi', [GuruController::class, 'absensi'])->name('guru.absensi');
      Route::get('/guru/kehadiran/{id}', [GuruController::class, 'kehadiran'])->name('guru.kehadiran');
      Route::get('/absen/json', [GuruController::class, 'json']);
      Route::get('/guru/mapel/{id}', [GuruController::class, 'mapel'])->name('guru.mapel');
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
      Route::resource('/siswa', SiswaController::class);
      Route::get('/mapel/getMapelJson', [MapelController::class, 'getMapelJson']);
      Route::resource('/mapel', MapelController::class);
      Route::get('/jadwal/view/json', [JadwalController::class, 'view']);
      Route::get('/jadwalkelaspdf/{id}', [JadwalController::class, 'cetak_pdf']);
      Route::get('/jadwal/export_excel', [JadwalController::class, 'export_excel'])->name('jadwal.export_excel');
      Route::post('/jadwal/import_excel', [JadwalController::class, 'import_excel'])->name('jadwal.import_excel');
      Route::delete('/jadwal/deleteAll', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');
      Route::resource('/jadwal', JadwalController::class);
      Route::get('/ulangan-kelas', [UlanganController::class, 'create'])->name('ulangan-kelas');
      Route::get('/ulangan-siswa/{id}', [UlanganController::class, 'edit'])->name('ulangan-siswa');
      Route::get('/ulangan-show/{id}', [UlanganController::class, 'ulangan'])->name('ulangan-show');
      Route::get('/sikap-kelas', [SikapController::class, 'create'])->name('sikap-kelas');
      Route::get('/sikap-siswa/{id}', [SikapController::class, 'edit'])->name('sikap-siswa');
      Route::get('/sikap-show/{id}', [SikapController::class, 'sikap'])->name('sikap-show');
      Route::get('/rapot-kelas', [RapotController::class, 'create'])->name('rapot-kelas');
      Route::get('/rapot-siswa/{id}', [RapotController::class, 'edit'])->name('rapot-siswa');
      Route::get('/rapot-show/{id}', [RapotController::class, 'rapot'])->name('rapot-show');
      Route::get('/predikat', [NilaiController::class, 'create'])->name('predikat');
      Route::resource('/user', UserController::class);
    });
  });
