@extends('layouts.main-admin')

@section('container')
<div class="container mb-5">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-users"></i> Input User</h5>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control custom-form" id="nim" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="email-user" class="form-label">Email</label>
                    <input type="email" class="form-control custom-form" id="email-user" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="no-telf" class="form-label">No Telefon</label>
                    <input type="text" class="form-control custom-form" id="notelf-user" placeholder="">
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control custom-form" id="name-user" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control custom-form" id="prodi-user" placeholder="">
                </div>

            </div>
        </div>

        <div class="inputan-form mb-5 mt-3">
            <button type="button" id="cancelbutton" class="btn btn-danger tombol">Cancel</button>
            <button type="button" id="submitbutton" class="btn btn-success tombol">Submit</button>
        </div>

    </div>
</div>
@endsection