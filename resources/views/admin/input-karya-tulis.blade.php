@extends('layouts.main-admin')

@section('container')
<div class="container">
    <form action="{{ route('karya.tulis.input') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <h5 class="textit mb-4" style="font-weight: 600;"><i class="fa-solid fa-book"></i> Input Karya Tulis</h5>

            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Karya Tulis</label>
                        <input type="text" class="form-control custom-form" id="judul" name="judul"
                            placeholder="Input Judul Karya Tulis">
                    </div>

                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control custom-form" id="tahun" name="tahun" placeholder="Input Tahun">
                    </div>

                    <div class="mb-3">
                        <label for="file-karyatulis" class="form-label">Upload File</label>
                        <input class="form-control" type="file" name="file" id="file-karyatulis">
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="inputan-form">

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Jenis Tulisan</label>
                        
                        <select class="form-select custom-form" name="jenis" aria-label="Default select example">
                            <option selected>Pilih Jenis Tulisan</option>
                            @foreach ($jeniss as $jenis)
                                <option value="{{ $jenis->jenis_tulisan }}">{{ $jenis->jenis_tulisan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Bidang Ilmu</label>
                        <select class="form-select custom-form" aria-label="Default select example" name="bidang">
                            <option selected>Pilih Bidang Ilmu</option>
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->jenis_bidang_ilmu }}">{{ $bidang->jenis_bidang_ilmu }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <div class="col-lg-10 mb-4">
                <button type="button" class="btn btn-success" style="margin-left: 30px !important"  onclick="copyPenulis()"> + Kolaborator</button>
            </div>

            <div class="col-lg-4" id="penulis-old">
                <fieldset class="border border-dark rounded p-1 mb-4">
                    <legend style="margin-left: 15px !important">Kolaborator</legend>
                    <div class="inputan-form">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">NIM/NIP</label>
                            <select class="form-select custom-form" aria-label="Default select example"
                                id="nim_nip" name="nim_nip[]">
                                <option selected>Masukan NIM / NIP</option>
                                <option value="1">Machine Learning</option>
                            </select>
                        </div>        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Tingkatan</label>
                            <select class="form-select custom-form" aria-label="Default select example"
                                id="kategori-karyatulis" name="tingkatan[]">
                                <option selected>Pilih Tingkatan</option>
                                <option value="1">Mahasiswa</option>
                                <option value="2">Dosen</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Status</label>
                            <select class="form-select custom-form" aria-label="Default select example"
                                id="kategori-karyatulis" name="status[]">
                                <option selected>Pilih Status</option>
                                <option value="1">Penulis</option>
                                <option value="1">Pembimbing</option>
                                <option value="1">Kolaborator</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>

        

            <div class="inputan mb-3">
                <label for="kategori" class="form-label">Kata Kunci</label>
                <select class="form-select custom-form" aria-label="Default select example"
                    id="kunci" name="kunci[]" multiple="multiple">
                    @foreach ($kuncis as $kunci)
                        <option value="{{ $kunci->kata_kunci }}">{{ $kunci->kata_kunci }}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputan mb-4">
                <label for="abstrak" class="form-label">Abstrak</label>
                <div class="form-floating">
                    <textarea class="form-control custom-form" placeholder="Input Abstrak" id="abstrak" name="abstrak"
                        style="height: 100px"></textarea>
                    <label for="abstrak">Input Abstrak</label>
                </div>
            </div>

            <div class="inputan-form mb-5 mt-3">
                <button type="submit" class="btn btn-success tombol">Submit</button>
                <a href="{{ route('kelola.karya.tulis') }}" class="btn btn-warning tombol">Kembali</a>
            </div>

        </div>
    </form>
</div>

<script>
    function copyPenulis() {
        var clonedContent = $("#penulis-old").clone();

        // Ganti ID elemen yang baru agar tidak ada duplikasi ID
        var newID = "penulis-new_" + $(".col-lg-4").length;
        clonedContent.attr("id", newID);

        // Reset nilai input
        clonedContent.find('input, select').val(null);

        // Append elemen yang di-clone ke dalam dokumen
        $("#penulis-old").after(clonedContent);

        // Inisialisasi Select2 pada elemen yang baru
        $("#" + newID + ' .custom-form select').select2();
    };

    $(document).ready(function() {
        $('#kunci').select2();
    });
    
    $(document).ready(function() {
        $('#nim_nip').select2();
    });
</script>


@endsection