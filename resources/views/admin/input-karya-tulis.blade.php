@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Input Karya Tulis</h5>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="namadepan-penulis" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control custom-form" id="namadepan-penulis"
                        placeholder="Input Nama Depan">
                </div>


                <div class="mb-3">
                    <label for="judul-karyatulis" class="form-label">Judul Karya Tulis</label>
                    <input type="text" class="form-control custom-form" id="judul-karyatulis"
                        placeholder="Input Judul Karya Tulis">
                </div>


                <div class="mb-3">
                    <label for="file-karyatulis" class="form-label">Upload File</label>
                    <input class="form-control" type="file" id="file-karyatulis">
                </div>


                <div class="mb-3">
                    <label for="foto-karyatulis" class="form-label">Upload Foto</label>
                    <input class="form-control" type="file" id="foto-karyatulis">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="namabelakang-penulis" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control custom-form" id="namabelakang-penulis"
                        placeholder="Input Nama Belakang">
                </div>

                <div class="mb-3">
                    <label for="tahun-karyatulis" class="form-label">Tahun</label>
                    <input type="year" class="form-control custom-form" id="tahun-karyatulis" placeholder="Input Tahun">
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select custom-form" aria-label="Default select example"
                        id="kategori-karyatulis">
                        <option selected>Pilih Kategori</option>
                        <option value="1">Disertasi</option>
                        <option value="2">Tesis</option>
                        <option value="3">Skripsi</option>
                        <option value="4">Karya Tulis Ilmiah</option>
                        <option value="5">Jurnal</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="inputan mb-4">
            <label for="abstrak" class="form-label">Abstrak</label>
            <div class="form-floating">
                <textarea class="form-control custom-form" placeholder="Input Abstrak" id="abstrak-karyatulis"
                    style="height: 100px"></textarea>
                <label for="abstrak-karyatulis">Input Abstrak</label>
            </div>
        </div>

        <div class="inputan-form mb-5 mt-3">
            <button type="button" id="cancelbutton" class="btn btn-danger tombol">Cancel</button>
            <button type="button" id="submitbutton" class="btn btn-success tombol">Submit</button>
        </div>

    </div>
</div>
@endsection