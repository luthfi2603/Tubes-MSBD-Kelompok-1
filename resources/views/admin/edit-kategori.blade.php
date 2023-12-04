@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h5 class="textit mb-4" style="font-weight: 600;">
            <i class="fa-solid fa-book"></i> Edit Kategori
        </h5>
        <form method="POST" action="{{ route('kategori.edit', ['jenis' => $tulisan->jenis_tulisan]) }}">
            @csrf
            @method('PUT')  
            <div class="col-lg-12">
                <div class="inputan-form" style="width: 90%;">
                    <div class="mb-3">
                        <label for="jenis_tulisan" class="form-label">Kategori</label>
                        <input type="text" class="form-control custom-form @error('jenis_tulisan') is-invalid @enderror" id="jenis_tulisan" name="jenis_tulisan" value="{{ $tulisan->jenis_tulisan }}" >
                        @error('jenis_tulisan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Edit</button>
                <a href="{{ route('kategori.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>
        </form>

    </div>
</div>
@endsection