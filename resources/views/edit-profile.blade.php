@extends('layouts.main2')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="index.html">Home </a><i class="fa-solid fa-angle-right"></i><a href="profile.html"> Profile</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="{{ route('profile') }}">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="{{ route('password.edit') }}">Change password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="assets/img/usu.png" alt class="d-block ui-w-80">
                                <div class="media-body ml-4 mt-2">
                                    <label class="btn btn-outline-success">
                                        Upload new photo
                                        <input type="file" class="account-settings-fileinput">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                    <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control" value="adiebayu">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" value="abiemayubayue@gmail.com">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" value="Arjuna Laskar">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">NIM</label>
                                            <input type="text" class="form-control" value="22140201003">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Angkatan</label>
                                            <input type="text" class="form-control" value="2022">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <input type="text" class="form-control" value="Perempuan">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control" value="Aktif">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Prodi</label>
                                            <input type="text" class="form-control" value="S1 Teknologi Ilmu">
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
            <button type="button" id="submitbutton" class="btn btn-success">Save changes</button>&nbsp;
            <button type="button" id="cancelbutton" class="btn btn-default">Cancel</button>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
@endsection