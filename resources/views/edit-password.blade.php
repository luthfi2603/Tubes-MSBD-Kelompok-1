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
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="profile.html">General</a>
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="editpassword.html">Change password</a>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-change-password">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Old Password</label>
                                            <input type="password" class="form-control" value="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" value="">
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