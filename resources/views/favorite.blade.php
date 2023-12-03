@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>Favorite</span>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-9">
            <!-- ini untuk koleksi terbaru pake card -->
            <div class="d flex mb-5">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-heart"></i></span>Favorite Saya</h6>
                <hr class="garis mb-3" style="width: 20%;">
                @foreach ($karyas as $karya)
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4 my-3">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.karya.tulis', $karya->id) }}">{{ $karya->judul }}</a></h5>
                                    <p class="text-muted">
                                        <small class="text-body-secondary">
                                            @php
                                                $penulis = "";
                                                $penulisTertentu = $penuliss->where('id', $karya->id);

                                                foreach ($penulisTertentu as $key) {
                                                    $penulis .= '<a href="' . route('author', ['author' => $key->penulis]) . '">' . $key->penulis . '</a>, ';
                                                }

                                                $penulis = rtrim($penulis, ', ');
                                            @endphp
                                            {!! $penulis !!}
                                            ({{ $karya->tahun }})
                                        </small>
                                    </p>
                                    <div style="height: 100px;overflow: hidden;">
                                        <p class="card-text text">
                                            {{ $karya->abstrak }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination -->
                <nav aria-label="Page navigation example" class="pt-3">
                    {{ $karyas->links() }}
                </nav>
            </div>
        </div>
        <!-- <div class="col-lg-3 mb-5"> -->
        <!-- Jenis Koleksi -->
        <!-- <div class="d flex mb-2">
                            <h6 class="sidebar-col"><span><i class="fa-solid fa-book-bookmark"></i></span> Jenis Koleksi</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Tesis</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Disertasi</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Skripsi</a></li>
                            </ul> -->

        <!-- Prodi -->
        <!-- <div class="d flex mt-3 mb-2">
                            <h6 class="sidebar-col"><span><i class="fa-solid fa-building-columns"></i></span> Prodi</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> S3 Ilmu Komputer</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> S2 Sains Data dan Kecerdasan Buatan</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> S2 Teknik Informatika</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> S1 Teknologi Informasi</a></li>
                              <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> S1 Ilmu Komputer</a></li>
                            </ul>
                          </div> -->
        <!-- ini opsional, bagus ga kalo ditaro?? -->
    </div>
</div>
@endsection