@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>Home</h6>
        <hr class="mt-0">
    </div>
    <div class="row">

        <div class="col-lg-9">
            <!-- ini untuk info -->
            <div class="col-lg-10">
                <div class="d flex mb-5">
                    <h6 class="sidebar-col"><span><i class="fa-solid fa-circle-info"></i></span> Info</h6>
                    <hr class="garis">
                    <p class="text mt-2">Repositori Fasilkom-TI adalah koleksi digital dari karya akademik seperti tugas akhir, tesis, disertasi, dan sebagainya.</p>
                </div>
                <!-- ini untuk koleksi terbaru pake card -->
                <div class="d flex mb-5">
                    <h6 class="sidebar-col"><span><i class="fa-solid fa-star"></i></span> Koleksi Terbaru</h6>
                    <hr class="garis">

                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.search') }}">Pengaruh Sayur Kangkung Terhadap Senyum Kambing</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan (2023)</small></p>
                                    <p class="card-text text">
                                        Sayur kangkung adalah makanan kegemaran kambing yang
                                        dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal ini
                                        didasarkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.search') }}">Pengaruh Sayur Kangkung Terhadap Senyum Kambing</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan (2023)</small></p>
                                    <p class="card-text text">
                                        Sayur kangkung adalah makanan kegemaran kambing yang
                                        dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal ini
                                        didasarkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.search') }}">Pengaruh Sayur Kangkung Terhadap Senyum Kambing</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan (2023)</small></p>
                                    <p class="card-text text">
                                        Sayur kangkung adalah makanan kegemaran kambing yang
                                        dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal ini
                                        didasarkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.search') }}">Pengaruh Sayur Kangkung Terhadap Senyum Kambing</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan (2023)</small></p>
                                    <p class="card-text text">
                                        Sayur kangkung adalah makanan kegemaran kambing yang
                                        dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal ini
                                        didasarkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.search') }}">Pengaruh Sayur Kangkung Terhadap Senyum Kambing</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan (2023)</small></p>
                                    <p class="card-text text">
                                        Sayur kangkung adalah makanan kegemaran kambing yang
                                        dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal ini
                                        didasarkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-3">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>

        <div class="col-lg-3 mb-5">
            <!-- Jenis Koleksi -->
            <div class="d flex mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-book-bookmark"></i></span> Jenis Koleksi</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ route('single.koleksi') }}"><span><i class="fa-solid fa-angle-right"></i></span> Tesis</a></li>
                <li class="list-group-item"><a href="{{ route('single.koleksi') }}"><span><i class="fa-solid fa-angle-right"></i></span> Disertasi</a></li>
                <li class="list-group-item"><a href="{{ route('single.koleksi') }}"><span><i class="fa-solid fa-angle-right"></i></span> Skripsi</a></li>
            </ul>

            <!-- Prodi -->
            <div class="d flex mt-3 mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-building-columns"></i></span> Prodi</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i class="fa-solid fa-angle-right"></i></span> S3 Ilmu Komputer</a></li>
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i class="fa-solid fa-angle-right"></i></span> S2 Sains Data dan Kecerdasan Buatan</a></li>
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i class="fa-solid fa-angle-right"></i></span> S2 Teknik Informatika</a></li>
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i class="fa-solid fa-angle-right"></i></span> S1 Teknologi Informasi</a></li>
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i class="fa-solid fa-angle-right"></i></span> S1 Ilmu Komputer</a></li>
            </ul>
            <!-- E-Book -->
            <div class="d flex mt-3 mb-2">
                <h6 class="sidebar-col"><a class="ebook" href="{{ route('single.ebook') }}"><span><i class="fa-solid fa-book-open-reader"></i> E-Book</span></a></h6>
            </div>
        </div>

    </div>
</div>
@endsection