@extends('layouts.main-admin')

@section('container')
<div class="container mb-5">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user"></i> Edit Pegawai</h5>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="username-pegawai" class="form-label">Username</label>
                    <input type="text" class="form-control custom-form" id="username-pegawai" placeholder="">
                </div>


                <div class="mb-3">
                    <label for="email-pegawai" class="form-label">Email</label>
                    <input type="email" class="form-control custom-form" id="email-pegawai" placeholder="">
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="nama-pegawai" class="form-label">Nama</label>
                    <input type="text" class="form-control custom-form" id="nama-pegawai" placeholder="">
                </div>

                <!-- <div class="mb-3">
                    <label for="password-pegawai" class="form-label">Password</label>
                    <input type="password" class="form-control custom-form" id="password-pegawai" placeholder="">
                </div> -->

            </div>
        </div>

        <div class="inputan-form mb-5 mt-3">
            <button type="button" id="cancelbutton" class="btn btn-danger tombol">Cancel</button>
            <button type="button" id="submitbutton" class="btn btn-success tombol">Submit</button>
        </div>

    </div>
</div>
@endsection