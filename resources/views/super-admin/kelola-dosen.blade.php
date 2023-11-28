@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user-tie"></i> Kelola Dosen</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('input.dosen') }}">Add +</a>
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
                    <th scope="col">No</th>
                    <th scope="col">NIDN</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kode Dosen</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2214020032</td>
                    <td>139391303109</td>
                    <td>Ady Rahmayadhie</td>
                    <td>ALW</td>
                    <td>Laki-Laki</td>
                    <td class="imagecel"><img src="../assets/img/keloladosen.png" alt=""></td>
                    <td>Teknologi Informasi</td>
                    <td>
                        <a href="{{ route('edit.dosen') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2214020032</td>
                    <td>139391303109</td>
                    <td>Ady Rahmayadhie</td>
                    <td>ALW</td>
                    <td>Laki-Laki</td>
                    <td class="imagecel"><img src="../assets/img/keloladosen.png" alt=""></td>
                    <td>Teknologi Informasi</td>
                    <td>
                        <a href="{{ route('edit.dosen') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2214020032</td>
                    <td>139391303109</td>
                    <td>Ady Rahmayadhie</td>
                    <td>ALW</td>
                    <td>Laki-Laki</td>
                    <td class="imagecel"><img src="../assets/img/keloladosen.png" alt=""></td>
                    <td>Teknologi Informasi</td>
                    <td>
                        <a href="{{ route('edit.dosen') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>2214020032</td>
                    <td>139391303109</td>
                    <td>Ady Rahmayadhie</td>
                    <td>ALW</td>
                    <td>Laki-Laki</td>
                    <td class="imagecel"><img src="../assets/img/keloladosen.png" alt=""></td>
                    <td>Teknologi Informasi</td>
                    <td>
                        <a href="{{ route('edit.dosen') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>2214020032</td>
                    <td>139391303109</td>
                    <td>Ady Rahmayadhie</td>
                    <td>ALW</td>
                    <td>Laki-Laki</td>
                    <td class="imagecel"><img src="../assets/img/keloladosen.png" alt=""></td>
                    <td>Teknologi Informasi</td>
                    <td>
                        <a href="{{ route('edit.dosen') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                
                
            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection