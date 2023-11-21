@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 d-flex align-items-center homepage">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-circle-user"></i> Selamat Datang Admin,</h5>

        <div class="col-lg-6">
            <!-- Konten di sini -->
            <a href="../admin/halamankelolakaryatulis.html">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Karya Tulis
                                </h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/karyatulis.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 ">
            <!-- Konten di sini -->
            <a href="../admin/halamankelolakategori.html">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Kategori
                                </h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kategori.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection