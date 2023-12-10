
@extends('layouts.main-admin')

@section('container')
<div class="container mb-5">
    <form action="{{ route('pegawai.input') }}" method="post">
        @csrf
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user"></i> Input Pegawai</h5>
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
                        <label for="nama" class="form-label">Nama</label>
                        <input name="nama" value="{{ old('nama') }}" type="text" class="form-control custom-form @error('nama') is-invalid @enderror" id="nama" placeholder="Input Nama Pegawai" autofocus>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" value="{{ old('username') }}" type="text" class="form-control custom-form @error('username') is-invalid @enderror" id="username" placeholder="Input Username Pegawai">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="{{ old('email') }}" type="email" class="form-control custom-form @error('email') is-invalid @enderror" name="email" id="email" placeholder="Input Email Pegawai">
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
                        <div class="row">
                            <div class="col-11">
                                <input type="password" name="password" id="password" class="form-control custom-form @error('password') is-invalid @enderror" placeholder="Password">
                            </div>
                            <div class="col-1 p-0" style="padding-top: 6px !important">
                                <i class="fa-regular fa-eye fa-xl" id="eye-password"></i>
                            </div>
                        </div>
                        @error('password')
                            <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="konfirmasi_password">Konfirmasi Password</label>
                        <div class="row">
                            <div class="col-11">
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control custom-form @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password">
                            </div>
                            <div class="col-1 p-0" style="padding-top: 6px !important">
                                <i class="fa-regular fa-eye fa-xl" id="eye-konfirmasi-password"></i>
                            </div>
                        </div>
                        @error('konfirmasi_password')
                            <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
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
<script>
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-password');

    eyeIcon.addEventListener('click', () => {
        const passwordInputType = passwordInput.getAttribute('type');

        if (passwordInputType === 'password') {
            passwordInput.setAttribute('type', 'text');
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.setAttribute('type', 'password');
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }

        eyeIcon.style.right = `${passwordInput.offsetWidth - 20}px`;
    });
    
    const passwordInput2 = document.getElementById('konfirmasi_password');
    const eyeIcon2 = document.getElementById('eye-konfirmasi-password');

    eyeIcon2.addEventListener('click', () => {
        const passwordInputType2 = passwordInput2.getAttribute('type');

        if (passwordInputType2 === 'password') {
            passwordInput2.setAttribute('type', 'text');
            eyeIcon2.classList.remove('fa-eye');
            eyeIcon2.classList.add('fa-eye-slash');
        } else {
            passwordInput2.setAttribute('type', 'password');
            eyeIcon2.classList.remove('fa-eye-slash');
            eyeIcon2.classList.add('fa-eye');
        }

        eyeIcon2.style.right = `${passwordInput2.offsetWidth - 20}px`;
    });
</script>
@endsection