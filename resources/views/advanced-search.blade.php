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
    <form action="{{ route('advanced.search') }}" method="get" id="filter">
        <div class="col-lg-12 pt-3">
            <h6>
                <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>Pencarian Lanjutan</span>
            </h6>
            <hr class="mt-0">
        </div>

        <div class="row mt-2 mb-4">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-3">
                <select name="select1" class="form-select custom-form" aria-label="">
                    <option value="judul">Judul</option>
                    <option value="kontributor">Penulis</option>
                    <option value="kata_kunci">Kata Kunci</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" name="search1" class="form-control custom-form" placeholder="Search"
                        aria-label="Search" aria-describedby="basic-addon2">
                </div>
            </div>
        </div>

        <div class="row mt-2 mb-4">
            <div class="col-lg-2">
                <select name="query1" class="form-select custom-form" aria-label="">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                    <option value="AND NOT">AND NOT</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select name="select2" class="form-select custom-form" aria-label="">
                    <option value="judul">Judul</option>
                    <option value="kontributor">Penulis</option>
                    <option value="kata_kunci">Kata Kunci</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" name="search2" class="form-control custom-form" placeholder="Search"
                        aria-label="Search" aria-describedby="basic-addon2">
                </div>
            </div>
        </div>

        <div class="row mt-2 mb-4">
            <div class="col-lg-2">
                <select name="query2" class="form-select custom-form" aria-label="">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                    <option value="AND NOT">AND NOT</option>
                </select>
            </div>
            <div class="col-lg-3">
                <select name="select3" class="form-select custom-form" aria-label="">
                    <option value="judul">Judul</option>
                    <option value="kontributor">Penulis</option>
                    <option value="kata_kunci">Kata Kunci</option>
                </select>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" name="search3" class="form-control custom-form" placeholder="Search"
                        aria-label="Search" aria-describedby="basic-addon2">
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-4 mb-4 align-items-center">
            <div class="col-lg-2 d-flex justify-content-center mt-3">
                <h6 class="textit">Tahun</h6>
            </div>
            <div class="col-lg-2">
                <input type="number" class="form-control custom-form" id="tahun_awal" name="tahunawal" min="1000"
                    placeholder="Tahun">
            </div>
            <div class="col-lg-2">
                <input type="number" class="form-control custom-form" id="tahun_akhir" name="tahunakhir" min="1000"
                    placeholder="Tahun">
            </div>
        </div>

        <hr>

        {{-- <div class="row mt-4 mb-2 align-items-center">
            <div class="col-lg-2 d-flex justify-content-end mx-3 mt-3">
                <h6 class="textit">Jenis Koleksi</h6>
            </div>
            <div class="col-lg-7">
                <select class="form-select custom-form" aria-label="">
                    @foreach ($jenisTulisans as $jenisTulisan)
                    <option value="{{$jenisTulisan->jenis_tulisan}}">{{$jenisTulisan->jenis_tulisan}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4 mb-5 align-items-center">
            <div class="col-lg-2 d-flex justify-content-end mx-3 mt-3">
                <h6 class="textit">Prodi</h6>
            </div>
            <div class="col-lg-7">
                <select class="form-select custom-form" aria-label="">
                    @foreach ($prodis as $prodi)
                    <option value="{{$prodi->kode_prodi}}">{{$prodi->jenjang}} {{$prodi->nama_prodi}}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        <div class="row mt-4 mb-5 align-items-center">
            <button type="submit" class="btn btn-success w-15 mx-auto" style="font-weight: 600;">Cari</button>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var form = document.getElementById("filter");
    
            form.addEventListener("submit", function (event) {
                var tahunAwalInput = document.getElementById("tahun_awal");
                var tahunAkhirInput = document.getElementById("tahun_akhir");
    
                var tahunAwal = parseInt(tahunAwalInput.value, 10);
                var tahunAkhir = parseInt(tahunAkhirInput.value, 10);
    
                if (tahunAwal >= tahunAkhir) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tahun Akhir harus lebih besar dari Tahun Awal',
                    });
    
                    tahunAwalInput.value = "";
                    tahunAkhirInput.value = "";
    
                    event.preventDefault();
                }
            });
        });
    </script>
</div>
@endsection