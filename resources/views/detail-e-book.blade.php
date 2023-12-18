@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><a href="{{ route('ebook') }}">E-Book</a>
            <i class="fa-solid fa-angle-right ms-2"></i><a href="#">{{ $ebook->judul }}</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <h6 class="textit" style="font-weight: 600;">E-Book</h6>
        <hr class="mt-0" style="width: 30%">
        <h3 class="textit mb-3" style="font-weight: 600;">{{ $ebook->judul }}</h3>
        <div class="col-lg-3">
            <div class="card-detail">
                <div class="card-body d-flex">
                    <img src="{{ asset('assets/img/usu.png') }}" class="m-auto" width="70%">
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d flex mb-5">
                <div class="eye-bar" style="cursor: text">
                    <i class="fa-solid fa-eye eye-icon"></i>
                    <span class="eye-text">{{ $ebook->view }}</span>
                </div>
                <!-- Button Like -->
                @auth
                    {{-- udah dilike --}}
                    @if(!$isLiked)
                        <form action="{{ route('favorite-ebook') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="number" name="ebook_id" value="{{ $ebook->id }}" hidden>
                            <button class="btn btn-light like-button" type="submit">
                                <i class="fa-solid fa-heart-crack heart-icon"></i>
                                <span class="like-text">Hapus dari Favorite</span>
                            </button>
                        </form>
                    {{-- belum dilike --}}
                    @else
                        <form action="{{ route('favorite-ebook') }}" method="POST">
                            @csrf
                            <input type="number"  name="ebook_id" value="{{ $ebook->id }}" hidden>
                            <button class="btn btn-light like-button" type="submit">
                                <i class="fa-solid fa-heart heart-icon"></i>
                                <span class="like-text">Tambahkan ke Favorite</span>
                            </button>
                        </form>
                    @endif
                @else
                    <button id="tombol-like-belum-login" class="btn btn-light like-button" type="button">
                        <i class="fa-solid fa-heart heart-icon"></i>
                        <span class="like-text">Tambahkan ke Favorite</span>
                    </button>
                    <script>
                        document.getElementById('tombol-like-belum-login').addEventListener('click', () => {
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
                @endauth
                <div class="mt-3">
                    <h6 class="textit mb-3" style="font-weight: 600;">Author : <span>{{ $ebook->penulis }}</span></h6>
                    <h6 class="textit mb-3" style="font-weight: 600;">Tahun Terbit : <span>{{ $ebook->tahun_terbit }}</span></h6>
                    <h6 class="textit" style="font-weight: 600;">File Digital : </h6>
                    <!-- diklik langsung ke download -->
                    @auth
                        <a href="{{ asset('storage/' . $ebook->url_file) }}" target="_blank">
                            <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i> Tampilkan File</h6>
                        </a>
                    @else
                        <span style="cursor: pointer" id="belum-login">
                            <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i> Tampilkan File</h6>
                        </span>
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
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection