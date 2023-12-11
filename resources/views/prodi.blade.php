@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6><a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>Prodi</span><i class="fa-solid fa-angle-right ms-2"></i><span>{{ $prodi }}</span></h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-9 order-2 order-lg-first">
            <!-- ini untuk koleksi terbaru pake card -->
            <div class="d flex mb-5">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-user-pen"></i></span>{{ $prodi }}</h6>
                <hr class="garis" style="width: 70%;">
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
                                                    $penulis .= '<a href="' . route('author', ['author' => $key->kontributor]) . '">' . $key->kontributor . '</a>, ';
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
        <div class="col-lg-3 order-1 order-lg-last mb-5">
            <div class="cardfilter" style="border: 2px solid rgba(0, 0, 0, 0.185);">
                <div class="card-body">
                    <form action="{{ route('prodi', $prodiParam )}}" method="get" id="filter">
                        @php
                            $jenis_tulisan = $jenis_tulisan ?? [];
                            $bidang_ilmu = $bidang_ilmu ?? [];
                        @endphp
                        <div class="row mb-2 d-flex align-items-center">
                            <div class="col-lg-2">
                                <label class="text-dec" style="font-weight: 600;">Sort</label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" name="sort" style="border-radius: 6px;" id="sort">
                                    <option value="DESC" style="font-weight: 500;" {{ $sort==='DESC' ? 'selected' : '' }}>Yang Terbaru</option>
                                    <option value="ASC" style="font-weight: 500;" {{ $sort==='ASC' ? 'selected' : '' }}>Yang Terlama</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dec mb-1" style="font-weight: 600;">Dari Tahun</label>
                                    <input type="number" name="tahunawal" min="0" class="form-control" id="tahun_awal" placeholder="Tahun" value="{{ $tahunawal }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dec mb-1" style="font-weight: 600;">Hingga</label>
                                    <input type="number" name="tahunakhir" min="0" class="form-control" id="tahun_akhir" placeholder="Tahun" value="{{ $tahunakhir }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-dec mb-1" style="font-weight: 600;">Jenis Koleksi</label>
                            @foreach ($jenisTulisans as $jenisTulisan)
                            <div class="form-check">
                                <input class="form-check-input" name="jenis_tulisan[]" type="checkbox" id="{{ $jenisTulisan->jenis_tulisan }}" value="{{ $jenisTulisan->jenis_tulisan }}" {{ in_array($jenisTulisan->jenis_tulisan, $jenis_tulisan) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $jenisTulisan->jenis_tulisan }}">{{ $jenisTulisan->jenis_tulisan }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group mb-1">
                            <label class="text-dec mb-1" style="font-weight: 600;">Bidang Ilmu</label>
                            @foreach ($bidIlmus as $bidIlmu)
                            <div class="form-check">
                                <input class="form-check-input" name="bidang_ilmu[]" type="checkbox" id="{{ $bidIlmu->jenis_bidang_ilmu }}" value="{{ $bidIlmu->jenis_bidang_ilmu }}" {{ in_array($bidIlmu->jenis_bidang_ilmu, $bidang_ilmu) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $bidIlmu->jenis_bidang_ilmu }}">{{ $bidIlmu->jenis_bidang_ilmu }}</label>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group mb-1 d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
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
            </div>
        </div>
    </div>
</div>
@endsection