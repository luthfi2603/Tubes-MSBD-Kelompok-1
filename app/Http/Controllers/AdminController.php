<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\KataKunci;
use App\Models\Mahasiswa;
use App\Models\BidangIlmu;
use App\Models\KaryaTulis;
use App\Models\JenisTulisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $karyas = KaryaTulis::paginate(10);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();
        return view('admin.kelola-karya-tulis', compact('karyas', 'penuliss'));
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
            'jenis_tulisan' => ['required', 'unique:jenis_tulisans']            
        ]);

        $jenis_tulisan = new JenisTulisan;
        $jenis_tulisan->jenis_tulisan = $request->jenis_tulisan;

        $jenis_tulisan->save();

        return back()->with('success', 'Jenis tulisan berhasil ditambahkan');
    }
    public function editJenisTulisan($jenis){
        $tulisan = JenisTulisan::find($jenis);
        return view('admin.edit-kategori', compact('tulisan'));
    }
    public function updateJenisTulisan(Request $request, $jenis){
        $tulisan = JenisTulisan::find($jenis);

        if($tulisan->jenis_tulisan == $request->jenis_tulisan){
            // dd($tulisan);
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }else{
            $request->validate([
                'jenis_tulisan' => ['required', 'unique:jenis_tulisans']
            ]);
        }
        
        $tulisan->jenis_tulisan = $request->jenis_tulisan;

        $tulisan->save();

        return redirect()->route('kategori.kelola')->with('success', 'Jenis tulisan berhasil diedit');
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

        if(
            $mahasiswa->nim == $request->nim &&
            $mahasiswa->nama == $request->nama &&
            $mahasiswa->angkatan == $request->angkatan &&
            $mahasiswa->jenis_kelamin == $request->jenis_kelamin &&
            $mahasiswa->status == $request->status &&
            $mahasiswa->kode_prodi == $request->prodi
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }


        if($mahasiswa->nim != $request->nim){
            $request->validate([
                'nim' => ['required','numeric', 'digits:9', 'unique:mahasiswas'],
            ]);
        }
        $request->validate([
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

    public function showDosen(){
        $dosens = Dosen::paginate(10);
        $prodis = Prodi::all();
        return view('admin.kelola-dosen', compact('dosens', 'prodis'));
    }

    public function createDosen(){
        $prodis = Prodi::all();
        return view('admin.input-dosen', compact('prodis'));
    }

    public function storeDosen(Request $request){
        $request->validate([
            'nidn' => ['required','numeric', 'digits:10', 'unique:dosens'],
            'nip' => ['required','numeric', 'digits:18', 'unique:dosens'],
            'nama' => ['required','regex:/^[^*\/]+$/'],
            'kode_dosen' => ['required', 'alpha', 'uppercase', 'size:3'],
            'jenis_kelamin' => ['required'],
            'prodi' => ['required'],
            'status' => ['required']
        ]);
        
        $dosen = new Dosen;

        $dosen->nidn = $request->nidn;
        $dosen->nip = $request->nip;
        $dosen->nama = $request->nama;
        $dosen->kode_dosen = $request->kode_dosen;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->status = $request->status;
        $dosen->user_id = 1;
        $dosen->kode_prodi = $request->prodi;

        $dosen->save();

        return back()->with('success', 'Data Dosen berhasil ditambahkan');
    }

    public function editDosen($nidn){
        $dosen = Dosen::find($nidn);
        $prodis = Prodi::all();
        return view('admin.edit-dosen', compact('dosen','prodis'));
    }

    public function updateDosen(Request $request, $nidn){
        $dosen = Dosen::find($nidn);

        if(
            $dosen->nidn == $request->nidn &&
            $dosen->nip == $request->nip &&
            $dosen->nama == $request->nama &&
            $dosen->kode_dosen == $request->kode_dosen &&
            $dosen->jenis_kelamin == $request->jenis_kelamin &&
            $dosen->status == $request->status &&
            $dosen->kode_prodi == $request->prodi
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        if($request->nidn != $dosen->nidn){
            $request->validate([
                'nidn' => ['required','numeric', 'digits:10', 'unique:dosens'],
            ]);
        };
        if($request->nip != $dosen->nip){
            $request->validate([
                'nip' => ['required','numeric', 'digits:18', 'unique:dosens'],
            ]);
        };

        $request->validate([
            'nama' => ['required','regex:/^[^*\/]+$/'],
            'kode_dosen' => ['required', 'alpha', 'uppercase', 'size:3'],
            'jenis_kelamin' => ['required'],
            'prodi' => ['required'],
            'status' => ['required']
        ]);
        

        $dosen->nidn = $request->nidn;
        $dosen->nip = $request->nip;
        $dosen->nama = $request->nama;
        $dosen->kode_dosen = $request->kode_dosen;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->status = $request->status;
        $dosen->kode_prodi = $request->prodi;

        $dosen->save();

        return redirect()->route('dosen.kelola')->with('success', 'data dosen berhasil di edit');
    }

    public function showUser(){
        $users = DB::table('view_all_user')->paginate(10);
        $prodis = Prodi::all();
        return view('admin.kelola-user', compact('users', 'prodis'));
    }
    public function createUser(){
        $prodis = Prodi::all();
        return view('admin.input-user', compact('prodis'));
    }
    public function storeUser(Request $request){
        $request->validate([
            'username' => ['required', 'min:1', 'max:30', 'unique:users'],
            'status' => ['required'],
            'nim_nidn' => ['required', 'numeric'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:1'],
            'konfirmasi_password' => ['required', 'same:password', 'min:1']
        ]);

        $password = Hash::make($request->password);

        if($request->status == 'mahasiswa'){
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nidn, 1));
            }catch(\Throwable $th){
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }else{
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nidn, 2));
            } catch (\Throwable $th) {
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }

        return back()->with('success', 'Data user berhasil ditambahkan');
    }
    public function editUser($id){
        $user = User::find($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if(
            $request->username == $user->username &&
            $request->email == $user->email
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        $rules = [];

        if($request->username != $user->username){
            $rules['username'] = ['required', 'string', 'max:255', 'unique:users'];
        }

        if($request->email != $user->email){
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:'.User::class.'';
        }

        $validatedData = $request->validate($rules);
        
        if($request->email != $user->email){
            $validatedData['email_verified_at'] = NULL;
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect()->route('user.kelola')->with('success', 'data user berhasil di edit');
    }
    public function destroyUser(Request $request, $id){
        if($request->status == 'mahasiswa'){
            DB::select('call deleteUser(?, ?, ?)', array($request->nim_nidn, 1, $id));
        }else{
            DB::select('call deleteUser(?, ?, ?)', array($request->nim_nidn, 2, $id));
        }
        return back()->with('success', 'data user berhasil di hapus');
    }

    public function showBidangIlmu(){
        $bidangs = BidangIlmu::paginate(10);
        return view('admin.kelola-bidang-ilmu', compact('bidangs'));
    }
    public function createBidangIlmu(){
        return view('admin.input-bidang-ilmu');
    }
    public function storeBidangIlmu(Request $request){

        $request->validate([
            'jenis_bidang_ilmu' => ['required', 'unique:bidang_ilmus']            
        ]);

        $bidang_ilmu = new BidangIlmu;
        $bidang_ilmu->jenis_bidang_ilmu = $request->jenis_bidang_ilmu;

        $bidang_ilmu->save();

        return back()->with('success', 'Bidang ilmu berhasil ditambahkan');
    }
    public function editBidangIlmu($bidang){
        $bidang_ilmu = BidangIlmu::find($bidang);
        return view('admin.edit-bidang-ilmu', compact('bidang_ilmu'));
    }
    public function updateBidangIlmu(Request $request, $bidang){
        $bidang_ilmu = BidangIlmu::find($bidang);

        if($bidang_ilmu->jenis_bidang_ilmu == $request->jenis_bidang_ilmu){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }else{
            $request->validate([
                'jenis_bidang_ilmu' => ['required', 'unique:bidang_ilmus']
            ]);
        }

        $bidang_ilmu->jenis_bidang_ilmu = $request->jenis_bidang_ilmu;

        $bidang_ilmu->save();

        return redirect()->route('bidang.ilmu.kelola')->with('success', 'bidang ilmu berhasil diedit');
    }

    public function showKataKunci(){
        $kuncis = KataKunci::paginate(10);
        return view('admin.kelola-kata-kunci', compact('kuncis'));
    }
    public function createKataKunci(){
        return view('admin.input-kata-kunci');
    }
    public function storeKataKunci(Request $request){
        $request->validate([
            'kata_kunci' => ['required', 'unique:kata_kuncis']            
        ]);

        $kata_kunci = new KataKunci;
        $kata_kunci->kata_kunci = $request->kata_kunci;

        $kata_kunci->save();

        return back()->with('success', 'Kata Kunci berhasil ditambahkan');
    
    }
    public function editKataKunci($kunci){
        $kata_kunci = KataKunci::find($kunci);
        return view('admin.edit-kata-kunci', compact('kata_kunci'));
    }
    public function updateKataKunci(Request $request, $kunci){
        $kata_kunci = KataKunci::find($kunci);

        if($kata_kunci->kata_kunci == $request->kata_kunci){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }else{
            $request->validate([
                'kata_kunci' => ['required', 'unique:kata_kuncis']
            ]);
        }

        $kata_kunci->kata_kunci = $request->kata_kunci;

        $kata_kunci->save();

        return redirect()->route('kata.kunci.kelola')->with('success', 'kata kunci berhasil diedit');
    }
    public function destroyKataKunci($kunci){
        $kata_kunci = KataKunci::find($kunci);

        $kata_kunci->delete();
        return back()->with('success', 'Kata kunci berhasil di hapus');
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
