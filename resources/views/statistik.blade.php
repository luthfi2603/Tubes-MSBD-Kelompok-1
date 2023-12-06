@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home </a><i class="fa-solid fa-angle-right"></i><span>Statistik</span>
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
                <button class="btn dropdown-toggle" type="button" id="select-btn" data-bs-toggle="dropdown" aria-expanded="false"> Semua Koleksi</button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Karya Tulis Ilmiah">Karya Tulis Ilmiah</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Jurnal">Jurnal</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Skripsi">Skripsi</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Tesis">Tesis</a></li>
                    <li><a class="dropdown-item" href="singlekoleksi.html" data-value="Disertasi">Disertasi</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-2 prodi">
            <div class="dropdown" id="select-prodi">
                <button class="btn dropdown-toggle" type="button" id="select-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    Semua Prodi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S1 Ilmu Komputer">S1 Ilmu Komputer</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S1 Teknologi Informasi">S1 Teknologi Informasi</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S2 Teknik Informatika">S2 Teknik Informatika</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S2 Sains Data dan Kecerdasan Buatan">S2 Sains Data dan Kecerdasan Buatan</a></li>
                    <li><a class="dropdown-item" href="singleprodi.html" data-value="S3 Ilmu Komputer">S3 Ilmu Komputer</a></li>
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
                                            <h5 class="bold"><a href="#">{{ $jumlah + $jumlahEbook }}</a> Items</h5>
                                        </td>
                                    </tr>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>
                                                <h4><i class="fa-solid fa-square-poll-horizontal"></i></h4>
                                            </td>
                                            <td>
                                                <h5 class="bold"><a href="{{ route('koleksi', $data->jenis_tulisan) }}">{{ $data->jumlah_karya }} {{ $data->jenis_tulisan }}</a></h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <h4><i class="fa-solid fa-book-open"></i></h4>
                                        </td>
                                        <td>
                                            <h5 class="bold"><a href="{{ route('ebook') }}">{{ $jumlahEbook }} E-book</a></h5>
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
            <div style="border: 1px solid #006633" class="w-100 rounded">
                <table class="w-100 rounded">
                    <thead style="background-color: #01411b; color: #f5f5f5">
                        <tr>
                            <th height="32px" colspan="3" class="text-center" style="border-radius: 2px">Items yang paling banyak disukai</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $t = request('page');
                        @endphp
                        @if(empty($t))
                            @php $i = 1; @endphp
                        @else
                            @php $i = ($t * 5) - 4; @endphp
                        @endif
                        @foreach($mostLikes as $mostLike)
                            <tr class="align-top">
                                <td width="40px" class="pt-3">
                                    <h6 class="bold m-0">{{ $i }}</h6>
                                </td>
                                <td width="700px" class="text-start pt-3">
                                    <h6 class="bold m-0"><a href="#">{{ $mostLike->judul }}</a></h6>
                                </td>
                                <td class="pt-3">
                                    <h6 class="bold m-0">{{ $mostLike->jumlah_like }}</h6>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="pt-3 ps-4">
                    {{ $mostLikes->links() }}
                </nav>
            </div>
            {{-- <div class="justify-content-center flex-grow-1">
                <div class="card cardku gridcol " style="border-color: #006633; position: relative;">
                    <div class="card-body pb-1">
                        <div class="poin">
                            <h6 class="head">Items yang paling banyak disukai</h6>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table table-borderless align-items-center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="bold">1</h6>
                                        </td>
                                        <td>
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Tugas Besar Terhadap Kesehatan Mental Mahasiswa Teknologi Informasi Kom C</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="pt-3">
                                {{ $karyas->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-3 mb-4 d-flex">
            <div style="border: 1px solid #006633" class="w-100 rounded">
                <table class="w-100 rounded">
                    <thead style="background-color: #01411b; color: #f5f5f5">
                        <tr>
                            <th height="32px" colspan="3" class="text-center" style="border-radius: 2px">Top Authors</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $t = request('page');
                        @endphp
                        @if(empty($t))
                            @php $i = 1; @endphp
                        @else
                            @php $i = ($t * 5) - 4; @endphp
                        @endif
                        @foreach($topAuthors as $topAuthor)
                            <tr class="align-top">
                                <td width="40px" class="pt-3">
                                    <h6 class="bold m-0">{{ $i }}</h6>
                                </td>
                                <td width="160px" class="text-start pt-3">
                                    <h6 class="bold m-0"><a href="{{ route('author', $topAuthor->nama) }}">{{ $topAuthor->nama }}</a></h6>
                                </td>
                                <td class="pt-3">
                                    <h6 class="bold m-0">{{ $topAuthor->jumlah_like }}</h6>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="pt-3 ps-4">
                    {{ $topAuthors->links() }}
                </nav>
            </div>
            {{-- <div class="justify-content-center flex-grow-1">
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
                                            <h6 class="bold"><a href="{{ route('author', 1) }}">Ruth Canti</a></h6>
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
                                            <h6 class="bold"><a href="{{ route('author', 1) }}">Andie Pakpahan</a></h6>
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
                                            <h6 class="bold"><a href="{{ route('author', 1) }}">Luthfi Jabrah</a></h6>
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
                                            <h6 class="bold"><a href="{{ route('author', 1) }}">Nancy Amanda</a></h6>
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
                                            <h6 class="bold"><a href="{{ route('author', 1) }}">Ivan Verquez</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-9 mb-4 d-flex">
            <div style="border: 1px solid #006633" class="w-100 rounded">
                <table class="w-100 rounded">
                    <thead style="background-color: #01411b; color: #f5f5f5">
                        <tr>
                            <th height="32px" colspan="3" class="text-center" style="border-radius: 2px">Items yang paling banyak dilihat</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $t = request('page');
                        @endphp
                        @if(empty($t))
                            @php $i = 1; @endphp
                        @else
                            @php $i = ($t * 5) - 4; @endphp
                        @endif
                        @foreach($mostLikes as $mostLike)
                            <tr class="align-top">
                                <td width="40px" class="pt-3">
                                    <h6 class="bold m-0">{{ $i }}</h6>
                                </td>
                                <td width="700px" class="text-start pt-3">
                                    <h6 class="bold m-0"><a href="detailsearch.html">{{ $mostLike->judul }}</a></h6>
                                </td>
                                <td class="pt-3">
                                    <h6 class="bold m-0">{{ $mostLike->jumlah_like }}</h6>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" class="pt-3 ps-4">
                    {{ $mostLikes->links() }}
                </nav>
            </div>
            {{-- <div class="justify-content-center flex-grow-1">
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
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Tugas Besar Terhadap Kesehatan Mental Mahasiswa Teknologi Informasi Kom C</a></h6>
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
                                            <h6 class="bold"><a href="detailsearch.html">Pengaruh Nama Rifqi sebagai Tolak Ukur Kejahatan Manusia</a></h6>
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
                                            <h6 class="bold"><a href="detailsearch.html">Dampak Bermain Mobel Lejeng di Usia Muda dan Drama Seorang Pemuda Yang Masuk ke Mobil Lejend</a></h6>
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
                                            <h6 class="bold"><a href="detailsearch.html">Mencari Makna Hidup Melalui Derita Cinta Tak Berbalas dan Kisah Manusia Yang Hidup Dalam Rumah Origami</a></h6>
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
                                            <h6 class="bold"><a href="detailsearch.html">Penggunaan Usus Manusia sebagai Tali Layang-Layang dan Pengaruh Kenapa Ikan Bisa Berenang</a></h6>
                                        </td>
                                        <td>
                                            <h6 class="bold">1118</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection