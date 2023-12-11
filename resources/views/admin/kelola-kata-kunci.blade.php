@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-list"></i> Kelola Kata Kunci</h5>
        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('kata.kunci.input') }}">Add +</a>
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
                    <th scope="col">Kata Kunci</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Tanggal Perubahan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuncis as $kunci)
                    <tr>
                        <td>{{ $kunci->kata_kunci }}</td>
                        <td>{{ $kunci->created_at }}</td>
                        @if($kunci->created_at == $kunci->updated_at)
                            <td>-</td>
                        @else
                            <td>{{ $kunci->updated_at }}</td>
                        @endif
                        <td class="d-flex">
                            <a href="{{ route('kata.kunci.edit', ['kunci' => $kunci->kata_kunci]) }}">
                                <i class="fa-solid fa-pen icon-edit"></i>
                            </a>
                            <form id="form-delete-{{ $kunci->kata_kunci }}" action="{{ route('kata.kunci.delete', ['kunci' => $kunci->kata_kunci]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteKataKunci('{{ $kunci->kata_kunci }}')" style="border:none; background:none; !important">
                                    <i class="fa-solid fa-trash icon-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$kuncis->links()}}
        </nav>
    </div>
</div>
@endsection