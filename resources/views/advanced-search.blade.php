@extends('layouts.main2')

@section('container')
<!-- Bagian Search -->
<div class="container-fluid py-5" style="background-image: url(assets/img/Gedung-A.png);">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <div class="cardbi p-4 mt-0">
                <h2 class="heading mt-3 text-center" style="font-weight: 600; color: #ffff;">REPOSITORI FASILKOM TI</h2>
                <div class="d-flex justify-content-center px-5">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="login.html">Home </a><i class="fa-solid fa-angle-right"></i><a href="#"> Hasil Pencarian</a>
        </h6>
        <hr class="mt-0">
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-3">
            <select class="form-select custom-form" aria-label="">
                <option value="1">Judul</option>
                <option value="2">Penulis</option>
                <option value="3">Kata Kunci</option>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control custom-form" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-lg-2">
            <select class="form-select custom-form" aria-label="">
                <option value="1">AND</option>
                <option value="2">OR</option>
                <option value="3">AND NOT</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select class="form-select custom-form" aria-label="">
                <option value="1">Judul</option>
                <option value="2">Penulis</option>
                <option value="3">Kata Kunci</option>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control custom-form" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-lg-2">
            <select class="form-select custom-form" aria-label="">
                <option value="1">AND</option>
                <option value="2">OR</option>
                <option value="3">AND NOT</option>
            </select>
        </div>
        <div class="col-lg-3">
            <select class="form-select custom-form" aria-label="">
                <option value="1">Judul</option>
                <option value="2">Penulis</option>
                <option value="3">Kata Kunci</option>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control custom-form" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <hr>

    <div class="row mt-4 mb-4 align-items-center">
        <div class="col-lg-2 d-flex justify-content-center mt-3">
            <h6 class="textit">Tahun</h6>
        </div>
        <div class="col-lg-2">
            <input type="text" class="form-control custom-form" id="tahunawal" name="tahunawal" value="2019"
                placeholder="Kosongkan">
        </div>
        <div class="col-lg-2">
            <input type="text" class="form-control custom-form" id="tahunakhir" name="tahunakhir" value="2023"
                placeholder="Kosongkan">
        </div>
    </div>

    <hr>

    <div class="row mt-4 mb-2 align-items-center">
        <div class="col-lg-2 d-flex justify-content-end mx-3 mt-3">
            <h6 class="textit">Jenis Koleksi</h6>
        </div>
        <div class="col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control custom-form" placeholder="" aria-label=""
                    aria-describedby="basic-addon2">
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-5 align-items-center">
        <div class="col-lg-2 d-flex justify-content-end mx-3 mt-3">
            <h6 class="textit">Prodi</h6>
        </div>
        <div class="col-lg-7">
            <div class="input-group">
                <input type="text" class="form-control custom-form" placeholder="" aria-label="" aria-describedby="basic-addon2">
            </div>
        </div>
    </div>
</div>
@endsection