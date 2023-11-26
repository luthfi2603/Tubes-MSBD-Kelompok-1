@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="index.html">Home </a><i class="fa-solid fa-angle-right"></i><a href="#"> Hasil Pencarian</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">

        <div class="col-lg-9">
            <div class="text-muted info">
                <p>Sekarang menampilkan 1 sampai 10 dari 100 data</p>
            </div>
            <div class="row grid">

                <div class="col-lg-4 mb-5">

                    <div class="cardfilter" style="border: 2px solid rgba(0, 0, 0, 0.187);">
                        <div class="card-body">
                            <div class="row mb-2 d-flex align-items-center">
                                <div class="col-lg-2">
                                    <label class="text-dec" style="font-weight: 600;">Sort</label>
                                </div>
                                <div class="col-lg-10">
                                    <select class="form-control" style="border-radius: 6px;" id="sort">
                                        <option value="" style="font-weight: 500;">Yang Terbaru</option>
                                        <option value="" style="font-weight: 500;">Yang Terlama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dec mb-1" style="font-weight: 600;">Dari Tahun</label>
                                        <input type="number" class="form-control" id="tahun_awal"
                                            placeholder="Tahun">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dec mb-1" style="font-weight: 600;">Hingga</label>
                                        <input type="number" class="form-control" id="tahun_akhir"
                                            placeholder="Tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-dec mb-1" style="font-weight: 600;">Jenis Koleksi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jenis_skripsi"
                                        value="skripsi">
                                    <label class="form-check-label" for="jenis_skripsi">Skripsi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jenis_tesis" value="tesis">
                                    <label class="form-check-label" for="jenis_tesis">Tesis</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jenis_disertasi"
                                        value="disertasi">
                                    <label class="form-check-label" for="jenis_disertasi">Disertasi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jenis_jurnal"
                                        value="jurnal">
                                    <label class="form-check-label" for="jenis_jurnal">Jurnal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="jenis_karya_tulis_ilmiah"
                                        value="karya_tulis_ilmiah">
                                    <label class="form-check-label" for="jenis_karya_tulis_ilmiah">Karya Tulis
                                        Ilmiah</label>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="text-dec mb-1" style="font-weight: 600;">Program Studi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prodi_ilmu_komputer"
                                        value="51">
                                    <label class="form-check-label" for="s1_prodi_ilmu_komputer"> S1 Ilmu
                                        Komputer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prodi_teknologi_informasi"
                                        value="52">
                                    <label class="form-check-label" for="s1_prodi_teknologi_informasi"> S1 Teknologi
                                        Informasi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prodi_ilmu_komputer"
                                        value="51">
                                    <label class="form-check-label" for="s2_prodi_ilmu_komputer"> S2 Sains Data dan
                                        Kecerdasan Buatan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prodi_teknologi_informasi"
                                        value="52">
                                    <label class="form-check-label" for="s2_prodi_teknologi_informasi"> S2 Teknik
                                        Informatika</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="prodi_ilmu_komputer"
                                        value="51">
                                    <label class="form-check-label" for="s3_prodi_ilmu_komputer"> S2 Ilmu
                                        Komputer</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- ini untuk koleksi terbaru pake card -->
                    <div class="d flex mb-5">
                        <div class="card mt-0" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                                        style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="detailsearch.html">Pengaruh Sayur
                                                Kangkung Terhadap Senyum Kambing</a></h5>
                                        <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan
                                                (2023)</small></p>
                                        <p class="card-text text">Sayur kangkung adalah makanan kegemaran kambing
                                            yang dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal
                                            ini didasarkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                                        style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="detailsearch.html">Pengaruh Sayur
                                                Kangkung Terhadap Senyum Kambing</a></h5>
                                        <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan
                                                (2023)</small></p>
                                        <p class="card-text text">Sayur kangkung adalah makanan kegemaran kambing
                                            yang dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal
                                            ini didasarkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                                        style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="detailsearch.html">Pengaruh Sayur
                                                Kangkung Terhadap Senyum Kambing</a></h5>
                                        <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan
                                                (2023)</small></p>
                                        <p class="card-text text">Sayur kangkung adalah makanan kegemaran kambing
                                            yang dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal
                                            ini didasarkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                                        style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="detailsearch.html">Pengaruh Sayur
                                                Kangkung Terhadap Senyum Kambing</a></h5>
                                        <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan
                                                (2023)</small></p>
                                        <p class="card-text text">Sayur kangkung adalah makanan kegemaran kambing
                                            yang dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal
                                            ini didasarkan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                                        style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="detailsearch.html">Pengaruh Sayur
                                                Kangkung Terhadap Senyum Kambing</a></h5>
                                        <p class="text-muted"><small class="text-body-secondary">Tambunan, Ivan
                                                (2023)</small></p>
                                        <p class="card-text text">Sayur kangkung adalah makanan kegemaran kambing
                                            yang dapat menimbulkan rasa kesenangan seperti munculnya senyuman. Hal
                                            ini didasarkan.</p>
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
        </div>

        <div class="col-lg-3 mb-5">
            <!-- Jenis Koleksi -->
            <div class="d flex mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-book-bookmark"></i></span> Jenis Koleksi</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="singlekoleksi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> Tesis</a></li>
                <li class="list-group-item"><a href="singlekoleksi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> Disertasi</a></li>
                <li class="list-group-item"><a href="singlekoleksi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> Skripsi</a></li>
            </ul>

            <!-- Prodi -->
            <div class="d flex mt-3 mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-building-columns"></i></span> Prodi</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="singleprodi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> S3 Ilmu Komputer</a></li>
                <li class="list-group-item"><a href="singleprodi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> S2 Sains Data dan Kecerdasan Buatan</a>
                </li>
                <li class="list-group-item"><a href="singleprodi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> S2 Teknik Informatika</a></li>
                <li class="list-group-item"><a href="singleprodi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> S1 Teknologi Informasi</a></li>
                <li class="list-group-item"><a href="singleprodi.html"><span><i
                                class="fa-solid fa-angle-right"></i></span> S1 Ilmu Komputer</a></li>
            </ul>
        </div>

    </div>
</div>
@endsection