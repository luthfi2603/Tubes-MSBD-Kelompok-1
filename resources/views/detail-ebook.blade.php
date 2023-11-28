@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home </a><i class="fa-solid fa-angle-right"></i><a href="{{ route('single.ebook') }}"> Hasil Pencarian </a>
            <i class="fa-solid fa-angle-right"></i><a href="#"> Detail E-Book</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <h6 class="textit" style="font-weight: 600;">E-Book</h6>
                    <hr class="mt-0" style="width: 30%">
                    <h3 class="textit mb-3" style="font-weight: 600;">Pengaruh Sayur Kangkung terhadap Senyum Kambing
                        Harum</h3>

            <div class="col-lg-3">
                <div class="card-detail">
                    <div class="card-body">
                        <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                            style="object-fit: cover; width: 250px; height: 200px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="d flex mb-5">
                    
                    
                    <div class="eye-bar">
                        <i class="fa-solid fa-eye eye-icon"></i>
                        <span class="eye-text">1200</span>
                    </div>

                    <!-- Button Like -->
                    <div class="heart-btn">
                        <button class="btn btn-light like-button" onclick="toggleLike()">
                            <i class="fa-solid fa-heart heart-icon"></i>
                            <span class="like-text">Tambahkan ke Favorit</span>
                            <!-- masuk ke favorite -->
                        </button>
                    </div>
                   
                    <div class="mt-3">
                        <h6 class="textit mb-3" style="font-weight: 600;">Author : <span><a href=""> Ivan Mulatua Tambunan </a></span></h6>
                        
                        <h6 class="textit mb-3" style="font-weight: 600;">Tahun Terbit : <span><a href=""> 2023 </a></span></h6>
                                            
                        <h6 class="textit" style="font-weight: 600;">File Digital : </h6>
                        <!-- (dikliklangsungkedownload) -->
                        <a href="#">
                            <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i>
                                Ivan-Kambing.pdf</h6>
                        </a>
                    </div>
                    
                </div>
            </div>
            
    
    </div>
</div>
@endsection