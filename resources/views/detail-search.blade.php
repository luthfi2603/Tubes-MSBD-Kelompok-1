@extends('layouts.main')

@section('container')
<div class="container">
    <div class="col-lg-12 pt-3">
        <h6>
            <a href="/">Home </a><i class="fa-solid fa-angle-right"></i><a href="#"> Hasil Pencarian </a>
            <i class="fa-solid fa-angle-right"></i><a href="#"> Detail</a>
        </h6>
        <hr class="mt-0">
    </div>
    <div class="row">
        <div class="col-lg-3 mb-5">
            <div class="card-detail">
                <div class="card-body">
                    <img src="assets/img/fasilkom.jpg" class="img-fluid rounded-start" alt="..."
                        style="object-fit: cover; width: 250px; height: 200px;">
                    <div class="mt-3">
                        <h6 class="textit mb-0" style="font-weight: 600;">Author : </h6>
                        <a href="singleauthor.html">
                            <h6 class="text mb-3" style="font-weight: 500;">Ivan Mulatua Tambunan</h6>
                        </a>
                        <h6 class="textit mb-0" style="font-weight: 600;">Tahun : </h6>
                        <h6 class="text mb-3" style="font-weight: 500;">2023</h6>
                        <h6 class="textit mb-0" style="font-weight: 600;">File Digital : </h6>
                        <!-- (dikliklangsungkedownload) -->
                        <a href="#">
                            <h6 class="text mb-3" style="font-weight: 500;"><i class="fa-regular fa-file-pdf"></i>
                                Ivan-Kambing.pdf</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mb-5">
            <div class="col-lg-12">
                <div class="d flex mb-5">
                    <h6 class="textit" style="font-weight: 600;">Skripsi</h6>
                    <hr class="mt-0">
                    <h3 class="textit mb-3" style="font-weight: 600;">Pengaruh Sayur Kangkung terhadap Senyum Kambing
                        Harum</h3>

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
                    <h6 class="textit" style="font-weight: 600;">Abstrak</h6>
                    <hr class="mt-0">
                    <p class="text mb-4">
                        Lorem ipsum dolor sit amet consectetur. Convallis porta ornare condimentum fringilla massa
                        pharetra ullamcorper a faucibus. Semper at phasellus amet adipiscing semper sagittis nulla et.
                        Pharetra tristique consectetur sagittis cursus id pulvinar fusce. Ut auctor tellus non ut nunc
                        amet adipiscing ornare. Pellentesque massa cras massa convallis at amet bibendum. Molestie eros
                        mollis felis elit urna dolor gravida pellentesque.
                        Cursus sed lobortis mattis platea egestas. Eget neque non non vitae purus integer quam iaculis
                        gravida. Quis vestibulum purus lacinia massa arcu iaculis urna. Nibh ante tristique in fusce
                        cursus faucibus blandit tempus platea. Eget enim porttitor congue a ligula porta. Elementum
                        proin in et risus nibh. Consectetur nam quis consectetur vitae. Cras diam vitae nascetur
                        consequat amet orci. Pretium quis fringilla viverra enim egestas quis duis felis viverra. Quis
                        id at tempus feugiat egestas quis a.
                    </p>
                    <h6 class="textit mb-4" style="font-weight: 600;">Kata Kunci : Kambing, Andy, Senyum</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection