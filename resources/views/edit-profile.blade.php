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
        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('profile.update2') }}" method="POST" id="form">
            @csrf
            @method('PUT')
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-2">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ route('profile') }}">General</a>
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
                                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ auth()->user()->username }}">
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="text-right mt-3 mb-5">
            <button type="button" id="submitbutton" class="btn btn-success">Save changes</button>&nbsp;
            {{-- <button type="button" id="cancelbutton" class="btn btn-default">Cancel</button> --}}
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@endsection