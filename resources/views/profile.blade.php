@extends('layouts.main2')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
        <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>Profile</span>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ route('password.edit') }}">Change password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" value="{{ $profile->username }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" value="{{ $profile->nama }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" value="{{ $profile->email }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Prodi</label>
                                            <input type="text" class="form-control" value="{{ $profile->nama_prodi }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if(auth()->user()->status == 'mahasiswa')
                                            <div class="form-group mb-3">
                                                <label class="form-label">NIM</label>
                                                <input type="text" class="form-control" value="{{ $profile->nim }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Angkatan</label>
                                                <input type="text" class="form-control" value="{{ $profile->angkatan }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Status</label>
                                                <input type="text" class="form-control" value="{{ $profile->status }}" readonly>
                                            </div>
                                        @else
                                            <div class="form-group mb-3">
                                                <label class="form-label">NIDN</label>
                                                <input type="text" class="form-control" value="{{ $profile->nidn }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">NIP</label>
                                                <input type="text" class="form-control" value="{{ $profile->nip }}" readonly>
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <input type="text" class="form-control" value="{{ $profile->jenis_kelamin }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3 mb-5">
            <a type="button" href="{{ route('profile.edit') }}" id="" class="btn btn-success">Edit Profile</a>&nbsp;
        </div>
    </div>
</div>
@endsection