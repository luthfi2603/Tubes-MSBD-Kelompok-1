@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="index.html">Home </a><i class="fa-solid fa-angle-right"></i><a href="#">Statistik</a>
        </h6>
        <hr class="mt-0">
    </div>

    <div class="container py-2 mb-4 text-center" style="background-color: #01411b;">
        <div class="mt-2">
            <h6 class="bolds" style="color: #f5f5f5; font-size: 25px;">STATISTIK</h6>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-2 koleksi">
            <div class="dropdown" id="select-menu">
                <button class="btn dropdown-toggle" type="button" id="select-btn" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Semua Koleksi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Karya Tulis Ilmiah">Karya
                            Tulis Ilmiah</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Jurnal">Jurnal</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Skripsi">Skripsi</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Tesis">Tesis</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Disertasi">Disertasi</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-2 prodi">
            <div class="dropdown" id="select-prodi">
                <button class="btn dropdown-toggle" type="button" id="select-btn" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Semua Prodi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S1 Ilmu Komputer">S1 Ilmu
                            Komputer</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S1 Teknologi Informasi">S1
                            Teknologi Informasi</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S2 Teknik Informatika">S2
                            Teknik Informatika</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html"
                            data-value="S2 Sains Data dan Kecerdasan Buatan">S2 Sains Data dan Kecerdasan Buatan</a>
                    </li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S3 Ilmu Komputer">S3 Ilmu
                            Komputer</a></li>
                </ul>
            </div>
        </div>

    </div>


    <br>

    <div class="row">
        <div class="col-lg-3 mb-4 d-flex">
            <div class="justify-content-center flex-grow-1">

                <div class="card cardku gridcol" style="border-color: #006633; position: relative;">
                    <div class="card-body pb-1">
                        <div class="poin">
                            <h6 class="head">Data</h6>
                        </div>
                        <div class="table-responsive tables">
                            <table class="table table-borderless align-items-center">
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-scroll"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="#">1775</a> Items</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-square-poll-horizontal"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="#">10</a> Skripsi</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-square-poll-horizontal"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="#">9</a> Thesis</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-square-poll-horizontal"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="#">10</a> Disertasi</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-book-open"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="#">10</a> E-book</h5>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>

        <div class="col-lg-9 mb-4 d-flex">
            <div class="justify-content-center flex-grow-1">

                <div class="card cardku gridcol " style="border-color: #006633; position: relative;">
                    <div class="card-body pb-1">
                        <div class="poin">
                            <h6 class="head">Items yang paling banyak disukai</h6>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table table-borderless align-items-center">
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <h6 class="bold">1</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Tugas Besar
                                                    Terhadap Kesehatan Mental Mahasiswa Teknologi Informasi Kom
                                                    C</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">2</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Nama Rifqi sebagai
                                                    Tolak Ukur Kejahatan Manusia</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">3</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Dampak Bermain Mobel Lejeng
                                                    di Usia Muda</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">4</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Mencari Makna Hidup Melalui
                                                    Derita Cinta Tak Berbalas</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">5</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Penggunaan Usus Manusia
                                                    sebagai Tali Layang-Layang</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>



            </div>
        </div>

        <div class="col-lg-3 mb-4 d-flex">
            <div class="justify-content-center flex-grow-1">

                <div class="card cardku gridcol " style="border-color: #006633; position: relative;">
                    <div class="card-body pb-1">
                        <div class="poin">
                            <h6 class="head">Top Authors</h6>
                        </div>
                        <div class="table-responsive mt-4 tables">
                            <table class="table table-borderless align-items-center">
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <h6 class="bold">1</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="singleauthor.html">Ruth Canti</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">2</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="singleauthor.html">Andie Pakpahan</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">3</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="singleauthor.html">Luthfi Jabrah</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">4</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="singleauthor.html">Nancy Amanda</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">5</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="singleauthor.html">Ivan Verquez</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>



            </div>
        </div>

        <div class="col-lg-9 mb-4 d-flex">
            <div class="justify-content-center flex-grow-1">

                <div class="card cardku gridcol " style="border-color: #006633; position: relative;">
                    <div class="card-body pb-1">
                        <div class="poin">
                            <h6 class="head">Items yang paling banyak dilihat</h6>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table table-borderless align-items-center">
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <h6 class="bold">1</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Tugas Besar
                                                    Terhadap Kesehatan Mental Mahasiswa Teknologi Informasi Kom
                                                    C</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">2</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Nama Rifqi sebagai
                                                    Tolak Ukur Kejahatan Manusia</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">3</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Dampak Bermain Mobel Lejeng
                                                    di Usia Muda dan Drama Seorang Pemuda Yang Masuk ke Mobil
                                                    Lejend</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">4</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Mencari Makna Hidup Melalui
                                                    Derita Cinta Tak Berbalas dan Kisah Manusia Yang Hidup Dalam
                                                    Rumah Origami</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="bold">5</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Penggunaan Usus Manusia
                                                    sebagai Tali Layang-Layang dan Pengaruh Kenapa Ikan Bisa
                                                    Berenang</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="fa-solid fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>



            </div>
        </div>

    </div>
</div>
@endsection