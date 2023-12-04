@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user-tie"></i> Edit Dosen</h5>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="nidn-dosen" class="form-label">NIDN</label>
                    <input type="text" class="form-control custom-form" id="nidn-dosen"
                        placeholder="">
                </div>

                <div class="mb-3">
                    <label for="nip-dosen" class="form-label">NIP</label>
                    <input type="text" class="form-control custom-form" id="nip-dosen"
                        placeholder="">
                </div>

                <div class="mb-3">
                    <label for="nama-dosen" class="form-label">Nama dosen</label>
                    <input type="text" class="form-control custom-form" id="nama-dosen"
                        placeholder="">
                </div>

                <div class="mb-3">
                    <label for="kode-dosen" class="form-label">Kode dosen</label>
                    <input type="text" class="form-control custom-form" id="kode-dosen"
                        placeholder="">
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="inputan-form">

                <div class="mb-3">
                    <label for="jenis-kelamin-dosen" class="form-label">Jenis Kelamin</label>
                    <select class="form-select custom-form" aria-label="Default select example">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto-dosen" class="form-label">Upload Foto</label>
                    <input class="form-control" type="file" id="foto-dosen">
                </div>

                <div class="mb-3">
                    <label for="program-studi-dosen" class="form-label">Program Studi</label>
                    <select class="form-select custom-form" aria-label="Default select example"
                        id="program-studi-dosen">
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