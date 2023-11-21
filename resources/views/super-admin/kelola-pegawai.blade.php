@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-circle-user"></i> Kelola Pegawai</h5>

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
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>andierahmah12</td>
                    <td>Anedy Rahmayadhie</td>
                    <td>adiesedangjadicontoh@gmail.com</td>
                    <td>
                        <a href="editpegawai.html" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletepegawai"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>andierahmah12</td>
                    <td>Anedy Rahmayadhie</td>
                    <td>adiesedangjadicontoh@gmail.com</td>
                    <td>
                        <a href="editpegawai.html" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletepegawai"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>andierahmah12</td>
                    <td>Anedy Rahmayadhie</td>
                    <td>adiesedangjadicontoh@gmail.com</td>
                    <td>
                        <a href="editpegawai.html" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletepegawai"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>andierahmah12</td>
                    <td>Anedy Rahmayadhie</td>
                    <td>adiesedangjadicontoh@gmail.com</td>
                    <td>
                        <a href="editpegawai.html" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletepegawai"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>andierahmah12</td>
                    <td>Anedy Rahmayadhie</td>
                    <td>adiesedangjadicontoh@gmail.com</td>
                    <td>
                        <a href="editpegawai.html" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletepegawai"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection