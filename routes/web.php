<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminDataPenggunaController;
use App\Http\Controllers\admin\AdminMateriController;
use App\Http\Controllers\admin\AdminTugasController;
use App\Http\Controllers\admin\data_pengguna\AdminGuruController;
use App\Http\Controllers\admin\data_pengguna\AdminSiswaController;
use App\Http\Controllers\admin\kelas\AdminKelasController;
use App\Http\Controllers\admin\kelas\mapel\AdminKelasMapelController;
use App\Http\Controllers\admin\kelas\siswa\AdminAgtKelasController;
use App\Http\Controllers\admin\mapel\AdminMapelController;
use App\Http\Controllers\admin\mapel\guru\AdminPengajarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\guru\GuruAbsensiController;
use App\Http\Controllers\guru\GuruController;
use App\Http\Controllers\guru\kelas\GuruKelasController;
use App\Http\Controllers\guru\GuruMateriController;
use App\Http\Controllers\guru\GuruTugasController;
use App\Http\Controllers\guru\kelas\absensi\GuruAbsensiKelasController;
use App\Http\Controllers\guru\kelas\absensi\kehadiran\GuruKehadiranKelasController;
use App\Http\Controllers\guru\kelas\materi\GuruMateriKelasController;
use App\Http\Controllers\guru\kelas\siswa\GuruAgtKelasController;
use App\Http\Controllers\guru\kelas\tugas\GuruTugasKelasController;
use App\Http\Controllers\guru\kelas\tugas\submission\GuruSubmissionKelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\siswa\mapel\absensi\SiswaAbsensiKelasController;
use App\Http\Controllers\siswa\mapel\guru\SiswaPengajarController;
use App\Http\Controllers\siswa\mapel\materi\SiswaMateriController;
use App\Http\Controllers\siswa\mapel\tugas\SiswaTugasKelasController;
use App\Http\Controllers\siswa\SiswaController;
use App\Http\Controllers\siswa\SiswaMapelController;
use App\Http\Controllers\siswa\SiswaTugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/encrypt-id', function () {
    return response()->json([
        'encrypted' => encrypt(request('id'))
    ]);
});

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

//guru
Route::get('/guru', [GuruController::class, 'index'])->name('guru.dashboard');
Route::get('/guru/kelas', [GuruKelasController::class, 'index'])->name('guru.kelas');
Route::get('/guru/kelas/detail/{kelas_mapel_id}', [GuruKelasController::class, 'detail'])->name('guru.kelas.detail');

Route::get('/guru/kelas/detail/{kelas_mapel_id}/siswa', [GuruAgtKelasController::class, 'index'])->name('guru.kelas.detail.siswa');
Route::get('/guru/kelas/detail/{kelas_id}/siswa/data', [GuruAgtKelasController::class, 'data'])->name('guru.kelas.detail.siswa.data');
Route::get('/guru/kelas/detail/siswa/show/{id}', [AdminAgtKelasController::class, 'show'])->name('guru.kelas.detail.siswa.show');

Route::get('/guru/kelas/detail/{kelas_mapel_id}/materi', [GuruMateriKelasController::class, 'index'])->name('guru.kelas.detail.materi');
Route::get('/guru/kelas/detail/{kelas_mapel_id}/materi/data', [GuruMateriKelasController::class, 'data'])->name('guru.kelas.detail.materi.data');
Route::post('/guru/kelas/detail/materi/store', [GuruMateriKelasController::class, 'store'])->name('guru.kelas.detail.materi.store');
Route::get('/guru/kelas/detail/materi/show/{id}', [GuruMateriKelasController::class, 'show'])->name('guru.kelas.detail.materi.show');
Route::post('/guru/kelas/detail/materi/update/{id}', [GuruMateriKelasController::class, 'update'])->name('guru.kelas.detail.materi.update');
Route::delete('/guru/kelas/detail/materi/delete/{id}', [GuruMateriKelasController::class, 'destroy'])->name('guru.kelas.detail.materi.delete');

Route::get('/guru/kelas/detail/{kelas_mapel_id}/tugas', [GuruTugasKelasController::class, 'index'])->name('guru.kelas.detail.tugas');
Route::get('/guru/kelas/detail/{kelas_mapel_id}/tugas/data', [GuruTugasKelasController::class, 'data'])->name('guru.kelas.detail.tugas.data');
Route::post('/guru/kelas/detail/tugas/store', [GuruTugasKelasController::class, 'store'])->name('guru.kelas.detail.tugas.store');
Route::get('/guru/kelas/detail/tugas/show/{id}', [GuruTugasKelasController::class, 'show'])->name('guru.kelas.detail.tugas.show');
Route::post('/guru/kelas/detail/tugas/update/{id}', [GuruTugasKelasController::class, 'update'])->name('guru.kelas.detail.tugas.update');
Route::delete('/guru/kelas/detail/tugas/delete/{id}', [GuruTugasKelasController::class, 'destroy'])->name('guru.kelas.detail.tugas.delete');

Route::get('/guru/tugas/submission/{tugas_id}', [GuruSubmissionKelasController::class, 'index'])->name('guru.tugas.submission');
Route::get('/guru/tugas/submission/{tugas_id}/data', [GuruSubmissionKelasController::class, 'data'])->name('guru.tugas.submission.data');

Route::get('/guru/kelas/detail/{kelas_mapel_id}/absensi', [GuruAbsensiKelasController::class, 'index'])->name('guru.kelas.detail.absensi');
Route::get('/guru/kelas/detail/{kelas_mapel_id}/absensi/data', [GuruAbsensiKelasController::class, 'data'])->name('guru.kelas.detail.absensi.data');
Route::post('/guru/kelas/detail/absensi/store', [GuruAbsensiKelasController::class, 'store'])->name('guru.kelas.detail.absensi.store');
Route::get('/guru/kelas/detail/absensi/show/{id}', [GuruAbsensiKelasController::class, 'show'])->name('guru.kelas.detail.absensi.show');
Route::post('/guru/kelas/detail/absensi/update/{id}', [GuruAbsensiKelasController::class, 'update'])->name('guru.kelas.detail.absensi.update');
Route::delete('/guru/kelas/detail/absensi/delete/{id}', [GuruAbsensiKelasController::class, 'destroy'])->name('guru.kelas.detail.absensi.delete');

Route::get('/guru/tugas/kehadiran/{absensi_id}', [GuruKehadiranKelasController::class, 'index'])->name('guru.tugas.kehadiran');
Route::get('/guru/tugas/kehadiran/{absensi_id}/data', [GuruKehadiranKelasController::class, 'data'])->name('guru.tugas.kehadiran.data');

Route::get('/guru/materi', [GuruMateriController::class, 'index'])->name('guru.materi');
Route::get('/guru/tugas', [GuruTugasController::class, 'index'])->name('guru.tugas');
Route::get('/guru/Absensi', [GuruAbsensiController::class, 'index'])->name('guru.absensi');


//Siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');
Route::get('/siswa/mapel', [SiswaMapelController::class, 'index'])->name('siswa.mapel');
Route::get('/siswa/mapel/detail/{kelas_mapel_id}', [SiswaMapelController::class, 'detail'])->name('siswa.mapel.detail');
Route::get('/siswa/mapel/detail/{kelas_mapel_id}/guru', [SiswaPengajarController::class, 'index'])->name('siswa.mapel.detail.guru');
Route::get('/siswa/mapel/detail/{kelas_mapel_id}/materi', [SiswaMateriController::class, 'index'])->name('siswa.mapel.detail.materi');
Route::get('/siswa/mapel/detail/materi/{materi_id}/detail', [SiswaMateriController::class, 'detailMateri'])->name('siswa.mapel.detail.materi.detail');

Route::get('/siswa/mapel/detail/{kelas_mapel_id}/tugas', [SiswaTugasKelasController::class, 'index'])->name('siswa.mapel.detail.tugas');
Route::get('/siswa/mapel/detail/tugas/{id}/detail', [SiswaTugasKelasController::class, 'detail'])->name('siswa.mapel.detail.tugas.detail');
Route::post('/siswa/tugas/submit', [SiswaTugasKelasController::class, 'submit'])->name('siswa.tugas.submit');
Route::get('/siswa/tugas/submission/{tugas_id}', [SiswaTugasKelasController::class, 'submission'])->name('siswa.tugas.submission');

Route::get('/siswa/mapel/detail/{kelas_mapel_id}/absensi', [SiswaAbsensiKelasController::class, 'index'])->name('siswa.mapel.detail.absensi');
Route::get('/siswa/mapel/detail/{kelas_mapel_id}/absensi/data', [SiswaAbsensiKelasController::class, 'data'])->name('siswa.mapel.detail.data');
Route::get('/siswa/mapel/detail/{kelas_mapel_id}/store', [SiswaAbsensiKelasController::class, 'store'])->name('siswa.mapel.detail.store');
Route::get('/siswa/mapel/detail/absensi/show/{id}', [SiswaAbsensiKelasController::class, 'show'])->name('siswa.mapel.detail.show');

Route::get('/siswa/mapel/detail/{kelas_mapel_id}/absensi', [SiswaAbsensiKelasController::class, 'index'])->name('siswa.mapel.detail.absensi');
Route::post('/siswa/mapel/detail/absensi/submit', [SiswaAbsensiKelasController::class, 'submit'])->name('siswa.mapel.detail.absensi.submit');



Route::get('/siswa/tugas', [SiswaTugasController::class, 'index'])->name('siswa.tugas');


Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [AdminSiswaController::class, 'index'])->name('index');
        Route::get('/data', [AdminSiswaController::class, 'data'])->name('data');
        Route::post('/', [AdminSiswaController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminSiswaController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminSiswaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminSiswaController::class, 'destroy'])->name('destroy');
    });

    // CRUD Guru
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/', [AdminGuruController::class, 'index'])->name('index');
        Route::get('/data', [AdminGuruController::class, 'data'])->name('data');
        Route::post('/', [AdminGuruController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminGuruController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminGuruController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminGuruController::class, 'destroy'])->name('destroy');
    });

    // CRUD Mapel
    Route::prefix('mapel')->name('mapel.')->group(function () {
        Route::get('/', [AdminMapelController::class, 'index'])->name('index');
        Route::get('/data', [AdminMapelController::class, 'data'])->name('data');
        Route::post('/', [AdminMapelController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminMapelController::class, 'show'])->whereNumber('id')->name('show');
        Route::put('/{id}', [AdminMapelController::class, 'update'])->whereNumber('id')->name('update');
        Route::delete('/{id}', [AdminMapelController::class, 'destroy'])->whereNumber('id')->name('destroy');

        // CRUD Pengajar Mapel
        Route::post('/pengajar', [AdminPengajarController::class, 'index'])->name('pengajar.index');
        Route::get('/{mapel_id}/pengajar/data', [AdminPengajarController::class, 'data'])->name('pengajar.data');
        Route::post('/{mapel_id}/pengajar', [AdminPengajarController::class, 'store'])->name('pengajar.store');
        Route::get('/pengajar/{id}', [AdminPengajarController::class, 'show'])->name('pengajar.show');
        Route::delete('/pengajar/{id}', [AdminPengajarController::class, 'destroy'])->name('pengajar.destroy');
    });

    // CRUD Kelas
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [AdminKelasController::class, 'index'])->name('index');
        Route::get('/data', [AdminKelasController::class, 'data'])->name('data');
        Route::post('/', [AdminKelasController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminKelasController::class, 'show'])->whereNumber('id')->name('show');
        Route::put('/{id}', [AdminKelasController::class, 'update'])->whereNumber('id')->name('update');
        Route::delete('/{id}', [AdminKelasController::class, 'destroy'])->whereNumber('id')->name('destroy');
        
        Route::prefix('detail')->name('detail.')->group(function () {
            Route::get('/{kelas_id}', [AdminKelasController::class, 'detail']);
            
            Route::get('/siswa/{kelas_id}', [AdminAgtKelasController::class, 'index'])->name('siswa');
            Route::get('/{kelas_id}/siswa/data', [AdminAgtKelasController::class, 'data'])->name('siswa.data');
            Route::post('/{kelas_id}/siswa', [AdminAgtKelasController::class, 'store'])->name('siswa.store');
            Route::get('/siswa/show/{id}', [AdminAgtKelasController::class, 'show'])->name('siswa.show');
            Route::delete('/siswa/{id}', [AdminAgtKelasController::class, 'destroy'])->name('siswa.destroy');
    
            Route::get('/mapel/{kelas_id}', [AdminKelasMapelController::class, 'index'])->name('mapel');
            Route::get('/{kelas_id}/mapel/data', [AdminKelasMapelController::class, 'data'])->name('mapel.data');
            Route::post('/{kelas_id}/mapel', [AdminKelasMapelController::class, 'store'])->name('mapel.store');
            Route::delete('/mapel/{id}', [AdminKelasMapelController::class, 'destroy'])->name('mapel.destroy');
            Route::get('/mapel/{mapel_id}/guru', [AdminKelasMapelController::class, 'getGuruByMapel'])->name('mapel.guru');
        });
    });
});

Route::get('/admin/admin', [AdminDataPenggunaController::class, 'admin'])->name('admin.admin');

Route::get('/admin/materi', [AdminMateriController::class, 'index'])->name('admin.materi');
Route::get('/admin/tugas', [AdminTugasController::class, 'index'])->name('admin.tugas');

// Dashboard
Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});

// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('pages.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('pages.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('pages.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('pages.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('pages.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('pages.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('pages.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('pages.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('pages.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('pages.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('pages.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('pages.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('pages.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('pages.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('pages.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('pages.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('pages.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('pages.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('pages.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('pages.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('pages.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('pages.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('pages.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('pages.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('pages.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('pages.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('pages.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('pages.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('pages.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('pages.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('pages.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('pages.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('pages.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('pages.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('pages.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('pages.forms-validation', ['type_menu' => 'forms']);
});

// modules
Route::get('/modules-calendar', function () {
    return view('pages.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('pages.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('pages.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('pages.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('pages.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('pages.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('pages.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('pages.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('pages.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('pages.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('pages.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('pages.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
Route::get('/auth-forgot-password', function () {
    return view('pages.auth-forgot-password', ['type_menu' => 'auth']);
});
Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('pages.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('pages.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('pages.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('pages.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('pages.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('pages.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('pages.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('pages.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('pages.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('pages.features-post', ['type_menu' => 'features']);
});
Route::get('/features-profile', function () {
    return view('pages.features-profile', ['type_menu' => 'features']);
});
Route::get('/features-settings', function () {
    return view('pages.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('pages.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('pages.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('pages.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('pages.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('pages.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
