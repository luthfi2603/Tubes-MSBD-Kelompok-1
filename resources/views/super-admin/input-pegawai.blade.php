
@extends('layouts.main-admin')

@section('container')
<div class="container mb-5">
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
    <form action="{{ route('pegawai.input') }}" method="post">
    @csrf
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user"></i> Input Pegawai</h5>
            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control custom-form @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Input Nama Pegawai">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control custom-form @error('username') is-invalid @enderror" name="username" id="username" placeholder="Input Username Pegawai">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control custom-form @error('email') is-invalid @enderror" name="email" id="email" placeholder="Input Email Pegawai">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control custom-form @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control custom-form @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password">
                        @error('konfirmasi_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('pegawai.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>

        </div>
    </form>
</div>
@endsection