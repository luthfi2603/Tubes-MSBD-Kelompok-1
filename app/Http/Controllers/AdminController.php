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
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(){
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
        $bidangs = BidangIlmu::all();
        $kuncis = KataKunci::all();
        $jeniss = JenisTulisan::orderBy('jenis_tulisan')->get();
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        return view('admin.input-karya-tulis', compact('bidangs', 'kuncis', 'jeniss', 'mahasiswas', 'dosens'));
    }
    public function storeKaryaTulis(Request $request){
        dd($request->request);
    }

    public function showJenisTulisan(){
        $kategoris = JenisTulisan::oldest()->paginate(20);

        return view('admin.kelola-jenis-tulisan', compact('kategoris'));
    }
    public function createJenisTulisan(){
        return view('admin.input-jenis-tulisan');
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

        return view('admin.edit-jenis-tulisan', compact('tulisan'));
    }
    public function updateJenisTulisan(Request $request, $jenis){
        $tulisan = JenisTulisan::find($jenis);

        if($tulisan->jenis_tulisan == $request->jenis_tulisan){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }else{
            $request->validate([
                'jenis_tulisan' => ['required', 'unique:jenis_tulisans']
            ]);
        }
        
        $tulisan->jenis_tulisan = $request->jenis_tulisan;

        $tulisan->save();

        return redirect()->route('jenis.tulisan.kelola')->with('success', 'Jenis tulisan berhasil diubah');
    }

    public function showMahasiswa(){
        $mahasiswas = Mahasiswa::orderBy('nama')->paginate(10);
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
            'nama' => ['required','regex:/^[^\*\'\"\-]+$/'],
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
                'nim' => ['required','numeric', 'digits:9', 'unique:mahasiswas']
            ]);
        }
        $request->validate([
            'nama' => ['required','regex:/^[^\*\'\"\-]+$/'],
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

        return redirect()->route('mahasiswa.kelola')->with('success', 'Data mahasiswa berhasil diubah');
    }

    public function showDosen(){
        $dosens = Dosen::orderBy('nama')->paginate(10);
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

        return redirect()->route('dosen.kelola')->with('success', 'Data dosen berhasil diubah');
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
            'username' => ['required', 'min:5', 'max:15', 'unique:users', 'regex:/^[^\s]+$/'],
            'status' => ['required'],
            'nim_nidn' => ['required', 'min_digits:9', 'max_digits:10', 'numeric'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ], ['username.regex' => 'Username tidak boleh mengandung spasi.']);

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

        event(new Registered(User::latest()->first()));

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
            $rules['username'] = ['required', 'min:5', 'max:15', 'unique:users', 'regex:/^[^\s]+$/'];
        }

        if($request->email != $user->email){
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:'.User::class.'';
        }

        $validatedData = $request->validate($rules, ['username.regex' => 'Username tidak boleh mengandung spasi.']);
        
        if($request->email != $user->email){
            $validatedData['email_verified_at'] = NULL;
        }

        User::where('id', $user->id)->update($validatedData);

        event(new Registered(User::find($user->id)));

        return redirect()->route('user.kelola')->with('success', 'Data user berhasil diubah');
    }
    public function destroyUser(Request $request, $id){
        if($request->status == 'mahasiswa'){
            DB::select('call deleteUser(?, ?, ?)', array($request->nim_nidn, 1, $id));
        }else{
            DB::select('call deleteUser(?, ?, ?)', array($request->nim_nidn, 2, $id));
        }
        
        return back()->with('success', 'Data user berhasil dihapus');
    }

    public function showBidangIlmu(){
        $bidangs = BidangIlmu::oldest()->paginate(10);

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

        return redirect()->route('bidang.ilmu.kelola')->with('success', 'Bidang ilmu berhasil diubah');
    }

    public function showKataKunci(){
        $kuncis = KataKunci::oldest()->paginate(10);

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

        return redirect()->route('kata.kunci.kelola')->with('success', 'Kata kunci berhasil diubah');
    }
    public function destroyKataKunci($kunci){
        $kata_kunci = KataKunci::find($kunci);

        $kata_kunci->delete();

        return back()->with('success', 'Kata kunci berhasil dihapus');
    }
    
    public function getMahasiswaDanDosen(){
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return response()->json(['mahasiswas' => $mahasiswas, 'dosens' => $dosens]);
    }
}