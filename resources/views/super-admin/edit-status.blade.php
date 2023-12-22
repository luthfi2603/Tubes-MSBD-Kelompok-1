@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;">
            <i class="fa-solid fa-book"></i> Edit Status
        </h5>
        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form id="form" method="POST" action="{{ route('status.edit', ['status' => $estatus->nama_status]) }}" onsubmit="return false;">
            @csrf
            @method('PUT')  
            <div class="col-lg-12">
                <div class="inputan-form" style="width: 90%;">
                    <div class="mb-3">
                        <label for="nama_status" class="form-label">Status</label>
                        <input type="text" class="form-control custom-form @error('nama_status') is-invalid @enderror" id="nama_status" name="nama_status"
                            placeholder="Input Status" value="{{ old('nama_status', $estatus->nama_status) }}">
                        @error('nama_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tingkat" class="form-label">Tingkatan</label>
                        <select class="form-select custom-form @error('tingkat') is-invalid @enderror" aria-label="Default select example" id="tingkat" name="tingkat">
                            <option value="" selected>Pilih Tingkatan status</option>
                            <option value="0" {{ old('tingkat', $estatus->status ) == '0' ? 'selected' : '' }}>Mahasiswa dan Dosen</option>
                            <option value="1" {{ old('tingkat', $estatus->status ) == '1' ? 'selected' : '' }}>Dosen</option>
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        <div class="inputan-form mb-5">
            <button type="button" onclick="submit()" class="btn btn-success tombol">Edit</button>
            <a href="{{ route('status.kelola') }}" class="btn btn-warning tombol">Kembali</a>
        </div>
    </div>
</div>
@endsection