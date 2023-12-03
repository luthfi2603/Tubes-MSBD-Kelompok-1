<?php

namespace App\Http\Controllers;

use App\Models\BidangIlmu;
use App\Models\Ebook;
use App\Models\Prodi;
use App\Models\JenisTulisan;
use App\Models\KaryaTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->email_verified_at == NULL) {
                return redirect('/verify-email');
            }
        }
        $jenisTulisans = JenisTulisan::all();
        $prodis = Prodi::all();
        $karyas = KaryaTulis::paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        return view('index', compact('jenisTulisans', 'prodis', 'karyas', 'penuliss'));
    }

    public function detailKaryaTulis($id)
    {
        $detail = DB::table('view_detail_karya_tulis')
            ->select('*')
            ->where('id', $id)
            ->first();

        $penulis = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'status')
            ->get();

        $pembimbing = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'pembimbing')
            ->groupBy('kontributor', 'status')
            ->get();

        $kontributor = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'kontributor')
            ->groupBy('kontributor', 'status')
            ->get();

        $kataKuncis = DB::table('view_detail_karya_tulis')
            ->select('kata_kunci')
            ->where('id', $id)
            ->groupBy('kata_kunci')
            ->get();

        $kataKunci = "";
        foreach ($kataKuncis as $key) {
            $kataKunci .= $key->kata_kunci . ', ';
        }
        $kataKunci = rtrim($kataKunci, ', ');

        return view('/detail-karya-tulis', compact('detail', 'kataKunci', 'penulis', 'pembimbing', 'kontributor'));
    }

    public function showEBook()
    {
        $ebooks = Ebook::paginate(5);

        return view('e-book', compact('ebooks'));
    }

    public function detailEBook($id)
    {
        $ebook = Ebook::where('id', $id)->get();

        $ebook = $ebook[0];

        return view('detail-e-book', compact('ebook'));
    }

    public function showByKoleksi($jenisTulisan)
    {
        $karyas = KaryaTulis::where('jenis', $jenisTulisan)->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        return view('koleksi', compact('karyas', 'penuliss', 'jenisTulisan'));
    }

    public function showByProdi()
    {
        return view('prodi');
    }

    public function showByAuthor($author)
    {
        $karyas = DB::table('view_list_karya')
            ->select('*')
            ->where('penulis', $author)
            ->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        return view('author', compact('karyas', 'author', 'penuliss'));
    }

    public function viewAdvSearch(Request $request)
    {
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
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

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where(function ($query) use ($select1, $search1, $select2, $search2, $select3, $search3, $query1, $query2) {
                $query->where($select1, 'LIKE', '%' . $search1 . '%')
                    ->where('status', '=', 'penulis');

                // Menggunakan $query1
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
            })
            ->orWhereBetween('tahun', [$tahunawal, $tahunakhir])
            ->groupBy('id')
            ->pluck('id');

        $results = KaryaTulis::whereIn('id', $resultIds)->paginate(5);

        return view('search-page', compact('prodis', 'jenisTulisans',  'penuliss', 'results', 'bidIlmus'));
    }

    public function search(Request $request)
    {
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        $search = $request->input('search');

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->orWhere(function ($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . $search . '%')
                    ->orWhere('kontributor', 'LIKE', '%' . $search . '%')
                    ->orWhere('kata_kunci', 'LIKE', '%' . $search . '%');
            })
            ->where('status', '=', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $results = KaryaTulis::whereIn('id', $resultIds)->paginate(5);

        return view('search-page', compact('results', 'prodis', 'jenisTulisans', 'penuliss', 'bidIlmus'));
    }
}
