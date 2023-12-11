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
                        {{-- {{ $karya->abstrak }} --}}
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
                    <td class="file">{{ $karya->url_file }}</td>
                    <td>
                        <a href="{{ route('edit.karya.tulis', ['id' => $karya->id]) }}"><i class="fa-solid fa-pen icon-edit"></i></a>
                        <a href="#" id="deletekaryatulis"><i class="fa-solid fa-trash icon-delete"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$karyas->links()}}
        </nav>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection