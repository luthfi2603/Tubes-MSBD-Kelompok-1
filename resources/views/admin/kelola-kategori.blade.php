@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-list"></i> Kelola Kategori</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('input.kategori') }}">Add +</a>
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
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Tanggal Perubahan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Disertasi</td>
                    <td>01-01-2023,20:00</td>
                    <td>.....</td>
                    <td>
                        <a href="{{ route('edit.kategori') }}" id="editkategori"><i
                                class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekategori"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Tesis</td>
                    <td>01-01-2023,20:00</td>
                    <td>.....</td>
                    <td>
                        <a href="{{ route('edit.kategori') }}" id="editkategori"><i
                                class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekategori"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Skripsi</td>
                    <td>01-01-2023,20:00</td>
                    <td>.....</td>
                    <td>
                        <a href="{{ route('edit.kategori') }}" id="editkategori"><i
                                class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekategori"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Karya Tulis Ilmiah</td>
                    <td>01-01-2023,20:00</td>
                    <td>.....</td>
                    <td>
                        <a href="{{ route('edit.kategori') }}" id="editkategori"><i
                                class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekategori"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Jurnal</td>
                    <td>01-01-2023,20:00</td>
                    <td>.....</td>
                    <td>
                        <a href="{{ route('edit.kategori') }}" id="editkategori"><i
                                class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekategori"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>

            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection