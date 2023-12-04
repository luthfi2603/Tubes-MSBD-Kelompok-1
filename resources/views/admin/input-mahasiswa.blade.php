@extends('layouts.main-admin')

@section('container')
<div class="container">
    @if(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-4" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{ route('mahasiswa.input') }}">
        @csrf
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-regular fa-id-card"></i> Input Mahasiswa</h5>
                <div class="col-lg-6">
                    <div class="inputan-form">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim</label>
                            <input type="text" class="form-control custom-form @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Input NIM Mahasiswa" value="{{ old('nim') }}">
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control custom-form @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Input Nama Mahasiswa" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select custom-form @error('jenis_kelamin') is-invalid @enderror" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
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
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" class="form-control custom-form @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan" placeholder="Angkatan" value="{{ old('angkatan') }}">
                            @error('angkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Mahasiswa</label>
                            <select class="form-select custom-form @error('status') is-invalid @enderror" aria-label="Default select example" id="status" name="status">
                                <option selected value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                                <option value="lulus">Lulus</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select custom-form @error('prodi') is-invalid @enderror" aria-label="Default select example" id="prodi" name="prodi">
                                <option value="" selected>Pilih Program Studi</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->jenjang }}&nbsp;{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
            
            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('mahasiswa.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>

        </div>
</form>
</div>
@endsection