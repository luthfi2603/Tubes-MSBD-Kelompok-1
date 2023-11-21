@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Kelola Karya Tulis</h5>

        <div class="col-lg-9 justify-content-start">
            <button class="purple-button">Add +</button>
        </div>

        <div class="col-lg-3 justify-content-end">
            <div class="input-group input-search">
                <input type="text" class="form-control" placeholder="Search this blog">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-5 justify-content-center">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Judul</th>
                    <th scope="col">Abstrak</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pengaruh Sayur Kangkung Terhadap Andy dan Senyum Kambingnya Pak Amat</td>
                    <td>Lorem ipsum dolor sit amet consectetur. Convallis porta ornare condimentum fringilla massa
                        pharetra ullamcorper a faucibus. Pharetra tristique consectetur sagittis cursus id pulvinar
                        fusce.</td>
                    <td>
                        <!-- Disini untuk gambar yaaa -->
                    </td>
                    <td>Skripsi</td>
                    <td>2004</td>
                    <td>Andy Situmorang</td>
                    <td class="file">Senyumankambing.pdf</td>
                    <td>
                        <a href="halamaneditkaryatulis.html"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekaryatulis"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Pengaruh Sayur Kangkung Terhadap Andy dan Senyum Kambingnya Pak Amat</td>
                    <td>Lorem ipsum dolor sit amet consectetur. Convallis porta ornare condimentum fringilla massa
                        pharetra ullamcorper a faucibus. Pharetra tristique consectetur sagittis cursus id pulvinar
                        fusce.</td>
                    <td>
                        <!-- Disini untuk gambar yaaa -->
                    </td>
                    <td>Skripsi</td>
                    <td>2004</td>
                    <td>Andy Situmorang</td>
                    <td class="file">Senyumankambing.pdf</td>
                    <td>
                        <a href="halamaneditkaryatulis.html"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekaryatulis"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Pengaruh Sayur Kangkung Terhadap Andy dan Senyum Kambingnya Pak Amat</td>
                    <td>Lorem ipsum dolor sit amet consectetur. Convallis porta ornare condimentum fringilla massa
                        pharetra ullamcorper a faucibus. Pharetra tristique consectetur sagittis cursus id pulvinar
                        fusce.</td>
                    <td>
                        <!-- Disini untuk gambar yaaa -->
                    </td>
                    <td>Skripsi</td>
                    <td>2004</td>
                    <td>Andy Situmorang</td>
                    <td class="file">Senyumankambing.pdf</td>
                    <td>
                        <a href="halamankelolakaryatulis.html"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <button type="button" id="deletekaryatulis" class="icon-delete"><i
                                class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection