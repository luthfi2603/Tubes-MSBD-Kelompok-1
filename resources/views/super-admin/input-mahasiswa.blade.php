@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-regular fa-id-card"></i> Input Mahasiswa</h5>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="nim-mahasiswa" class="form-label">Nim</label>
                    <input type="text" class="form-control custom-form" id="nim-mahasiswa"
                        placeholder="Input NIM Mahasiswa">
                </div>


                <div class="mb-3">
                    <label for="nama-mahasiswa" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control custom-form" id="nama-mahasiswa"
                        placeholder="Input Nama Mahasiswa">
                </div>


                <div class="mb-3">
                    <label for="jenis-kelamin-mahasiswa" class="form-label">Jenis Kelamin</label>
                    <select class="form-select custom-form" aria-label="Default select example">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="foto-mahasiswa" class="form-label">Upload Foto</label>
                    <input class="form-control" type="file" id="foto-mahasiswa">
                </div>

                <div class="mb-3">
                    <label for="program-studi-mahasiswa" class="form-label">Program Studi</label>
                    <select class="form-select custom-form" aria-label="Default select example"
                        id="program-studi-mahasiswa">
                        <option selected>Pilih Program Studi</option>
                        <option value="S1-Ilmu-Komputer">S1 Ilmu Komputer</option>
                        <option value="S1-Teknologi-Informasi">S1 Teknologi Informasi</option>
                        <option value="S2-Teknik-Informatika">S2 Teknik Informatika</option>
                        <option value="S2-Sains-Data-dan-Kecerdasan-Buatan">S2 Sains Data dan Kecerdasan Buatan</option>
                        <option value="S3-Ilmu-Komputer">S3 Ilmu Komputer</option>
                    </select>
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