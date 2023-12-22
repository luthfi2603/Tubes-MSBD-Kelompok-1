@extends('layouts.main2')

@section('container')
<div class="container admin-mb">
    <div class="row pt-3">
        <h6><a href="/">Home</a><i class="fa-solid fa-angle-right ms-2"></i><span>Bimbingan Saya</span></h6>
        <hr class="mt-0">
        <h6 class="sidebar-col"><span><i class="fa-solid fa-square-poll-horizontal"></i></span>Bimbingan Saya</h6>
        <p class="sidebar-col mt-3">Jumlah mahasiswa : {{ count($karyas) }}</p>
    </div>
    <div class="row">
        @if($karyas->isEmpty())
            <div style="text-align: center" class="mt-4">
                <h3>Hasil tidak ditemukan</h3>
            </div>
        @else
            <table class="table w-75 mx-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Judul</th>
                        <th scope="col" style="white-space: nowrap;">Tahun Skripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyas as $karya)
                        @php
                            $author = $penuliss->where('id', $karya->id)->pluck('kontributor')[0];
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('author', $author) }}">{{ $author }}</a>
                            </td>
                            <td><a href="{{ route('detail.karya.tulis', $karya->id) }}">{{ $karya->judul }}</a></td>
                            <td>{{ $karya->tahun }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example" class="pt-3">
                {{ $karyas->links() }}
            </nav>
        @endif
    </div>
</div>
@endsection