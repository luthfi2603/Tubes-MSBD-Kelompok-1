@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Kelola Karya Tulis</h5>
        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('karya.tulis.input') }}">Add +</a>
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
                    <th scope="col">Judul</th>
                    <th scope="col">Abstrak</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyas as $karya)
                    <tr>
                        <td>{{ $karya->judul }}</td>
                        <td>
                            @php
                                $words = explode(' ', $karya->abstrak);
                                $limit = 30;
                                $abstrak = implode(' ', array_slice($words, 0, $limit));
                                echo count($words) > $limit ? $abstrak . '...' : $karya->abstrak;
                            @endphp
                        </td>
                        <td>{{ $karya->jenis }}</td>
                        <td>{{ $karya->tahun }}</td>
                        <td>
                            @php
                                $penulis = "";
                                $penulisTertentu = $penuliss->where('id', $karya->id);

                                foreach ($penulisTertentu as $key) {
                                    $penulis .= $key->kontributor . ', ';
                                }

                                $penulis = rtrim($penulis, ', ');
                            @endphp
                            {{  $penulis  }}
                        </td>
                        <td class="file"><a href="{{ asset('storage/' . $karya->url_file) }}" target="_blank"><i class="fa-regular fa-file-pdf fa-xl"></i></a></td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('karya.tulis.edit', ['id' => $karya->id]) }}"><i class="fa-solid fa-pen icon-edit"></i></a>
                                <form id="form-delete-{{ $karya->id }}" action="{{ route('karya.tulis.delete', $karya->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteKaryaTulis('{{ $karya->id }}')" style="border:none; background:none; !important">
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
            {{$karyas->links()}}
        </nav>
    </div>
</div>
@endsection