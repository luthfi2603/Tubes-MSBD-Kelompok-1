@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Kelola E-Book</h5>
        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('ebook.input') }}">Add +</a>
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
                    <th scope="col">Judul</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ebooks as $ebook)
                    <tr>
                        <td>{{ $ebook->judul }}</td>
                        <td>{{ $ebook->tahun_terbit }}</td>
                        <td>{{ $ebook->penulis }}</td>
                        <td><a href="{{ asset('storage/' . $ebook->url_file) }}" target="_blank"><i class="fa-regular fa-file-pdf fa-xl"></i></a></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('ebook.edit', $ebook->id) }}"><i class="fa-solid fa-pen icon-edit"></i></a>
                                <form id="form-delete-{{ $ebook->id }}" action="{{ route('ebook.delete', $ebook->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteEBook('{{ $ebook->id }}')" style="border:none; background:none; !important">
                                        <i class="fa-solid fa-trash icon-delete"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$ebooks->links()}}
        </nav>
    </div>
</div>
@endsection