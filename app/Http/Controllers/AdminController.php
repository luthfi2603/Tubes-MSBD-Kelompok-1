<?php

namespace App\Http\Controllers;

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
        // dd($karyas);
        return view('admin.kelola-karya-tulis', compact('karyas'));
    }
    public function showJenisTulisan(){
        $kategoris = JenisTulisan::paginate(20);
        // dd($kategoris);
        return view('admin.kelola-kategori', compact('kategoris'));
    }
    public function createKaryaTulis(){
        return view('admin.input-karya-tulis');
    }
    public function createJenisTulisan(){
        return view('admin.input-kategori');
    }

    public function storeKaryaTulis(Request $request){
        
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

        $tulisan = JenisTulisan::find($jenis, 'jenis_tulisan');
        // $jenis_tulisan = $kategori_tulisan;
        // dd($jenis_tulisan); 
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
