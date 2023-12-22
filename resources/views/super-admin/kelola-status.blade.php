@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-person"></i> Kelola status</h5>
        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('status.input') }}">Add +</a>
        </div>
        {{-- <div class="col-lg-3 justify-content-end">
            <div class="input-group input-search">
                <input type="text" class="form-control" placeholder="Search this blog">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div> --}}
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
                    <th scope="col">Nama Status</th>
                    <th scope="col">Tingkatan</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Tanggal Perubahan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statuss as $status)
                    <tr>
                        <td>{{ $status->nama_status }}</td>
                        <td>
                            @if($status->status === 0)
                                Mahasiswa dan Dosen
                            @else
                                Dosen
                            @endif
                        </td>
                        <td>{{ $status->created_at }}</td>
                        @if($status->created_at == $status->updated_at)
                            <td>-</td>
                        @else
                            <td>{{ $status->updated_at }}</td>
                        @endif
                        <td class="d-flex">
                            <a href="{{ route('status.edit', ['status' => $status->nama_status]) }}">
                                <i class="fa-solid fa-pen icon-edit"></i>
                            </a>
                            <form id="form-delete-{{ $status->nama_status }}" action="{{ route('status.delete', ['status' => $status->nama_status]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteStatus('{{ $status->nama_status }}')" style="border:none; background:none; !important">
                                    <i class="fa-solid fa-trash icon-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$statuss->links()}}
        </nav>
    </div>
</div>
@endsection