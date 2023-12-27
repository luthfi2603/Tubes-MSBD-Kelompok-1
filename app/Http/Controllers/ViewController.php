<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Ebook;
use App\Models\KontributorMahasiswa;
use App\Models\Prodi;
use App\Models\Favorite;
use App\Models\BidangIlmu;
use App\Models\KaryaTulis;
use App\Models\JenisTulisan;
use App\Models\FavoriteEbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Illuminate\Database\DatabaseManager;

class ViewController extends Controller {
    public function index(){
        session()->forget('wasRefreshed');

        if (auth()->user()) {
            if (auth()->user()->email_verified_at == NULL) {
                return redirect('/verify-email');
            }
        }
        
        $jenisTulisans = JenisTulisan::orderBy('jenis_tulisan')->get();
        $prodis = Prodi::all();
        $karyas = KaryaTulis::paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('index', compact('jenisTulisans', 'prodis', 'karyas', 'penuliss'));
    }

    public function detailKaryaTulis(Request $request, $id){
        $targetPage = '/detail-karya-tulis/' . $id;

        $wasRefreshed = Session::get('wasRefreshed', []);

        // kalo gaada dijalankan
        if (!in_array($targetPage, $wasRefreshed)) {
            $view = KaryaTulis::select('view')
                ->where('id', $id)
                ->first()
                ->view;
            $view += 1;
            KaryaTulis::where('id', $id)->update(['view' => $view]);

            $wasRefreshed[] = $targetPage;
            Session::put('wasRefreshed', $wasRefreshed);
        }

        if (auth()->user()) {
            $isLiked = Favorite::where('user_id', auth()->user()->id)
                ->where('karya_id', $id)
                ->get()
                ->isEmpty();
        } else {
            $isLiked = true;
        }

        $detail = DB::table('view_karya_tulis')
            ->select('*')
            ->where('id', $id)
            ->first();

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->groupBy('kontributor', 'status')
            ->orderBy('status')
            ->get();

        $kataKuncis = DB::table('view_karya_tulis')
            ->select('kata_kunci')
            ->where('id', $id)
            ->groupBy('kata_kunci')
            ->get();

        $kataKunci = "";
        foreach ($kataKuncis as $key) {
            $kataKunci .= $key->kata_kunci . ', ';
        }
        $kataKunci = rtrim($kataKunci, ', ');

        return view('detail-karya-tulis', compact('detail', 'kataKunci', 'penuliss', 'isLiked'));
    }

    public function showEBook(Request $request){
        session()->forget('wasRefreshed');

        $sort = $request->input('sort');
        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');

        $ebooks = Ebook::when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun_terbit', $sort);
            })
            ->where(function ($query) use ($tahunawal, $tahunakhir) {
                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun_terbit', [$tahunawal, $tahunakhir]);
                }
            })->paginate(5);

        return view('e-book', compact('ebooks', 'sort', 'tahunawal', 'tahunakhir'));
    }

    public function detailEBook($id){
        $targetPage = '/detail-e-book/' . $id;

        $wasRefreshed = Session::get('wasRefreshed', []);

        // kalo gaada dijalankan
        if (!in_array($targetPage, $wasRefreshed)) {
            $view = Ebook::select('view')
                ->where('id', $id)
                ->first()
                ->view;
            $view += 1;
            Ebook::where('id', $id)->update(['view' => $view]);

            $wasRefreshed[] = $targetPage;
            Session::put('wasRefreshed', $wasRefreshed);
        }

        if (auth()->user()) {
            $isLiked = FavoriteEbook::where('user_id', auth()->user()->id)
                ->where('ebook_id', $id)
                ->get()
                ->isEmpty();
        } else {
            $isLiked = true;
        }

        $ebook = Ebook::where('id', $id)->first();

        return view('detail-e-book', compact('ebook', 'isLiked'));
    }

    public function showByKoleksi($jenisTulisan, Request $request){
        session()->forget('wasRefreshed');

        $sort = $request->input('sort');
        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');
        $program_studi = $request->input('prodi');
        $bidang_ilmu = $request->input('bidang_ilmu');

        $prodis = Prodi::all();
        $bidIlmus = BidangIlmu::all();

        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('jenis', $jenisTulisan)
            ->where(function ($query) use ($program_studi, $bidang_ilmu, $tahunawal, $tahunakhir) {
                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun', [$tahunawal, $tahunakhir]);
                }

                if (!empty($program_studi)) {
                    $query->whereIn('kode_prodi', $program_studi);
                }

                if (!empty($bidang_ilmu)) {
                    $query->whereIn('bidang_ilmu', $bidang_ilmu);
                }
            })
            ->where('status', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun', $sort);
            })
            ->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('koleksi', compact('karyas', 'penuliss', 'jenisTulisan', 'sort', 'program_studi', 'bidang_ilmu', 'prodis', 'bidIlmus', 'tahunawal', 'tahunakhir'));
    }

    public function showByProdi($prodiParam, Request $request){
        session()->forget('wasRefreshed');

        $sort = $request->input('sort');
        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');
        $jenis_tulisan = $request->input('jenis_tulisan');
        $bidang_ilmu = $request->input('bidang_ilmu');

        $jenisTulisans = JenisTulisan::orderBy('jenis_tulisan')->get();
        $bidIlmus = BidangIlmu::all();

        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('kode_prodi', $prodiParam)
            ->where(function ($query) use ($jenis_tulisan, $bidang_ilmu, $tahunawal, $tahunakhir) {
                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun', [$tahunawal, $tahunakhir]);
                }

                if (!empty($jenis_tulisan)) {
                    $query->whereIn('jenis', $jenis_tulisan);
                }

                if (!empty($bidang_ilmu)) {
                    $query->whereIn('bidang_ilmu', $bidang_ilmu);
                }
            })
            ->where('status', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun', $sort);
            })
            ->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $prodi = Prodi::where('kode_prodi', $prodiParam)->first()->nama_prodi;

        return view('prodi', compact('karyas', 'prodi', 'prodiParam', 'penuliss', 'jenisTulisans', 'bidIlmus', 'sort', 'jenis_tulisan', 'bidang_ilmu', 'prodiParam', 'tahunawal', 'tahunakhir'));
    }

    public function showByAuthor($author, Request $request){
        session()->forget('wasRefreshed');

        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::orderBy('jenis_tulisan')->get();
        $bidIlmus = BidangIlmu::all();

        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');

        $sort = $request->input('sort');

        $jenis_tulisan = $request->input('jenis_tulisan');
        $program_studi = $request->input('prodi');
        $bidang_ilmu = $request->input('bidang_ilmu');

        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('kontributor', $author)
            ->where('status', 'penulis')
            ->where(function ($query) use ($jenis_tulisan, $program_studi, $bidang_ilmu, $tahunawal, $tahunakhir) {
                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun', [$tahunawal, $tahunakhir]);
                }

                if (!empty($jenis_tulisan)) {
                    $query->whereIn('jenis', $jenis_tulisan);
                }

                if (!empty($program_studi)) {
                    $query->whereIn('kode_prodi', $program_studi);
                }

                if (!empty($bidang_ilmu)) {
                    $query->whereIn('bidang_ilmu', $bidang_ilmu);
                }
            })
            ->groupBy('id')
            ->pluck('id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun', $sort);
            })
            ->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('author', compact('karyas', 'author', 'penuliss', 'prodis', 'jenisTulisans', 'bidIlmus', 'sort', 'tahunawal', 'tahunakhir', 'jenis_tulisan', 'bidang_ilmu', 'program_studi'));
    }

    public function viewAdvSearch(Request $request){
        session()->forget('wasRefreshed');

        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::orderBy('jenis_tulisan')->get();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $search1 = $request->input('search1');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');

        $select1 = $request->input('select1');
        $select2 = $request->input('select2');
        $select3 = $request->input('select3');

        $query1 = $request->input('query1');
        $query2 = $request->input('query2');

        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');

        $sort = $request->input('sort');

        $jenis_tulisan = $request->input('jenis_tulisan');
        $program_studi = $request->input('prodi');
        $bidang_ilmu = $request->input('bidang_ilmu');

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where(function ($query) use ($select1, $search1, $select2, $search2, $select3, $search3, $query1, $query2, $tahunawal, $tahunakhir, $jenis_tulisan, $program_studi, $bidang_ilmu) {
                $query->where($select1, 'LIKE', '%' . $search1 . '%')
                    ->where('status', '=', 'penulis');

                if ($query1 === 'OR') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->orWhere(function ($subquery) use ($select2, $search2, $select3, $search3, $query2) {
                            $subquery->where($select2, 'LIKE', '%' . $search2 . '%')
                                ->orWhere($select3, 'LIKE', '%' . $search3 . '%', $query2);
                        });
                    }
                } elseif ($query1 === 'AND') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->where($select2, 'LIKE', '%' . $search2 . '%')
                            ->where($select3, 'LIKE', '%' . $search3 . '%', $query2);
                    }
                } elseif ($query1 === 'AND NOT') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->where($select2, 'LIKE', '%' . $search2 . '%', $query1)
                            ->where($select3, 'LIKE', '%' . $search3 . '%', $query2);
                    }
                }

                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun', [$tahunawal, $tahunakhir]);
                }

                if (!empty($jenis_tulisan)) {
                    $query->whereIn('jenis', $jenis_tulisan);
                }

                if (!empty($program_studi)) {
                    $query->whereIn('kode_prodi', $program_studi);
                }

                if (!empty($bidang_ilmu)) {
                    $query->whereIn('bidang_ilmu', $bidang_ilmu);
                }
            })
            ->groupBy('id')
            ->pluck('id');


        $results = KaryaTulis::whereIn('id', $resultIds)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun', $sort);
            })
            ->paginate();

        return view('search-page', compact('prodis', 'jenisTulisans',  'penuliss', 'results', 'bidIlmus', 'tahunawal', 'tahunakhir', 'search1', 'search2', 'search3', 'select1', 'select2', 'select3', 'query1', 'query2', 'sort', 'jenis_tulisan', 'program_studi', 'bidang_ilmu'));
    }

    public function showAdvSearch(){
        session()->forget('wasRefreshed');

        return view('advanced-search');
    }

    public function search(Request $request){
        session()->forget('wasRefreshed');

        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::orderBy('jenis_tulisan')->get();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $search = $request->input('search');
        $sort = $request->input('sort');

        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');

        $jenis_tulisan = $request->input('jenis_tulisan') ?? [];
        $program_studi = $request->input('prodi') ?? [];
        $bidang_ilmu = $request->input('bidang_ilmu') ?? [];

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where(function ($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . $search . '%')
                    ->orWhere('kontributor', 'LIKE', '%' . $search . '%')
                    ->orWhere('kata_kunci', 'LIKE', '%' . $search . '%')
                    ->orWhere('abstrak', 'LIKE', '%' . $search . '%');
            })
            ->where(function ($query) use ($jenis_tulisan, $program_studi, $bidang_ilmu, $tahunawal, $tahunakhir) {
                if (!empty($tahunawal) && !empty($tahunakhir)) {
                    $query->whereBetween('tahun', [$tahunawal, $tahunakhir]);
                }

                if (!empty($jenis_tulisan)) {
                    $query->whereIn('jenis', $jenis_tulisan);
                }

                if (!empty($program_studi)) {
                    $query->whereIn('kode_prodi', $program_studi);
                }

                if (!empty($bidang_ilmu)) {
                    $query->whereIn('bidang_ilmu', $bidang_ilmu);
                }
            })
            ->where('status', '=', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $results = KaryaTulis::whereIn('id', $resultIds)
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('tahun', $sort);
            })
            ->paginate();

        return view('search-page', compact('results', 'prodis', 'jenisTulisans', 'penuliss', 'bidIlmus', 'search', 'sort', 'jenis_tulisan', 'program_studi', 'bidang_ilmu', 'tahunawal', 'tahunakhir'));
    }

    public function showFavorite(){
        session()->forget('wasRefreshed');

        $karyaIds = Favorite::select('karya_id')
            ->where('user_id', auth()->user()->id)
            ->pluck('karya_id');

        $waktu = Favorite::select('karya_id', 'waktu')
            ->where('user_id', auth()->user()->id)
            ->get();

        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('favorite', compact('karyas', 'penuliss', 'waktu'));
    }

    public function storeFavorite(Request $request){
        Favorite::create([
            'user_id' => auth()->user()->id,
            'karya_id' => $request->karya_id
        ]);

        return back()->with('success', 'Berhasil ditambahkan ke favorite');
    }

    public function destroyFavorite(Request $request){
        Favorite::where('user_id', auth()->user()->id)
            ->where('karya_id', $request->karya_id)
            ->delete();

        return back()->with('success', 'Berhasil dihapus dari favorite');
    }

    public function showFavoriteEbook(){
        session()->forget('wasRefreshed');

        $ebookIds = FavoriteEbook::select('ebook_id')
            ->where('user_id', auth()->user()->id)
            ->pluck('ebook_id');

        $waktu = FavoriteEbook::select('ebook_id', 'waktu')
            ->where('user_id', auth()->user()->id)
            ->get();

        $ebooks = Ebook::whereIn('id', $ebookIds)->paginate(5);

        return view('favorite-ebook', compact('ebooks', 'waktu'));
    }

    public function storeFavoriteEbook(Request $request){
        FavoriteEbook::create([
            'user_id' => auth()->user()->id,
            'ebook_id' => $request->ebook_id
        ]);

        return back()->with('success', 'Berhasil ditambahkan ke favorite');
    }

    public function destroyFavoriteEbook(Request $request){
        FavoriteEbook::where('user_id', auth()->user()->id)
            ->where('ebook_id', $request->ebook_id)
            ->delete();

        return back()->with('success', 'Berhasil dihapus dari favorite');
    }

    public function statistik(){
        session()->forget('wasRefreshed');

        $mostLikes = DB::table('view_most_like')->paginate(5);

        $datas = DB::table('view_statistik')->get();
        $jumlaht = DB::select("select hitungAll() AS jumlah");
        $jumlah = $jumlaht[0]->jumlah;

        $jumlahEbook = Ebook::all()->count();

        $topAuthors = DB::table('view_top_author')->paginate(5);

        $mostViews = KaryaTulis::orderByDesc('view')
            ->paginate(5);

        return view('statistik', compact('mostLikes', 'datas', 'jumlah', 'jumlahEbook', 'topAuthors', 'mostViews'));
    }

    public function bimbinganSaya(){
        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('kontributor', Dosen::where('user_id', auth()->user()->id)->first()->nama)
            ->where('status', '<>', 'penulis')
            ->where('jenis', 'Skripsi')
            ->groupBy('id')
            ->pluck('id');

        $karyas = KaryaTulis::select('id', 'judul', 'tahun')
            ->whereIn('id', $karyaIds)->paginate(10);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $angkatans = KontributorMahasiswa::join('mahasiswas', 'kontributor_mahasiswas.nim', '=', 'mahasiswas.nim')
            ->whereIn('kontributor_mahasiswas.karya_id', $karyaIds)
            ->select('kontributor_mahasiswas.*', 'mahasiswas.angkatan')
            ->get();

        return view('bimbingan-saya', compact('karyas', 'penuliss', 'angkatans'));
    }
}