@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>E-Book</span>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-9 order-2 order-lg-first">
            <!-- ini untuk koleksi terbaru pake card -->
            <div class="d flex mb-5">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-ebook-open-reader"></i></span> E-Book</h6>
                <!-- untuk iconnya bisa diambil di statistik ato mau beda pun bole ambil dari font awesome -->
                <hr class="garis" style="width: 70%;">
                @foreach($ebooks as $ebook)
                    <div class="card mt-3" style="max-width: 100%;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-4 my-3">
                                <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title textit"><a href="{{ route('detail.ebook', $ebook->id) }}">{{ $ebook->judul }}</a></h5>
                                    <p class="text-muted"><small class="text-body-secondary">{{ $ebook->penulis }} ({{ $ebook->tahun_terbit }})</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination -->
                <nav aria-label="Page navigation example" class="pt-4">
                    {{ $ebooks->links() }}
                </nav>
            </div>
        </div>
        <div class="col-lg-3 order-1 order-lg-last mb-5 mt-2">
            <div class="cardfilter" style="border: 2px solid rgba(0, 0, 0, 0.185);">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection