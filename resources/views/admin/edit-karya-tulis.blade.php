@if(old('nim_nidn') !== NULL)
    @php
        $kontributors2 = [];

        $k = 0;
        foreach (old('nim_nidn') as $key) {
            $kontributors2[] = [
                'nim_nidn' => old('nim_nidn')[$k],
                'status' => old('status')[$k],
                'tingkatan' => old('tingkatan')[$k] === '1' ? 'mahasiswa' : 'dosen'
            ];

            $k++;
        }
    @endphp
@endif

@extends('layouts.main-admin')

@section('container')
<div class="container">
    <form id="form" action="{{ route('karya.tulis.edit', $karya->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="oldFile" value="{{ $karya->url_file }}" hidden>
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Edit Karya Tulis</h5>
            @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-6">
                <div class="inputan-form">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Karya Tulis</label>
                        <textarea class="form-control custom-form @error('judul') is-invalid @enderror" placeholder="Input Judul Karya Tulis" id="judul" name="judul" style="height: 6rem">{{ old('judul', $karya->judul) }}</textarea>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control custom-form @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Input Tahun" value="{{ old('tahun', $karya->tahun) }}">
                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <a href="{{ asset('storage/' . $karya->url_file . '') }}" target="_blank">
                            <h6 class="mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i>Tampilkan file</h6>
                        </a>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-karyatulis">
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="inputan-form">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Jenis Tulisan</label>
                        <select class="form-select custom-form @error('jenis') is-invalid @enderror" name="jenis" aria-label="Default select example">
                            <option value="" selected>Pilih Jenis Tulisan</option>
                            @foreach ($jeniss as $jenis)
                                <option value="{{ $jenis->jenis_tulisan }}" {{ old('jenis', $karya->jenis) === $jenis->jenis_tulisan ? 'selected' : '' }}>{{ $jenis->jenis_tulisan }}</option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Bidang Ilmu</label>
                        <select class="form-select custom-form @error('bidang') is-invalid @enderror" aria-label="Default select example" name="bidang">
                            <option value="" selected>Pilih Bidang Ilmu</option>
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->jenis_bidang_ilmu }}" {{ old('bidang', $karya->bidang_ilmu) === $bidang->jenis_bidang_ilmu ? 'selected' : '' }}>{{ $bidang->jenis_bidang_ilmu }}</option>
                            @endforeach
                        </select>
                        @error('bidang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-10 mb-4">
                @if(old('nim_nidn') !== NULL)
                    @php $j = count($kontributors2) + 1; @endphp
                    <script>
                        let j = {{ $j }};
                    </script>
                    <button onclick="buatKolaborator2()" type="button" class="btn btn-success" style="margin-left: 30px !important"> + Kolaborator</button>
                @else
                    @error('nim_nidn')
                        <button onclick="buatKolaborator()" type="button" class="btn btn-success" style="margin-left: 30px !important"> + Kolaborator</button>
                    @else
                        @php $j = count($kontributors) + 1; @endphp
                        <script>
                            let j = {{ $j }};
                        </script>
                        <button onclick="buatKolaborator2()" type="button" class="btn btn-success" style="margin-left: 30px !important"> + Kolaborator</button>
                    @enderror
                @endif
                @error('nim_nidn')
                    <div style="color: #dc3545; font-size: 87%; margin-top: 5px; margin-left: 30px">
                        Pilih minimal satu kolaborator
                    </div>
                @enderror
            </div>
            <!-- tempat menambahkan kolaborator -->
            <div class="row" id="tambah-kolaborator">
                {{-- kalau bagian ini ga error yang lain error --}}
                @if(old('nim_nidn') !== NULL)
                    @php $i = 1; @endphp
                    @foreach($kontributors2 as $kontributor2)
                        <div class="col-lg-4" id="penulis-{{ $i }}">
                            <fieldset class="border border-dark rounded p-1 mb-4">
                                <legend style="margin-left: 15px !important">
                                    Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator({{ $i }})"></i>
                                </legend>
                                <div class="inputan-form">
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Masukkan Nama</label>
                                        <select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]">
                                            <option value="" selected>Pilih Nama</option>
                                            @foreach($kontrib as $data)
                                                <option value="{{ $data['nim_nidn'] }}" {{ $kontributor2['nim_nidn'] === $data['nim_nidn'] ? 'selected' : ''}}>{{ $data['nama'] }} - {{ $data['nim_nidn'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Tingkatan</label>
                                        <select class="form-select custom-form" aria-label="Default select example" id="tingkatan" name="tingkatan[]">
                                            <option value="" selected>Pilih Tingkatan</option>
                                            <option value="1" {{ $kontributor2['tingkatan'] === 'mahasiswa' ? 'selected' : ''}}>Mahasiswa</option>
                                            <option value="2" {{ $kontributor2['tingkatan'] === 'dosen' ? 'selected' : ''}}>Dosen</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Status</label>
                                        <select class="form-select custom-form" aria-label="Default select example" id="status" name="status[]">
                                            <option value="" selected>Pilih Status</option>
                                            @foreach($statuss as $status)
                                                <option value="{{ $status->nama_status }}" {{ $kontributor2['status'] === $status->nama_status ? 'selected' : ''}}>{{ $status->nama_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        @php $i++ @endphp
                    @endforeach
                @else
                    {{-- yang ini dijalankan pada saat pertama kali buka halaman edit --}}
                    @if(session('errors') === NULL)
                        @php $i = 1; @endphp
                        @foreach($kontributors as $kontributor)
                            <div class="col-lg-4" id="penulis-{{ $i }}">
                                <fieldset class="border border-dark rounded p-1 mb-4">
                                    <legend style="margin-left: 15px !important">
                                        Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator({{ $i }})"></i>
                                    </legend>
                                    <div class="inputan-form">
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Masukkan Nama</label>
                                            <select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]">
                                                <option value="" selected>Pilih Nama</option>
                                                @foreach($kontrib as $data)
                                                    <option value="{{ $data['nim_nidn'] }}" {{ $kontributor['nim_nidn'] === $data['nim_nidn'] ? 'selected' : ''}}>{{ $data['nama'] }} - {{ $data['nim_nidn'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Tingkatan</label>
                                            <select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="tingkatan[]">
                                                <option value="" selected>Pilih Tingkatan</option>
                                                <option value="1" {{ $kontributor['tingkatan'] === 'mahasiswa' ? 'selected' : ''}}>Mahasiswa</option>
                                                <option value="2" {{ $kontributor['tingkatan'] === 'dosen' ? 'selected' : ''}}>Dosen</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Status</label>
                                            <select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="status[]">
                                                <option value="" selected>Pilih Status</option>
                                                @foreach($statuss as $status)
                                                    <option value="{{ $status->nama_status }}" {{ $kontributor['status'] === $status->nama_status ? 'selected' : ''}}>{{ $status->nama_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            @php $i++ @endphp
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="inputan mb-3">
                <label for="kategori" class="form-label">Kata Kunci</label>
                <select class="form-select custom-form @error('kunci') is-invalid @enderror" aria-label="Default select example" id="kunci" name="kunci[]" multiple="multiple">
                    @if(old('kunci') !== NULL)
                        @foreach ($kuncis as $kunci)
                            <option value="{{ $kunci->kata_kunci }}" 
                                @foreach (old('kunci') as $kakun)
                                    {{ $kakun === $kunci->kata_kunci ? 'selected' : '' }}
                                @endforeach>
                                {{ $kunci->kata_kunci }}
                            </option>
                        @endforeach
                    @else
                        @error('kunci')
                            @foreach ($kuncis as $kunci)
                                <option value="{{ $kunci->kata_kunci }}">
                                    {{ $kunci->kata_kunci }}
                                </option>
                            @endforeach
                        @else
                            @foreach ($kuncis as $kunci)
                                <option value="{{ $kunci->kata_kunci }}" 
                                    @foreach ($karya_kunci as $kakun)
                                        {{ $kakun->kata_kunci === $kunci->kata_kunci ? 'selected' : '' }}
                                    @endforeach>
                                    {{ $kunci->kata_kunci }}
                                </option>
                            @endforeach
                        @enderror
                    @endif
                </select>
                @error('kunci')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="inputan mb-4">
                <label for="abstrak" class="form-label">Abstrak</label>
                <textarea class="form-control custom-form @error('abstrak') is-invalid @enderror" placeholder="Input Abstrak" id="abstrak" name="abstrak" style="height: 15rem">{{ old('abstrak', $karya->abstrak) }}</textarea>
                @error('abstrak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </form>
    <div class="inputan-form mb-5">
        <button type="button" onclick="submit()" class="btn btn-success tombol">Submit</button>
        <a href="{{ route('karya.tulis.kelola') }}" class="btn btn-warning tombol">Kembali</a>
    </div>
</div>
@endsection