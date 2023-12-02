@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i> 
            <a href="#">Hasil Pencarian</a><i class="fa-solid fa-angle-right ms-2"></i>
            <span>Detail</span>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-3 mb-5">
            <div class="card-detail">
                <div class="card-body">
                    <img src="{{ asset('assets/img/fasilkom.jpg') }}" class="img-fluid rounded-start" alt="..."
                        style="object-fit: cover; width: 250px; height: 200px;">
                    <div class="mt-3">
                        @if(!($penulis->isEmpty()))
                            <h6 class="textit mb-0" style="font-weight: 600;">Author : </h6>
                            @foreach ($penulis as $item)
                                <a href="{{ route('author', $item->kontributor) }}">
                                    <h6 class="text m-0" style="font-weight: 500;">{{ $item->kontributor }}</h6>
                                </a>
                            @endforeach
                        @endif
                        @if(!($kontributor->isEmpty()))
                            <h6 class="textit mb-0 mt-3" style="font-weight: 600;">Kontributor : </h6>
                            @foreach ($kontributor as $item)
                                <a href="{{ route('author', $item->kontributor) }}">
                                    <h6 class="text m-0" style="font-weight: 500;">{{ $item->kontributor }}</h6>
                                </a>
                            @endforeach
                        @endif
                        @if(!($pembimbing->isEmpty()))
                            <h6 class="textit mb-0 mt-3" style="font-weight: 600;">Pembimbing : </h6>
                            @foreach ($pembimbing as $item)
                                <a href="{{ route('author', $item->kontributor) }}">
                                    <h6 class="text m-0" style="font-weight: 500;">{{ $item->kontributor }}</h6>
                                </a>
                            @endforeach
                        @endif
                        <h6 class="textit mb-0 mt-3" style="font-weight: 600;">Tahun : </h6>
                        <h6 class="text mb-3" style="font-weight: 500;">{{ $detail->tahun }}</h6>
                        <h6 class="textit mb-0" style="font-weight: 600;">File Digital : </h6>
                        <!-- (dikliklangsungkedownload) -->
                        @if(auth()->user())
                            <a href="#">
                                <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i>{{ $detail->url_file }}</h6>
                            </a>
                        @else
                            <span style="cursor: pointer" id="belum-login">
                                <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i>{{ $detail->url_file }}</h6>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mb-5">
            <div class="col-lg-12">
                <div class="d flex mb-5">
                    <h6 class="textit" style="font-weight: 600;">{{ $detail->jenis }}</h6>
                    <hr class="mt-0">
                    <h3 class="textit mb-3" style="font-weight: 600;">{{ $detail->judul }}</h3>

                    <div class="eye-bar" style="cursor: text">
                        <i class="fa-solid fa-eye eye-icon"></i>
                        <span class="eye-text">{{ number_format($detail->view, 0, '.', '.') }}</span>
                    </div>

                    <!-- Button Like -->
                    <div class="heart-btn">
                        <button class="btn btn-light like-button" onclick="toggleLike()">
                            <i class="fa-solid fa-heart heart-icon"></i>
                            <span class="like-text">Tambahkan ke Favorit</span>
                            <!-- masuk ke favorite -->
                        </button>
                    </div>
                    <h6 class="textit" style="font-weight: 600;">Abstrak</h6>
                    <hr class="mt-0">
                    <p class="text mb-4">
                        {{ $detail->abstrak }}
                    </p>
                    <h6 class="textit mb-4" style="font-weight: 600;">Kata Kunci : 
                        <i>{{ $kataKunci }}</i>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('belum-login').addEventListener('click', () => {
        let timerInterval;
        timerInterval = setInterval(() => {
            document.location.href = '/login';
        }, 2000);
        Swal.fire({
            icon: "info",
            title: "Anda belum login, silahkan login terlebih dahulu",
            showConfirmButton: false,
            timer: 2000,
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
    });
</script>
@endsection