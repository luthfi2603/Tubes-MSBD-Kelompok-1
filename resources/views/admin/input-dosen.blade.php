@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <form action="{{ route('dosen.input') }}" method="post">
    @csrf
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user-tie"></i> Input Dosen</h5>
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="mb-3">
                        <label for="nidn" class="form-label">NIDN</label>
                        <input type="text" class="form-control custom-form @error('nidn') is-invalid @enderror" id="nidn" name="nidn"
                            placeholder="Input NIDN Dosen" value="{{ old('nidn') }}">
                        @error('nidn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control custom-form @error('nip') is-invalid @enderror" id="nip" name="nip"
                            placeholder="Input NIP Dosen" value="{{ old('nip') }}">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama dosen</label>
                        <input type="text" class="form-control custom-form @error('nama') is-invalid @enderror" id="nama" name="nama"
                            placeholder="Input Nama Dosen" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kode_dosen" class="form-label">Kode dosen</label>
                        <input type="text" class="form-control custom-form @error('kode_dosen') is-invalid @enderror" id="kode_dosen" name="kode_dosen"
                            placeholder="Input Kode Dosen" value="{{ old('kode_dosen') }}">
                            @error('kode_dosen')
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
                        <label for="status" class="form-label">Status Dosen</label>
                        <select class="form-select custom-form @error('status') is-invalid @enderror" aria-label="Default select example" id="status" name="status">
                            <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select custom-form @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
                            <option value="" selected>Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
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
                                <option value="{{ $prodi->kode_prodi }}" {{ old('prodi') === $prodi->kode_prodi ? 'selected' : '' }}>
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

            
            <div class="inputan-form mb-5 mt-1">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('dosen.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>

        </div>
    </form>
</div>
@endsection