@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user-tie"></i> Kelola Dosen</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('dosen.input') }}">Add +</a>
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
                    <th scope="col">No</th>
                    <th scope="col">NIDN</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kode Dosen</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t = request('page');
                @endphp
                @if (empty($t))
                    <?php $i = 1; ?>
                @else
                    <?php $i = ($t * 10) - 9; ?>
                @endif
                @foreach ($dosens as $dosen)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $dosen->nidn }}</td>
                        <td>{{ $dosen->nip }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->kode_dosen }}</td>
                        <td>{{ $dosen->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        <td>
                            @php
                                $prodi = $prodis->where('kode_prodi', $dosen->kode_prodi)->first();
                            @endphp
                            {{ $prodi->jenjang }}&nbsp;{{ $prodi->nama_prodi }}
                        </td>
                        <td>
                            <div class="d-flex">  
                                <a href="{{ route('dosen.edit', ['nidn' => $dosen->nidn]) }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                                <form id="form-delete-{{ $dosen->nidn }}" action="{{ route('dosen.delete', $dosen->nidn) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteDosen('{{ $dosen->nidn }}')" style="border:none; background:none; !important">
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
            {{$dosens->links()}}
        </nav>
    </div>
</div>
@endsection