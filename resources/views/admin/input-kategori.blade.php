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
            <i class="fa-solid fa-book"></i> Input Kategori
        </h5>
        <form method="POST" action="{{ route('kategori.input') }}">
            @csrf
            <div class="col-lg-12">
                <div class="inputan-form" style="width: 90%;">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control custom-form" id="kategori" name="kategori"
                            placeholder="Input Kategori">
                    </div>
                </div>
            </div>
            
            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('kategori.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>
        </form>

    </div>
</div>
@endsection