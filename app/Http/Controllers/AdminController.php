<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Ebook;
use App\Models\Prodi;
use App\Models\KataKunci;
use App\Models\Mahasiswa;
use App\Models\BidangIlmu;
use App\Models\KaryaTulis;
use Illuminate\Support\Str;
use App\Models\JenisTulisan;
use Illuminate\Http\Request;
use App\Models\KataKunciTulisan;
use App\Models\KontributorDosen;
use Illuminate\Support\Facades\DB;
use App\Models\KontributorMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\DatabaseManager;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(){
        session()->forget('wasRefreshed');

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
        $mahasiswas = Mahasiswa::select('nim', 'nama')->orderBy('nama')->get();
        $dosens = Dosen::select('nidn', 'nama')->orderBy('nama')->get();
        $kontrib = [];

        foreach ($mahasiswas as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nim,
                'nama' => $key->nama
            ];
        }
        
        foreach ($dosens as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nidn,
                'nama' => $key->nama
            ];
        }

        return view('admin.input-karya-tulis', compact('bidangs', 'kuncis', 'jeniss', 'kontrib'));
    }
    public function storeKaryaTulis(Request $request){
        $request->validate([
            'nim_nidn' => ['required'],
            'judul' => ['required', 'max:500'],
            'tahun' => ['required', 'numeric', 'digits:4'],
            'jenis' => ['required'],
            'bidang' => ['required'],
            'kunci' => ['required'],
            'abstrak' => ['required'],
            'file' => ['required','file', 'mimes:pdf']
        ],[
            'kunci.required' => 'Pilih paling tidak satu kata kunci.'
        ]);

        $kolaboratorp = [];
        $kuncip = [];

        for ($i = 0; $i < count($request->kunci); $i++) {
            $kuncip[] = [
                'kunci' => $request->kunci[$i]
            ];
        }
        
        for ($i = 0; $i < count($request->nim_nidn); $i++) {
            $kolaboratorp[] = [
                'nim_nidn' => $request->nim_nidn[$i],
                'tingkatan' => $request->tingkatan[$i],
                'status' => $request->status[$i]
            ];
        }

        $kolab = json_encode($kolaboratorp);
        $kunci = json_encode($kuncip);
        $admin = Auth::user()->username;

        $namaFile = Str::random(40);
        $namaFile2 = $namaFile . '.pdf';
        $namaFile = 'document/' . $namaFile . '.pdf';

        try {
            DB::select('call createKaryaTulis(?, ?, ?, ?, ?, ?, ?, ?, ?)', array($request->judul, $request->abstrak, $request->bidang, $namaFile, $request->jenis, $request->tahun, $admin, $kolab, $kunci));

            $request->file('file')->move(storage_path('app\\public\\document'), $namaFile2);
        } catch (QueryException $th) {
            return back()->with('failed', 'Terjadi kesalahan, karya tulis gagal ditambahkan');
        }
        
        return back()->with('success', 'Karya tulis berhasil ditambahkan');
    }
    public function editKaryaTulis($id){
        $karya = KaryaTulis::find($id);
        $karya_kunci = KataKunciTulisan::where('karya_id', $id)->get();
        $bidangs = BidangIlmu::all();
        $kuncis = KataKunci::all();
        $jeniss = JenisTulisan::all();
        $mahasiswas = KontributorMahasiswa::where('karya_id', $id)->get();
        $dosens = KontributorDosen::where('karya_id', $id)->get();

        $kontributors = [];

        foreach ($mahasiswas as $key) {
            $kontributors[] = [
                'nim_nidn' => $key->nim,
                'status' => $key->status,
                'tingkatan' => 'mahasiswa'
            ];
        }
        
        foreach ($dosens as $key) {
            $kontributors[] = [
                'nim_nidn' => $key->nidn,
                'status' => $key->status,
                'tingkatan' => 'dosen'
            ];
        }
        
        $mahasiswas = Mahasiswa::select('nim', 'nama')->orderBy('nama')->get();
        $dosens = Dosen::select('nidn', 'nama')->orderBy('nama')->get();
        $kontrib = [];

        foreach ($mahasiswas as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nim,
                'nama' => $key->nama
            ];
        }
        
        foreach ($dosens as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nidn,
                'nama' => $key->nama
            ];
        }

        return view('admin.edit-karya-tulis', compact('bidangs', 'kuncis', 'jeniss', 'karya', 'karya_kunci', 'kontributors', 'kontrib'));
    }
    public function updateKaryaTulis(Request $request, $id){
        $karya = KaryaTulis::find($id);
        $mahasiswa = KontributorMahasiswa::where('karya_id', $id)->get();
        $dosen = KontributorDosen::where('karya_id', $id)->get();
        $kuncis = KataKunciTulisan::where('karya_id', $id)->get();

        $rules = [
            'nim_nidn' => ['required'],
            'judul' => ['required', 'max:500'],
            'tahun' => ['required', 'numeric', 'digits:4'],
            'jenis' => ['required'],
            'bidang' => ['required'],
            'kunci' => ['required'],
            'abstrak' => ['required']
        ];

        if($request->hasFile('file')){
            $rules['file'] = ['required','file', 'mimes:pdf'];
        }

        $request->validate($rules, ['kunci.required' => 'Pilih paling tidak satu kata kunci.']);

        $kontrib = [];
        $kunci = [];
        $kontribr = [];
        $kuncip = [];

        foreach ($kuncis as $key) {
            $kunci[] = $key->kata_kunci;
        }

        for ($i = 0; $i < count($request->kunci); $i++) {
            $kuncip[] = [
                'kunci' => $request->kunci[$i]
            ];
        }

        foreach ($mahasiswa as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nim,
                'status' => $key->status,
                'tingkatan' => '1'
            ];
        }

        foreach ($dosen as $key) {
            $kontrib[] = [
                'nim_nidn' => $key->nidn,
                'status' => $key->status,
                'tingkatan' => '2'
            ];
        }
        
        for ($i = 0; $i < count($request->nim_nidn); $i++) {
            $kontribr[] = [
                'nim_nidn' => $request->nim_nidn[$i],
                'tingkatan' => $request->tingkatan[$i],
                'status' => $request->status[$i]
            ];
        }

        $hasil_kunci1 = array_diff($request->kunci, $kunci);
        $hasil_kunci2 = array_diff($kunci, $request->kunci);
        $hasil_kunci = array_merge($hasil_kunci1, $hasil_kunci2);
        
        foreach ($kontribr as $key => $item) {
            $nimNidn2 = $item["nim_nidn"];
            $status2 = $item["status"];
        
            $indexInArray1 = array_search($nimNidn2, array_column($kontrib, "nim_nidn"));
        
            if ($indexInArray1 !== false) {
                $status1 = $kontrib[$indexInArray1]["status"];
        
                if ($status1 !== $status2) {
                    $kolab_temp[] = [
                        "nim_nidn" => $nimNidn2,
                        "status" => $status2,
                        "tingkatan" => $item["tingkatan"],
                        "kondisi" => 2
                    ];
                }else{
                    $kolab_temp[] = [
                        "nim_nidn" => $nimNidn2,
                        "status" => $status1,
                        "tingkatan" => $item["tingkatan"],
                        "kondisi" => 1
                    ];
                }
            }else{
                $kolab_temp[] = [
                    "nim_nidn" => $nimNidn2,
                    "status" => $status2,
                    "tingkatan" => $item["tingkatan"],
                    "kondisi" => 3
                ];
            }
            $status_kontrib[] = $kolab_temp[$key]['kondisi'];
        }

        foreach ($kontrib as $key => $kb) {
            if (!in_array($kb, $kontribr)) {
                $status_kontrib[$key] = 3;
            }
        }

        if ($request->hasFile('file')) {
            $namaFile = Str::random(40);
            $namaFile2 = $namaFile . '.pdf';
            $namaFile = 'document/' . $namaFile . '.pdf';
        }else{
            $namaFile = $request->oldFile;
        }

        if(
            empty($hasil_kunci) &&
            count(array_filter($status_kontrib, function ($item) {return $item == 1; })) == count($status_kontrib) &&
            $karya->judul == $request->judul &&
            $karya->abstrak == $request->abstrak &&
            $karya->bidang_ilmu == $request->bidang &&
            $karya->tahun == $request->tahun &&
            $karya->jenis == $request->jenis &&
            $karya->url_file === $namaFile
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        $kolab = json_encode($kolab_temp);
        $kunci = json_encode($kuncip);
        $admin = Auth::user()->username;

        try {
            DB::select('call editKaryaTulis(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array($request->judul, $request->abstrak, $request->bidang, $namaFile, $request->jenis, $request->tahun, $id, $admin, $kolab, $kunci));

            if(!empty($namaFile2)){
                Storage::delete($request->oldFile);
                $request->file('file')->move(storage_path('app\\public\\document'), $namaFile2);
            }
        } catch (\Throwable $th) {
            return back()->with('failed', 'Terjadi kesalahan karya tulis gagal diubah');
        }

        return redirect()->route('karya.tulis.kelola')->with('success', 'Karya tulis berhasil diubah');
    }
    public function destroyKaryaTulis(KaryaTulis $karya){
        Storage::delete($karya->url_file);
        $admin = Auth::user()->username;

        DB::select('call trigger_delete_karya_tulis(?, ?)', array($admin, $karya->id));

        return back()->with('success', 'Karya Tulis berhasil dihapus');
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
            'jenis_tulisan' => ['required', 'unique:jenis_tulisans', 'max:255']            
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
                'jenis_tulisan' => ['required', 'unique:jenis_tulisans', 'max:255']
            ]);
        }
        
        $tulisan->jenis_tulisan = $request->jenis_tulisan;

        $tulisan->save();

        return redirect()->route('jenis.tulisan.kelola')->with('success', 'Jenis tulisan berhasil diubah');
    }
    public function destroyJenisTulisan($jenisTulisan){
        $jenisTulisan = JenisTulisan::find($jenisTulisan);

        try {
            $jenisTulisan->delete();
    
            return back()->with('success', 'Jenis tulisan berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Jenis tulisan ini digunakan, penghapusan tidak dapat dilakukan');
        }
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
            'nama' => ['required','regex:/^[^\*\'\"\-]+$/', 'max:255'],
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

        $rules = [
            'nama' => ['required','regex:/^[^\*\'\"\-]+$/', 'max:255'],
            'jenis_kelamin' => ['required'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'status' => ['required'],
            'prodi' => ['required'],
        ];

        if($mahasiswa->nim != $request->nim){
            $rules['nim'] = ['required','numeric', 'digits:9', 'unique:mahasiswas'];
        }

        $request->validate($rules);
        
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->status = $request->status;
        $mahasiswa->kode_prodi = $request->prodi;

        $mahasiswa->save();

        return redirect()->route('mahasiswa.kelola')->with('success', 'Data mahasiswa berhasil diubah');
    }

    public function destroyMahasiswa($mahasiswa){
        $mahasiswa = Mahasiswa::find($mahasiswa);

        try {
            $mahasiswa->delete();
    
            return back()->with('success', 'Data Mahasiswa berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Data Mahasiswa ini memiliki keterkaitan dengan data lain, penghapusan tidak dapat dilakukan');
        }
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
            'nama' => ['required','regex:/^[^*\/]+$/', 'max:255'],
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

        $rules = [
            'nama' => ['required','regex:/^[^*\/]+$/', 'max:255'],
            'kode_dosen' => ['required', 'alpha', 'uppercase', 'size:3'],
            'jenis_kelamin' => ['required'],
            'prodi' => ['required'],
            'status' => ['required']
        ];

        if($request->nidn != $dosen->nidn){
            $rules['nidn'] = ['required','numeric', 'digits:10', 'unique:dosens'];
        };
        if($request->nip != $dosen->nip){
            $rules['nip'] = ['required','numeric', 'digits:18', 'unique:dosens'];
        };

        $request->validate($rules);

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

    public function destroyDosen($dosen){
        $dosen = Dosen::find($dosen);

        try {
            $dosen->delete();
    
            return back()->with('success', 'Data Dosen berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Data Dosen ini memiliki keterkaitan dengan data lain, penghapusan tidak dapat dilakukan');
        }
    }

    public function showUser(){
        $users = DB::table('view_all_user')->orderBy('nama')->paginate(10);
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
            'jenis_bidang_ilmu' => ['required', 'unique:bidang_ilmus', 'max:255']            
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
                'jenis_bidang_ilmu' => ['required', 'unique:bidang_ilmus', 'max:255']
            ]);
        }

        $bidang_ilmu->jenis_bidang_ilmu = $request->jenis_bidang_ilmu;

        $bidang_ilmu->save();

        return redirect()->route('bidang.ilmu.kelola')->with('success', 'Bidang ilmu berhasil diubah');
    }

    public function destroyBidangIlmu($bidangIlmu){
        $bidangIlmu = BidangIlmu::find($bidangIlmu);

        try {
            $bidangIlmu->delete();
    
            return back()->with('success', 'BIdang Ilmu berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('failed', 'BIdang Ilmu ini digunakan, penghapusan tidak dapat dilakukan');
        }
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
            'kata_kunci' => ['required', 'unique:kata_kuncis', 'max:20']            
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
                'kata_kunci' => ['required', 'unique:kata_kuncis', 'max:20']
            ]);
        }

        $kata_kunci->kata_kunci = $request->kata_kunci;

        $kata_kunci->save();

        return redirect()->route('kata.kunci.kelola')->with('success', 'Kata kunci berhasil diubah');
    }
    public function destroyKataKunci($kunci){
        $kataKunci = KataKunci::find($kunci);

        $kataKunciTulisan = KataKunciTulisan::where('kata_kunci', $kunci)->get();

        $jumlahKataKunci = [];
        foreach ($kataKunciTulisan as $key) {
            $jumlahKataKunci[] = KataKunciTulisan::where('karya_id', $key->karya_id)->count();
        }

        if(in_array(1, $jumlahKataKunci)){
            return back()->with('failed', 'Kata Kunci dibutuhkan oleh sebuah karya tulis, penghapusan tidak dapat dilakukan');
        }else{
            $kataKunci->delete();
            return back()->with('success', 'Kata kunci berhasil dihapus');
        }
    }

    public function showEBook(){
        $ebooks = Ebook::orderBy('judul')->paginate(10);

        return view('admin.kelola-e-book', compact('ebooks'));
    }
    public function createEBook(){
        return view('admin.input-e-book');
    }
    public function storeEBook(Request $request){
        $request->validate([
            'judul' => ['required', 'max:500'],
            'penulis' => ['required', 'max:255'],
            'tahun' => ['required', 'min_digits:4', 'max_digits:4'],
            'file' => ['required','file', 'mimes:pdf']
        ]);

        $namaFile = $request->file('file')->store('document');

        $validatedData = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'url_file' => $namaFile,
            'tahun_terbit' => $request->tahun,
            'view' => 0,
            'diupload_oleh' => Auth::user()->username
        ];

        Ebook::create($validatedData);

        return back()->with('success', 'E-Book berhasil ditambahkan');
    }
    public function editEBook(Ebook $ebook){
        return view('admin.edit-e-book', compact('ebook'));
    }
    public function updateEBook($ebook, Request $request){
        $ebook = Ebook::find($ebook);

        if(
            $request->judul == $ebook->judul &&
            $request->tahun == $ebook->tahun_terbit &&
            $request->penulis == $ebook->penulis &&
            !$request->hasFile('file')
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        $request->validate([
            'judul' => ['required', 'max:500'],
            'penulis' => ['required', 'max:255'],
            'tahun' => ['required', 'numeric', 'digits:4'],
            'file' => ['file', 'mimes:pdf']
        ]);

        if($request->hasFile('file')){
            Storage::delete($ebook->url_file);
            
            $namaFile = $request->file('file')->store('document');
            
            $validatedData = [
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'url_file' => $namaFile,
                'tahun_terbit' => $request->tahun
            ];
        }else{
            $validatedData = [
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'tahun_terbit' => $request->tahun
            ];
        }

        $ebook->update($validatedData);
        
        return redirect()->route('ebook.kelola')->with('success', 'E-Book berhasil diubah');
    }
    public function destroyEBook(Ebook $ebook){
        Storage::delete($ebook->url_file);

        $admin = Auth::user()->username;

        DB::select('call trigger_delete_ebook(?, ?)', array($admin, $ebook->id));

        return back()->with('success', 'E-Book berhasil dihapus');
    }

    public function showLog(){
        $logs = DB::table('view_list_log')->paginate(10);

        return view('admin.list-log', compact('logs'));
    }
    
    public function getMahasiswaDanDosen(){
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return response()->json(['mahasiswas' => $mahasiswas, 'dosens' => $dosens]);
    }
}