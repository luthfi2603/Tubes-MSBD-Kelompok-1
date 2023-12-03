@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home </a><i class="fa-solid fa-angle-right"></i><a href="#"> Hasil Pencarian</a>
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
                                        <input type="number" class="form-control" id="tahun_awal" placeholder="Tahun">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dec mb-1" style="font-weight: 600;">Hingga</label>
                                        <input type="number" class="form-control" id="tahun_akhir" placeholder="Tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-dec mb-1" style="font-weight: 600;">Jenis Koleksi</label>
                                @foreach ($jenisTulisans as $jenisTulisan)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="{{ $jenisTulisan->jenis_tulisan }}"
                                        value="{{ $jenisTulisan->jenis_tulisan }}">
                                    <label class="form-check-label" for="{{ $jenisTulisan->jenis_tulisan }}">{{
                                        $jenisTulisan->jenis_tulisan }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-1">
                                <label class="text-dec mb-1" style="font-weight: 600;">Program Studi</label>
                                @foreach ($prodis as $prodi)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="{{ $prodi->jenjang }}_{{ $prodi->nama_prodi }}"
                                        value="{{ $prodi->jenjang }} {{ $prodi->nama_prodi }}">
                                    <label class="form-check-label"
                                        for="{{ $prodi->jenjang }}_{{ $prodi->nama_prodi }}">{{ $prodi->jenjang }} {{
                                        $prodi->nama_prodi }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-1">
                                <label class="text-dec mb-1" style="font-weight: 600;">Bidang Ilmu</label>
                                @foreach ($bidIlmus as $bidIlmu)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        id="{{ $bidIlmu->jenis_bidang_ilmu }}"
                                        value="{{ $bidIlmu->jenis_bidang_ilmu }}">
                                    <label class="form-check-label" for="{{ $bidIlmu->jenis_bidang_ilmu }}">{{
                                        $bidIlmu->jenis_bidang_ilmu }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- ini untuk koleksi terbaru pake card -->
                    <div class="d flex mb-5">
                        @foreach ($results as $result)
                        <div class="card mt-0" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start"
                                        alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a
                                                href="{{ route('detail.karya.tulis', $result->id) }}">{{ $result->judul
                                                }}</a>
                                        </h5>
                                        <p class="text-muted"><small class="text-body-secondary">
                                                @php
                                                $penulis = "";
                                                $penulisTertentu = $penuliss->where('id', $result->id);
                                                foreach ($penulisTertentu as $key) {
                                                $penulis .= $key->penulis . ', ';
                                                }
                                                $penulis = rtrim($penulis, ', ');
                                                @endphp
                                                {{ $penulis }}
                                                {{-- {{ $result->kontributor }} --}}
                                                ({{ $result->tahun }})</small></p>
                                        <p class="card-text text">{{ $result->abstrak }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            {{ $results->links() }}
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
                @foreach ($jenisTulisans as $jenisTulisan)
                <li class="list-group-item"><a href="{{ route('single.koleksi') }}"><span><i
                                class="fa-solid fa-angle-right"></i></span>{{ $jenisTulisan->jenis_tulisan }}</a></li>
                @endforeach
            </ul>

            <!-- Prodi -->
            <div class="d flex mt-3 mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-building-columns"></i></span> Prodi</h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($prodis as $prodi)
                <li class="list-group-item"><a href="{{ route('single.prodi') }}"><span><i
                                class="fa-solid fa-angle-right"></i></span>{{ $prodi->jenjang }}&nbsp;{{
                        $prodi->nama_prodi }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection