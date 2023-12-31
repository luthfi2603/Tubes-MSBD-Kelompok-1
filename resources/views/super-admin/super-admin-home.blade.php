@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 d-flex align-items-center">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-shield-halved"></i> Selamat Datang SuperAdmin {{ auth()->user()->username }}</h5>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('karya.tulis.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Karya Tulis</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/karyatulis.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3 ">
            <a href="{{ route('jenis.tulisan.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Jenis Tulisan</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kategori.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3">
            <a href="{{ route('pegawai.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Pegawai</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kelolapegawai.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3">
            <a href="{{ route('user.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola User</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kelolauser.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3">
            <a href="{{ route('mahasiswa.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Mahasiswa</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kelolamahasiswa.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3">
            <a href="{{ route('dosen.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Dosen</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/keloladosen.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-6 mb-3">
            <a href="{{ route('bidang.ilmu.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Bidang ilmu</h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <img src="../assets/img/kelolabidangilmu.png" class="img-fluid rounded-start" alt="...">
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('kata.kunci.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Kata Kunci</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../assets/img/kelolakeyword.png" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('ebook.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola E-Book</h5>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex" style="height: 172.89px">
                            <img src="../assets/img/kelolaebook.png" class="img-fluid rounded-start m-auto" alt="...">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('log') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Log</h5>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex" style="height: 172.89px">
                            <img src="../assets/img/listlog.png" class="img-fluid rounded-start m-auto" alt="...">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mb-3">
            <a href="{{ route('status.kelola') }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="card-body">
                                <h5 class="card-title karyatul textit" style="font-weight: 600;">Kelola Status</h5>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex" style="height: 172.89px">
                            <img src="../assets/img/kelolastatus.png" class="img-fluid rounded-start m-auto" alt="...">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection