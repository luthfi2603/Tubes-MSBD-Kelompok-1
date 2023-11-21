@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Edit Kategori</h5>

        <div class="col-lg-12">
            <div class="inputan-form" style="width: 90%;">

                <div class="mb-3">
                    <label for="edit-kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control custom-form" id="edit-kategori" placeholder="">
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