@extends('layouts.main-admin')

@section('container')
<div class="container admin-mb">
    <div class="row mt-4 mb-4">
        <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-users"></i> Kelola User</h5>

        <div class="col-lg-9 justify-content-start">
            <a class="purple-button" href="{{ route('user.input') }}">Add +</a>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-2 mb-5 justify-content-center">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    {{-- <th scope="col">No</th> --}}
                    <th scope="col">NIM/NIDN</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            {{-- @dd($users) --}}
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->nim_nidn }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            {{ $user->email }}
                            @if($user->email_verified_at !== NULL)
                                <i class="fa-regular fa-circle-check"></i>
                            @endif
                        </td>
                        <td>{{ $user->status }}</td>
                        <td>
                            @php
                                $prodi = $prodis->where('kode_prodi', $user->kode_prodi)->first();
                            @endphp
                            {{ $prodi->jenjang }}&nbsp;{{ $prodi->nama_prodi }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" id="edituser"><i class="fa-solid fa-pen icon-edit"></i></a>
                            <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" id="form-delete-{{ $user->nim_nidn }}" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <input type="text" value="{{ $user->status }}" name="status" hidden>
                                <input type="text" value="{{ $user->nim_nidn }}" name="nim_nidn" hidden>
                                <button type="button" onclick="deleteUser('{{ $user->nim_nidn }}')" style="border:none; background:none; !important">
                                    <i class="fa-solid fa-trash icon-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            {{$users->links()}}
        </nav>
    </div>
</div>
@endsection