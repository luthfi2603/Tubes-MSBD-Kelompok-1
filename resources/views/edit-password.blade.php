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
        <form action="{{ route('password.update2') }}" method="POST" id="form">
            @csrf
            @method('PUT')
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ route('profile') }}">General</a>
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#">Change password</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-change-password">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="old_password">Old Password</label>
                                                <div class="row">
                                                    <div class="col-11">
                                                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password">
                                                    </div>
                                                    <div class="col-1 p-0" style="padding-top: 7px !important">
                                                        <i class="fa-regular fa-eye fa-xl" id="eye-old-password"></i>
                                                    </div>
                                                </div>
                                                @error('old_password')
                                                    <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="new_password">New Password</label>
                                                <div class="row">
                                                    <div class="col-11">
                                                        <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">
                                                    </div>
                                                    <div class="col-1 p-0" style="padding-top: 7px !important">
                                                        <i class="fa-regular fa-eye fa-xl" id="eye-new-password"></i>
                                                    </div>
                                                </div>
                                                @error('new_password')
                                                    <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="confirm_password">Confirm New Password</label>
                                                <div class="row">
                                                    <div class="col-11">
                                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
                                                    </div>
                                                    <div class="col-1 p-0" style="padding-top: 7px !important">
                                                        <i class="fa-regular fa-eye fa-xl" id="eye-confirm-password"></i>
                                                    </div>
                                                </div>
                                                @error('confirm_password')
                                                    <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
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
<script>
    const passwordInput = document.getElementById('old_password');
    const eyeIcon = document.getElementById('eye-old-password');

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
    
    const passwordInput2 = document.getElementById('new_password');
    const eyeIcon2 = document.getElementById('eye-new-password');

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
    
    const passwordInput3 = document.getElementById('confirm_password');
    const eyeIcon3 = document.getElementById('eye-confirm-password');

    eyeIcon3.addEventListener('click', () => {
        const passwordInputType3 = passwordInput3.getAttribute('type');

        if (passwordInputType3 === 'password') {
            passwordInput3.setAttribute('type', 'text');
            eyeIcon3.classList.remove('fa-eye');
            eyeIcon3.classList.add('fa-eye-slash');
        } else {
            passwordInput3.setAttribute('type', 'password');
            eyeIcon3.classList.remove('fa-eye-slash');
            eyeIcon3.classList.add('fa-eye');
        }

        eyeIcon3.style.right = `${passwordInput3.offsetWidth - 20}px`;
    });
</script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@endsection