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
            <div class="mb-5">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-heart"></i></span>Favorite Saya</h6>
                <hr class="garis mb-3" style="width: 20%;">
                @if($karyas->isEmpty())
                    <h3>Favorite anda masih kosong</h3>
                @else
                    @foreach ($karyas as $karya)
                        <div class="card mt-3" style="max-width: 100%;">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 my-3">
                                    <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover; width: 250px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        @php
                                            $waktuTangkap = $waktu->where('karya_id', $karya->id)->first()->waktu;
                                            $konversiWaktu = strtotime($waktuTangkap);
                                            $namaHariMap = [
                                                'Monday'    => 'Senin',
                                                'Tuesday'   => 'Selasa',
                                                'Wednesday' => 'Rabu',
                                                'Thursday'  => 'Kamis',
                                                'Friday'    => 'Jumat',
                                                'Saturday'  => 'Sabtu',
                                                'Sunday'    => 'Minggu',
                                            ];

                                            // Mengambil nama hari Inggris dari tanggal yang dihasilkan
                                            $namaHariInggris = date('l', $konversiWaktu);

                                            // Mengganti nama hari Inggris dengan nama hari Indonesia
                                            $namaHariIndonesia = $namaHariMap[$namaHariInggris];

                                            // Format tanggal dan waktu dengan nama hari dalam bahasa Indonesia
                                            $formattedDateTime = date('d F Y - H:i', $konversiWaktu);
                                            $formattedDateTime = $namaHariIndonesia . ', ' . $formattedDateTime;
                                        @endphp
                                        <span class="text-muted" style="font-size: 13px">Ditambahkan pada : {{ $formattedDateTime }}</span>
                                        <h5 class="card-title textit mt-2"><a href="{{ route('detail.karya.tulis', $karya->id) }}">{{ $karya->judul }}</a></h5>
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
                @endif
                <!-- Pagination -->
                <nav aria-label="Page navigation example" class="pt-3">
                    {{ $karyas->links() }}
                </nav>
            </div>
        </div>
        <!-- <div class="col-lg-3 mb-5"> -->
            <!-- Jenis Koleksi -->
            <!-- <div class="mb-2">
                <h6 class="sidebar-col"><span><i class="fa-solid fa-book-bookmark"></i></span> Jenis Koleksi</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Tesis</a></li>
                <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Disertasi</a></li>
                <li class="list-group-item"><a href=""><span><i class="fa-solid fa-angle-right"></i></span> Skripsi</a></li>
            </ul> -->

            <!-- Prodi -->
            <!-- <div class="mt-3 mb-2">
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