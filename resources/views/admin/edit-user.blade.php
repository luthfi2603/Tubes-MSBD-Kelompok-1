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
    <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="post">
        @csrf
        @method('PUT')   
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-users"></i> Edit User</h5>
            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="mb-3">
                        <label for="username" class="form-label">username</label>
                        <input type="text" class="form-control custom-form @error('username') is-invalid @enderror" id="username" placeholder="" name="username" value="{{ $user->username }}">
                        @error('username')
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control custom-form @error('email') is-invalid @enderror" id="email" placeholder="" name="email" value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('user.kelola') }}" class="btn btn-warning tombol">Kembali</a>
            </div>

        </div>
    </form>
</div>
@endsection