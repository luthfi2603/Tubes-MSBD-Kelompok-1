@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><a href="{{ route('search') }}">Hasil Pencarian</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-9">
            {{-- <div class="text-muted info">
                <p>Sekarang menampilkan 1 sampai 10 dari 100 data</p>
            </div> --}}
            <div class="row grid">
                <div class="col-lg-4 mb-5">
                    <div class="cardfilter" style="border: 2px solid rgba(0, 0, 0, 0.187);">
                        <div class="card-body">
                            <form action="{{ request()->is('adv-search-page') ? route('advanced.search') : route('search') }}" method="get" id="filter">
                                @if(request()->is('search-page'))
                                    <input type="hidden" name="search" value="{{ $search }}">
                                @elseif(request()->is('adv-search-page'))
                                    <input type="hidden" name="search1" value="{{ request()->is('adv-search-page') ? $search1 : '' }}">
                                    <input type="hidden" name="search2" value="{{ request()->is('adv-search-page') ? $search2 : '' }}">
                                    <input type="hidden" name="search3" value="{{ request()->is('adv-search-page') ? $search3 : '' }}">
                                    <input type="hidden" name="select1" value="{{ request()->is('adv-search-page') ? $select1 : '' }}">
                                    <input type="hidden" name="select2" value="{{ request()->is('adv-search-page') ? $select2 : '' }}">
                                    <input type="hidden" name="select3" value="{{ request()->is('adv-search-page') ? $select3 : '' }}">
                                    <input type="hidden" name="query1" value="{{ request()->is('adv-search-page') ? $query1 : '' }}">
                                    <input type="hidden" name="query2" value="{{ request()->is('adv-search-page') ? $query2 : '' }}">
                                @endif
                                @php
                                    $jenis_tulisan = $jenis_tulisan ?? [];
                                    $program_studi = $program_studi ?? [];
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
                                    <label class="text-dec mb-1" style="font-weight: 600;">Program Studi</label>
                                    @foreach ($prodis as $prodi)
                                    <div class="form-check">
                                        <input class="form-check-input" name="prodi[]" type="checkbox" id="{{ $prodi->jenjang }}_{{ $prodi->nama_prodi }}" value="{{ $prodi->kode_prodi }}" {{ in_array($prodi->kode_prodi, $program_studi) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $prodi->jenjang }}_{{ $prodi->nama_prodi }}">{{ $prodi->jenjang }} {{ $prodi->nama_prodi }}</label>
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
                <div class="col-lg-8">
                    <!-- ini untuk koleksi terbaru pake card -->
                    <div class="mb-5">
                        @if($results->isEmpty())
                        <div style="text-align: center" class="mt-4">
                            <h3>Hasil tidak ditemukan</h3>
                        </div>
                        @else
                        @foreach ($results as $result)
                        <div class="card @if($loop->iteration == 1) mt-0 @else mt-3 @endif" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 my-3 d-flex">
                                    <img src="{{ asset('assets/img/usu.png') }}" class="m-auto" width="70%">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title textit"><a href="{{ route('detail.karya.tulis', $result->id) }}">{{ $result->judul }}</a></h5>
                                        <p class="text-muted">
                                            <small class="text-body-secondary">
                                                @php
                                                $penulis = "";
                                                $penulisTertentu = $penuliss->where('id', $result->id);

                                                foreach ($penulisTertentu as $key) {
                                                $penulis .= '<a
                                                    href="' . route('author', ['author' => $key->kontributor]) . '">' .
                                                    $key->kontributor . '</a>, ';
                                                }

                                                $penulis = rtrim($penulis, ', ');
                                                @endphp
                                                {!! $penulis !!}
                                                ({{ $result->tahun }})
                                            </small>
                                        </p>
                                        <div style="height: 100px;overflow: hidden;">
                                            <p class="card-text text">
                                                {{ $result->abstrak }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- Pagination -->
                        {{-- <nav aria-label="Page navigation example" class="pt-3">
                            {{ $results->links() }}
                        </nav> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-5">
            <!-- Jenis Koleksi -->
            <div class="mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-book-bookmark"></i></span> Jenis Koleksi</h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($jenisTulisans as $jenisTulisan)
                <li class="list-group-item"><a href="{{ route('koleksi', $jenisTulisan->jenis_tulisan) }}"><span><i
                                class="fa-solid fa-angle-right"></i></span>{{ $jenisTulisan->jenis_tulisan }}</a></li>
                @endforeach
            </ul>
            <!-- Prodi -->
            <div class="mt-3 mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-building-columns"></i></span> Prodi</h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($prodis as $prodi)
                <li class="list-group-item">
                    <a href="{{ route('prodi', $prodi->kode_prodi) }}">
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        {{ $prodi->jenjang }}&nbsp;{{ $prodi->nama_prodi }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection