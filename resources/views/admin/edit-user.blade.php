@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="POST" id="form">
        @csrf
        @method('PUT')   
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-users"></i> Edit User</h5>
            @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 mx-auto" role="alert" style="width: 93%">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-6">
                <div class="inputan-form">
                    <div class="mb-3">
                        <label for="username" class="form-label">username</label>
                        <input type="text" class="form-control custom-form @error('username') is-invalid @enderror" id="username" placeholder="Username" name="username" value="{{ old('username', $user->username) }}">
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
                        <input type="email" class="form-control custom-form @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="inputan-form mb-5 mt-1">
        <button type="button" onclick="submit()" class="btn btn-success tombol">Submit</button>
        <a href="{{ route('user.kelola') }}" class="btn btn-warning tombol">Kembali</a>
    </div>
</div>
@endsection