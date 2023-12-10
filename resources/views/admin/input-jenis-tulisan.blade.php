@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;">
            <i class="fa-solid fa-book"></i> Input Jenis Tulisan
        </h5>
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
        <form method="POST" action="{{ route('jenis.tulisan.input') }}">
            @csrf
            <div class="col-lg-12">
                <div class="inputan-form" style="width: 90%;">
                    <div class="mb-3">
                        <label for="jenis_tulisan" class="form-label">Jenis Tulisan</label>
                        <input type="text" class="form-control custom-form @error('jenis_tulisan') is-invalid @enderror" id="jenis_tulisan" name="jenis_tulisan"
                            placeholder="Input Jenis Tulisan" value="{{ old('jenis_tulisan') }}">
                            @error('jenis_tulisan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
            </div>
            
            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('jenis.tulisan.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>
        </form>

    </div>
</div>
@endsection