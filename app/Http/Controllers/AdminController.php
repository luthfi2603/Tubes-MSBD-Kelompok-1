<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\JenisTulisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin-home');
    }

    public function showKaryaTulis(){
        $karyas = DB::table('view_list_karya')
        ->select('*')
        ->paginate(10);
        return view('admin.kelola-karya-tulis', compact('karyas'));
    }
    
    public function createKaryaTulis(){
        return view('admin.input-karya-tulis');
    }
    public function storeKaryaTulis(Request $request){
        
    }

    public function showJenisTulisan(){
        $kategoris = JenisTulisan::paginate(20);
        return view('admin.kelola-kategori', compact('kategoris'));
    }
    public function createJenisTulisan(){
        return view('admin.input-kategori');
    }
    public function storeJenisTulisan(Request $request){
        $request->validate([
            'kategori' => ['required']            
        ]);

        $jenis_tulisan = new JenisTulisan;
        $jenis_tulisan->jenis_tulisan = $request->kategori;

        $jenis_tulisan->save();

        return back()->with('success', 'Jenis tulisan berhasil ditambahkan');
    }
    public function editJenisTulisan($jenis){
        $tulisan = JenisTulisan::find($jenis);
        return view('admin.edit-kategori', compact('tulisan'));
    }
    public function updateJenisTulisan(Request $request, $jenis){
        $tulisan = JenisTulisan::find($jenis, 'jenis_tulisan');
        
        $request->validate([
            'kategori' => ['required']
        ]);

        $tulisan->jenis_tulisan = $request->kategori;

        $tulisan->save();

        return redirect()->route('kategori.kelola')->with('success', 'kategori berhasil diedit');
    }
    public function destroyJenisTulisan($jenis){
        $tulisan = JenisTulisan::find($jenis, 'jenis_tulisan');
        $tulisan->delete();

        return back()->with('success', 'kategori berhasil dihapus');
    }

    public function showMahasiswa(){
        $mahasiswas = Mahasiswa::paginate(10);
        $prodis = Prodi::all();

        return view('admin.kelola-mahasiswa', compact('mahasiswas', 'prodis'));
    }
    public function createMahasiswa(){
        $prodis = Prodi::all();
        return view('admin.input-mahasiswa', compact('prodis'));
    }

    public function storeMahasiswa(Request $request){
        $request->validate([
            'nim' => ['required','numeric', 'digits:9', 'unique:mahasiswas'],
            'nama' => ['required','regex:/^[^*\/]+$/'],
            'jenis_kelamin' => ['required'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'status' => ['required'],
            'prodi' => ['required'],
        ]);
        
        $mahasiswa = new Mahasiswa;

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->status = $request->status;
        $mahasiswa->user_id = 1;
        $mahasiswa->kode_prodi = $request->prodi;

        $mahasiswa->save();

        return back()->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function editMahasiswa($nim){
        $mahasiswa = Mahasiswa::find($nim);
        $prodis = Prodi::all();
        return view('admin.edit-mahasiswa', compact('mahasiswa', 'prodis'));
    }

    public function updateMahasiswa(Request $request, $nim){
        
        $mahasiswa = Mahasiswa::find($nim);

        $request->validate([
            'nim' => ['required','numeric', 'digits:9'],
            'nama' => ['required','regex:/^[^*\/]+$/'],
            'jenis_kelamin' => ['required'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'status' => ['required'],
            'prodi' => ['required'],
        ]);
        
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->status = $request->status;
        $mahasiswa->kode_prodi = $request->prodi;

        $mahasiswa->save();

        return redirect()->route('mahasiswa.kelola')->with('success', 'data mahasiswa berhasil di edit');
    }

    

    


    

    

    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
