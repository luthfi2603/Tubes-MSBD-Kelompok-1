@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-list"></i> Kelola Bidang ilmu</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('bidang.ilmu.input') }}">Add +</a>
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

    @if(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-2 mb-5 justify-content-center">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Bidang Ilmu</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Tanggal Perubahan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bidangs as $bidang)
                <tr>
                    <td>{{ $bidang->jenis_bidang_ilmu }}</td>
                    <td>{{ $bidang->created_at }}</td>
                    @if($bidang->created_at == $bidang->updated_at)
                        <td>-</td>
                    @else
                        <td>{{ $bidang->updated_at }}</td>
                    @endif
                    <td class="d-flex">
                        <a href="{{ route('bidang.ilmu.edit', ['bidang' => $bidang->jenis_bidang_ilmu]) }}" id="editBidangIlmu">
                            <i class="fa-solid fa-pen icon-edit"></i>
                        </a>
                        <form action="{{ route('bidang.ilmu.delete', ['bidang' => $bidang->jenis_bidang_ilmu]) }}" method="POST" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button style="border:none; background:none; !important"  type="submit" id="submitbutton" onclick="return confirm('Yakin mau menghapus')">
                                <i class="fa-solid fa-trash icon-delete"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection