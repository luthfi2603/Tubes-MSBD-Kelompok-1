@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-list"></i> Daftar Log</h5>
        <div class="col-lg-9 justify-content-start">
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
                    <th scope="col">Operasi</th>
                    <th scope="col" style="white-space: nowrap;">Pada Tabel</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Oleh</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log) 
                    <tr>
                        <td>{{ $log->action }}</td>
                        <td style="white-space: nowrap;">{{ $log->tabel }}</td>
                        <td>{{ $log->judul }}</td>
                        <td style="white-space: nowrap;">{{ $log->diupload_oleh }}</td>
                        <td>{{ $log->waktu }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$logs->links()}}
        </nav>
    </div>
</div>
@endsection