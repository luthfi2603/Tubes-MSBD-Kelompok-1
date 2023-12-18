@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <form id="form" action="{{ route('ebook.edit', $ebook->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Edit E-Book</h5>
            @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-6">
                <div class="inputan-form">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul E-Book</label>
                        <textarea class="form-control custom-form @error('judul') is-invalid @enderror" placeholder="Input Judul E-Book" id="judul" name="judul" style="height: 6rem">{{ old('judul', $ebook->judul) }}</textarea>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control custom-form @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Input Tahun Terbit" value="{{ old('tahun', $ebook->tahun_terbit) }}">
                        @error('tahun')
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
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control custom-form @error('penulis') is-invalid @enderror" id="penulis" name="penulis" placeholder="Input Penulis" value="{{ old('penulis', $ebook->penulis) }}">
                        @error('penulis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <a href="{{ asset('storage/' . $ebook->url_file . '') }}" target="_blank">
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
        </div>
    </form>
    <div class="inputan-form mb-5">
        <button type="button" onclick="submit()" class="btn btn-success tombol">Submit</button>
        <a href="{{ route('ebook.kelola') }}" class="btn btn-warning tombol">Kembali</a>
    </div>
</div>
@endsection