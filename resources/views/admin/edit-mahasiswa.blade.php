@extends('layouts.main-admin')

@section('container')
    <div class="container">
        <form id="form" method="POST" action="{{ route('mahasiswa.edit', ['nim' => $mahasiswa->nim]) }}">
            @csrf
            @method('PUT')
            <div class="row mt-4">
                <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-regular fa-id-card"></i> Edit Mahasiswa</h5>
                @if(session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="inputan-form">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nim</label>
                            <input type="text" class="form-control custom-form @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Input NIM Mahasiswa" value="{{ $mahasiswa->nim }}">
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control custom-form @error('nama') is-invalid @enderror"
                                id="nama" name="nama" placeholder="Input Nama Mahasiswa"
                                value="{{ $mahasiswa->nama }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select custom-form @error('jenis_kelamin') is-invalid @enderror" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ $mahasiswa->jenis_kelamin === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ $mahasiswa->jenis_kelamin === 'P' ? 'selected' : '' }}>Perempuan</option>
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
                            <input type="text" class="form-control custom-form @error('angkatan') is-invalid @enderror"
                                id="angkatan" name="angkatan" placeholder="Angkatan" value="{{ $mahasiswa->angkatan }}">
                            @error('angkatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Mahasiswa</label>
                            <select class="form-select custom-form @error('status') is-invalid @enderror" aria-label="Default select example" id="status" name="status">
                                <option value="aktif" {{ $mahasiswa->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ $mahasiswa->status === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="lulus" {{ $mahasiswa->status === 'lulus' ? 'selected' : '' }}>Lulus</option>
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
                                    <option value="{{ $prodi->kode_prodi }}" {{ $mahasiswa->kode_prodi === $prodi->kode_prodi ? 'selected' : '' }}>
                                        {{ $prodi->jenjang }}&nbsp;{{ $prodi->nama_prodi }}
                                    </option>
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
            </div>
        </form>
        <div class="inputan-form mb-5 mt-3">
            <button type="button" onclick="submit()" class="btn btn-success tombol">Submit</button>
            <a href="{{ route('mahasiswa.kelola') }}" class="btn btn-warning tombol">Kembali</a>
        </div>
    </div>
@endsection