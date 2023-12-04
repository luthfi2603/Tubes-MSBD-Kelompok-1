<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController;

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
Route::get('/', [ViewController::class, 'index']);
Route::get('/search-page', function () {
    return view('search-page');
});
Route::get('/single-author', function () {
    return view('single-author');
});
Route::get('/statistik', function () {
    return view('statistik');
});
Route::get('/single-prodi', function () {
    return view('single-prodi');
})->name('single.prodi');
Route::get('/single-koleksi', function () {
    return view('single-koleksi');
})->name('single.koleksi');
Route::get('/detail-search', function () {
    return view('detail-search');
})->name('detail.search');
Route::get('/favorite', function () {
    return view('favorite');
});
Route::get('/advanced-search', function () {
    return view('advanced-search');
});
Route::get('/single-ebook', function () {
    return view('single-ebook');
})->name('single.ebook');
Route::get('/detail-ebook', function () {
    return view('detail-ebook');
})->name('detail.ebook');

Route::middleware(['auth', 'verified', 'role:admin,super_admin'])->group(function () {
    Route::get('/admin-home', [AdminController::class, 'index'])
                ->name('admin.home');
    Route::get('/kelola-karya-tulis', [AdminController::class, 'showKaryaTulis'])
                ->name('kelola.karya.tulis');
    Route::get('/kelola-kategori', [AdminController::class, 'showJenisTulisan'])
                ->name('kategori.kelola');
    Route::get('/input-kategori', [AdminController::class, 'createJenisTulisan'])
                ->name('kategori.input');
    Route::post('/input-kategori', [AdminController::class, 'storeJenisTulisan']);
    Route::get('/edit-kategori/{jenis}', [AdminController::class, 'editJenisTulisan'])
                ->name('kategori.edit');
    Route::put('/edit-kategori/{jenis}', [AdminController::class, 'updateJenisTulisan']);
    Route::delete('/kategori-kelola/{jenis}', [AdminController::class, 'destroyJenisTulisan'])
                ->name('kategori.delete');
    Route::get('/kelola-mahasiswa', [AdminController::class, 'showMahasiswa'])
                ->name('mahasiswa.kelola');
    Route::get('/input-mahasiswa', [AdminController::class, 'createMahasiswa'])
                ->name('mahasiswa.input');
    Route::post('/input-mahasiswa', [AdminController::class, 'storeMahasiswa']);
    Route::get('/edit-mahasiswa/{nim}', [AdminController::class, 'editMahasiswa'])
                ->name('mahasiswa.edit');
    Route::put('/edit-mahasiswa/{nim}', [AdminController::class, 'updateMahasiswa']);
    Route::get('/kelola-dosen', [AdminController::class, 'showDosen'])
                ->name('dosen.kelola');
    Route::get('/input-dosen', [AdminController::class, 'createDosen'])
                ->name('dosen.input');
    Route::post('/input-dosen', [AdminController::class, 'storeDosen']);
    Route::get('/edit-dosen', [AdminController::class, 'editDosen'])
                ->name('dosen.edit');
    Route::get('/edit-dosen/{nidn}', [AdminController::class, 'updateDosen']);

    Route::get('/edit-user', function () {
        return view('super-admin.edit-user');
    })->name('edit.user');
    
    Route::get('/kelola-user', function () {
        return view('super-admin.kelola-user');
    })->name('kelola.user');
    Route::get('/input-user', function () {
        return view('super-admin.input-user');
    })->name('input.user');
    



    Route::get('/edit-karya-tulis', function () {   
        return view('admin.edit-karya-tulis');
    })->name('edit.karya.tulis');
    Route::get('/input-karya-tulis', function () {
        return view('admin.input-karya-tulis');
    })->name('input.karya.tulis');
});

Route::middleware(['auth', 'verified', 'role:super_admin'])->group(function () {
    Route::get('/edit-pegawai', function () {
        return view('super-admin.edit-pegawai');
    })->name('edit.pegawai');
    Route::get('/kelola-pegawai', function () {
        return view('super-admin.kelola-pegawai');
    })->name('kelola.pegawai');
    Route::get('/input-pegawai', function () {
        return view('super-admin.input-pegawai');
    })->name('input.pegawai');
    
    Route::get('/super-admin-home', function () {
        return view('super-admin.super-admin-home2');
    })->name('super.admin.home');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])
                ->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'editProfile'])
                ->name('profile.edit');
    Route::put('/edit-profile', [ProfileController::class, 'updateProfile'])
                ->name('profile.update2');
    Route::patch('/profile', [ProfileController::class, 'update'])
                ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
                ->name('profile.destroy');
    Route::get('/edit-password', [ProfileController::class, 'editPassword'])
                ->name('password.edit');
    Route::put('/edit-password', [ProfileController::class, 'updatePassword'])
                ->name('password.update2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';