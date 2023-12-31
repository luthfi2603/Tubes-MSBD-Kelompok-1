<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
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
Route::get('/detail-karya-tulis/{id}', [ViewController::class, 'detailKaryaTulis'])
    ->name('detail.karya.tulis');
Route::get('/e-book', [ViewController::class, 'showEBook'])
    ->name('ebook');
Route::get('/detail-e-book/{id}', [ViewController::class, 'detailEBook'])
    ->name('detail.ebook');
Route::get('/koleksi/{jenisTulisan}', [ViewController::class, 'showByKoleksi'])
    ->name('koleksi');
Route::get('/prodi/{prodi}', [ViewController::class, 'showByProdi'])
    ->name('prodi');
Route::get('/author/{author}', [ViewController::class, 'showByAuthor'])
    ->name('author');
Route::get('/search-page', [ViewController::class, 'search'])
    ->name('search');
Route::get('/adv-search-page', [ViewController::class, 'viewAdvSearch'])
    ->name('advanced.search');
Route::get('/advanced-search', [ViewController::class, 'showAdvSearch'])
    ->name('advanced.search.page');
Route::get('/statistik', [ViewController::class, 'statistik'])
    ->name('statistik');
Route::get('/bimbingan-saya', [ViewController::class, 'bimbinganSaya'])
    ->middleware(['auth', 'verified', 'role:dosen'])
    ->name('bimbingan.saya');

Route::middleware(['auth', 'verified', 'role:admin,super_admin'])->group(function () {
    Route::get('/admin-home', [AdminController::class, 'index'])
        ->name('admin.home');

    Route::get('/kelola-karya-tulis', [AdminController::class, 'showKaryaTulis'])
        ->name('karya.tulis.kelola');
    Route::get('/input-karya-tulis', [AdminController::class, 'createKaryaTulis'])
        ->name('karya.tulis.input');
    Route::post('/input-karya-tulis', [AdminController::class, 'storeKaryaTulis']);
    Route::get('/edit-karya-tulis/{id}', [AdminController::class, 'editKaryaTulis'])
        ->name('karya.tulis.edit');
    Route::put('/edit-karya-tulis/{id}', [AdminController::class, 'updateKaryaTulis']);
    Route::delete('/kelola-karya-tulis/{karya}', [AdminController::class, 'destroyKaryaTulis'])
        ->name('karya.tulis.delete');

    Route::get('/get-mahasiswa-dan-dosen', [AdminController::class, 'getMahasiswaDanDosen']);
    Route::get('/get-status-kontributor', [AdminController::class, 'getStatusKontributor']);

    Route::get('/kelola-jenis-tulisan', [AdminController::class, 'showJenisTulisan'])
        ->name('jenis.tulisan.kelola');
    Route::get('/input-jenis-tulisan', [AdminController::class, 'createJenisTulisan'])
        ->name('jenis.tulisan.input');
    Route::post('/input-jenis-tulisan', [AdminController::class, 'storeJenisTulisan']);
    Route::get('/edit-jenis-tulisan/{jenis}', [AdminController::class, 'editJenisTulisan'])
        ->name('jenis.tulisan.edit');
    Route::put('/edit-jenis-tulisan/{jenis}', [AdminController::class, 'updateJenisTulisan']);
    Route::delete('/delete-jenis-tulisan/{jenisTulisan}', [AdminController::class, 'destroyJenisTulisan'])
        ->name('jenis.tulisan.delete');

    Route::get('/kelola-mahasiswa', [AdminController::class, 'showMahasiswa'])
        ->name('mahasiswa.kelola');
    Route::get('/input-mahasiswa', [AdminController::class, 'createMahasiswa'])
        ->name('mahasiswa.input');
    Route::post('/input-mahasiswa', [AdminController::class, 'storeMahasiswa']);
    Route::get('/edit-mahasiswa/{nim}', [AdminController::class, 'editMahasiswa'])
        ->name('mahasiswa.edit');
    Route::put('/edit-mahasiswa/{nim}', [AdminController::class, 'updateMahasiswa']);
    Route::delete('/delete-mahasiswa/{mahasiswa}', [AdminController::class, 'destroyMahasiswa'])
        ->name('mahasiswa.delete');

    Route::get('/kelola-dosen', [AdminController::class, 'showDosen'])
        ->name('dosen.kelola');
    Route::get('/input-dosen', [AdminController::class, 'createDosen'])
        ->name('dosen.input');
    Route::post('/input-dosen', [AdminController::class, 'storeDosen']);
    Route::get('/edit-dosen/{nidn}', [AdminController::class, 'editDosen'])
        ->name('dosen.edit');
    Route::put('/edit-dosen/{nidn}', [AdminController::class, 'updateDosen']);
    Route::delete('/delete-dosen/{dosen}', [AdminController::class, 'destroyDosen'])
        ->name('dosen.delete');

    Route::get('/kelola-user', [AdminController::class, 'showUser'])
        ->name('user.kelola');
    Route::get('/input-user', [AdminController::class, 'createUser'])
        ->name('user.input');
    Route::post('/input-user', [AdminController::class, 'storeUser']);
    Route::get('/edit-user/{id}', [AdminController::class, 'editUser'])
        ->name('user.edit');
    Route::put('/edit-user/{id}', [AdminController::class, 'updateUser']);
    Route::delete('/kelola-user/{id}', [AdminController::class, 'destroyUser'])
        ->name('user.delete');
    
    Route::get('/kelola-bidang-ilmu', [AdminController::class, 'showBidangIlmu'])
        ->name('bidang.ilmu.kelola');
    Route::get('/input-bidang-ilmu', [AdminController::class, 'createBidangIlmu'])
        ->name('bidang.ilmu.input');
    Route::post('/input-bidang-ilmu', [AdminController::class, 'storeBidangIlmu']);
    Route::get('/edit-bidang-ilmu/{bidang}', [AdminController::class, 'editBidangIlmu'])
        ->name('bidang.ilmu.edit');
    Route::put('/edit-bidang-ilmu/{bidang}', [AdminController::class, 'updateBidangIlmu']);
    Route::delete('/delete-bidang-ilmu/{bidangIlmu}', [AdminController::class, 'destroyBidangIlmu'])
        ->name('bidang.ilmu.delete');
    
    Route::get('/kelola-kata-kunci', [AdminController::class, 'showKataKunci'])
        ->name('kata.kunci.kelola');
    Route::get('/input-kata-kunci', [AdminController::class, 'createKataKunci'])
        ->name('kata.kunci.input');
    Route::post('/input-kata-kunci', [AdminController::class, 'storeKataKunci']);
    Route::get('/edit-kata-kunci/{kunci}', [AdminController::class, 'editKataKunci'])
        ->name('kata.kunci.edit');
    Route::put('/edit-kata-kunci/{kunci}', [AdminController::class, 'updateKataKunci']);
    Route::delete('/kelola-kata-kunci/{kunci}', [AdminController::class, 'destroyKataKunci'])
        ->name('kata.kunci.delete');

    Route::get('/kelola-e-book', [AdminController::class, 'showEBook'])
        ->name('ebook.kelola');
    Route::get('/input-e-book', [AdminController::class, 'createEBook'])
        ->name('ebook.input');
    Route::post('/input-e-book', [AdminController::class, 'storeEBook']);
    Route::get('/edit-e-book/{ebook}', [AdminController::class, 'editEBook'])
        ->name('ebook.edit');
    Route::put('/edit-e-book/{ebook}', [AdminController::class, 'updateEBook']);
    Route::delete('/delete-e-book/{ebook}', [AdminController::class, 'destroyEBook'])
        ->name('ebook.delete');
});

Route::middleware(['auth', 'verified', 'role:super_admin'])->group(function () {
    Route::get('/super-admin-home', [SuperAdminController::class, 'index'])
        ->name('super.admin.home');
    Route::get('/kelola-pegawai', [SuperAdminController::class, 'showPegawai'])
        ->name('pegawai.kelola');
    Route::get('/input-pegawai', [SuperAdminController::class, 'createPegawai'])
        ->name('pegawai.input');
    Route::post('/input-pegawai', [SuperAdminController::class, 'storePegawai']);
    Route::get('/edit-pegawai/{idp}/{idu}', [SuperAdminController::class, 'editPegawai'])
        ->name('pegawai.edit');
    Route::put('/edit-pegawai/{idp}/{idu}', [SuperAdminController::class, 'updatePegawai']);
    Route::delete('/kelola-pegawai', [SuperAdminController::class, 'destroyPegawai'])
        ->name('pegawai.delete');

    Route::get('/kelola-status', [SuperAdminController::class, 'showStatus'])
        ->name('status.kelola');
    Route::get('/input-status', [SuperAdminController::class, 'createStatus'])
        ->name('status.input');
    Route::post('/input-status', [SuperAdminController::class, 'storeStatus']);
    Route::get('/edit-status/{status}', [SuperAdminController::class, 'editStatus'])
        ->name('status.edit');
    Route::put('/edit-status/{status}', [SuperAdminController::class, 'updateStatus']);
    Route::delete('/kelola-status/{status}', [SuperAdminController::class, 'destroyStatus'])
        ->name('status.delete');

    Route::get('/log', [AdminController::class, 'showLog'])
        ->name('log');
});

Route::middleware(['auth', 'verified', 'role:mahasiswa,dosen,admin,super_admin'])->group(function () {
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
    Route::get('/favorite', [ViewController::class, 'showFavorite'])
        ->name('favorite');
    Route::post('/favorite', [ViewController::class, 'storeFavorite']);
    Route::delete('/favorite', [ViewController::class, 'destroyFavorite']);
    Route::get('/favorite-ebook', [ViewController::class, 'showFavoriteEbook'])
        ->name('favorite-ebook');
    Route::post('/favorite-ebook', [ViewController::class, 'storeFavoriteEbook']);
    Route::delete('/favorite-ebook', [ViewController::class, 'destroyFavoriteEbook']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';