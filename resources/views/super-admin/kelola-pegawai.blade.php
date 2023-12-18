@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-circle-user"></i> Kelola Pegawai</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('pegawai.input') }}">Add +</a>
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
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
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
                @foreach ($pegawais as $pegawai)                    
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->username }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td class="d-flex">
                            <a href="{{ route('pegawai.edit', ['idu' => $pegawai->id, 'idp' => $pegawai->pegawai_id]) }}" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                            <form action="{{ route('pegawai.delete') }}" method="POST" id="form-delete-{{ $pegawai->pegawai_id }}" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id_user" value="{{ $pegawai->id }}">
                                <input type="hidden" name="id_pegawai" value="{{ $pegawai->pegawai_id }}">
                                <button type="button" onclick="deleteUser({{ $pegawai->pegawai_id }})" style="border:none; background:none; !important">
                                    <i class="fa-solid fa-trash icon-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{ $pegawais->links() }}
        </nav>
    </div>
</div>
@endsection