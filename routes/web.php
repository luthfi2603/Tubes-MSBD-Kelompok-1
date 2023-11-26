<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    if(auth()->user()){
        if(auth()->user()->email_verified_at == NULL){
            return redirect('/verify-email');
        }
    }
    return view('index');
});

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
// profile
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/detail-search', function () {
    return view('detail-search');
})->name('detail.search');
Route::get('/favorite', function () {
    return view('favorite');
});
Route::get('/advanced-search', function () {
    return view('advanced-search');
});
Route::get('/edit-password', function () {
    return view('edit-password');
});
Route::get('/edit-profile', function () {
    return view('edit-profile');
});

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::get('/admin-home', function () {
        return view('admin.admin-home');
    })->name('admin.home');
    Route::get('/edit-karya-tulis', function () {
        return view('admin.edit-karya-tulis');
    })->name('edit.karya.tulis');
    Route::get('/edit-kategori', function () {
        return view('admin.edit-kategori');
    })->name('edit.kategori');
    Route::get('/input-karya-tulis', function () {
        return view('admin.input-karya-tulis');
    })->name('input.karya.tulis');
    Route::get('/input-kategori', function () {
        return view('admin.input-kategori');
    })->name('input.kategori');
    Route::get('/kelola-karya-tulis', function () {
        return view('admin.kelola-karya-tulis');
    })->name('kelola.karya.tulis');
    Route::get('/kelola-kategori', function () {
        return view('admin.kelola-kategori');
    })->name('kelola.kategori');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/edit-pegawai', function () {
        return view('super-admin.edit-pegawai');
    })->name('edit.pegawai');
    Route::get('/edit-user', function () {
        return view('super-admin.edit-user');
    })->name('edit.user');
    Route::get('/kelola-pegawai', function () {
        return view('super-admin.kelola-pegawai');
    })->name('kelola.pegawai');
    Route::get('/kelola-user', function () {
        return view('super-admin.kelola-user');
    })->name('kelola.user');
    Route::get('/super-admin-home', function () {
        return view('super-admin.super-admin-home');
    })->name('super.admin.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile2', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';