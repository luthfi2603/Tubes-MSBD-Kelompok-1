@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;">
            <i class="fa-solid fa-book"></i> Input Kata Kunci
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
        <form method="POST" action="{{ route('kata.kunci.input') }}">
            @csrf
            <div class="col-lg-12">
                <div class="inputan-form" style="width: 90%;">
                    <div class="mb-3">
                        <label for="kata_kunci" class="form-label">Kata Kunci</label>
                        <input type="text" class="form-control custom-form @error('kata_kunci') is-invalid @enderror" id="kata_kunci" name="kata_kunci"
                            placeholder="Input Kata Kunci">
                            @error('kata_kunci')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                </div>
            </div>
            
            <div class="inputan-form mb-5 mt-4">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('kata.kunci.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>
        </form>

    </div>
</div>
@endsection