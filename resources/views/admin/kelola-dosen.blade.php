@extends('layouts.main-admin')

@section('container')
<div class="container">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-user-tie"></i> Kelola Dosen</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('dosen.input') }}">Add +</a>
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
                            <a href="{{ route('dosen.edit') }}" id="editdosen"><i class="fa-solid fa-pen icon-edit"></i></a>
                            <a href="#" id="deletedosen"><i class="fa-solid fa-trash icon-delete"></i></a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <!-- Disini dibikin pagination kalo bingung tengo di figma. -->
    </div>
</div>
@endsection