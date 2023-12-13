function submit(){
    Swal.fire({
        title: "Perubahan akan tersimpan!",
        text: "Tekan Submit untuk menyimpan atau Cancel untuk mengedit kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#006633",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Submit"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form').submit();
        }
    });
}

function deleteUser($id){
    Swal.fire({
        title: "Hapus User",
        text: "Apakah anda yakin untuk menghapus user ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Hapus User",
                text: "Jika anda benar-benar ingin menhapus user ini, maka user tersebut tidak dapat dikembalikan jika sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#006633",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Hapus User",
                        text: "Apakah anda benar-benar yakin?!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D80032",
                        cancelButtonColor: "#006633",
                        confirmButtonText: "Delete"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`form-delete-${$id}`).submit();
                        }
                    });
                }
            });
        }
    });
}

function deleteKaryaTulis($id){
    Swal.fire({
        title: "Hapus Karya Tulis",
        text: "Apakah anda yakin untuk menghapus karya tulis ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Hapus Karya Tulis",
                text: "Jika anda benar-benar ingin menhapus karya tulis ini, maka karya tulis tersebut tidak dapat dikembalikan jika sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#006633",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Hapus Karya Tulis",
                        text: "Apakah anda benar-benar yakin?!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D80032",
                        cancelButtonColor: "#006633",
                        confirmButtonText: "Delete"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`form-delete-${$id}`).submit();
                        }
                    });
                }
            });
        }
    });
}

function deleteKataKunci($kataKunci){
    Swal.fire({
        title: "Hapus Kata Kunci",
        text: "Apakah anda yakin untuk menghapus kata kunci ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$kataKunci}`).submit();
        }
    });
}

let i = 1;

async function buatKolaborator(){
    const response = await fetch('/get-mahasiswa-dan-dosen');
    const data = await response.json();
    const mahasiswas = data.mahasiswas;
    const dosens = data.dosens;

    const divId = document.createElement('div');
    divId.classList.add('col-lg-4');
    divId.setAttribute('id', `penulis-${i}`);
    divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator(${i})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="status[]"><option value="" selected>Pilih Status</option><option value="penulis">Penulis</option><option value="pembimbing">Pembimbing</option><option value="kontributor">Kontributor</option></select></div></div></fieldset>`;

    const selectNimNidn = divId.querySelector('#nim_nidn');

    mahasiswas.forEach(mahasiswa => {
        const option = document.createElement('option');
        option.value = mahasiswa.nim;
        option.textContent = mahasiswa.nama + ' - ' + mahasiswa.nim;
        selectNimNidn.appendChild(option);
    });

    dosens.forEach(dosen => {
        const option = document.createElement('option');
        option.value = dosen.nidn;
        option.textContent = dosen.nama + ' - ' + dosen.nidn;
        selectNimNidn.appendChild(option);
    });

    document.getElementById('tambah-kolaborator').append(divId);

    i++;
}

async function buatKolaborator2(){
    const response = await fetch('/get-mahasiswa-dan-dosen');
    const data = await response.json();
    const mahasiswas = data.mahasiswas;
    const dosens = data.dosens;

    const divId = document.createElement('div');
    divId.classList.add('col-lg-4');
    divId.setAttribute('id', `penulis-${j}`);
    divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator(${j})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="kategori-karyatulis" name="status[]"><option value="" selected>Pilih Status</option><option value="penulis">Penulis</option><option value="pembimbing">Pembimbing</option><option value="kontributor">Kontributor</option></select></div></div></fieldset>`;

    const selectNimNidn = divId.querySelector('#nim_nidn');

    mahasiswas.forEach(mahasiswa => {
        const option = document.createElement('option');
        option.value = mahasiswa.nim;
        option.textContent = mahasiswa.nama + ' - ' + mahasiswa.nim;
        selectNimNidn.appendChild(option);
    });

    dosens.forEach(dosen => {
        const option = document.createElement('option');
        option.value = dosen.nidn;
        option.textContent = dosen.nama + ' - ' + dosen.nidn;
        selectNimNidn.appendChild(option);
    });

    document.getElementById('tambah-kolaborator').append(divId);

    j++;
}

function deleteKolaborator($id){
    const tempatTambahKolaborator = document.getElementById(`penulis-${$id}`);
    tempatTambahKolaborator.setAttribute('hidden', true);
    tempatTambahKolaborator.innerHTML = '';
}

$(document).ready(function() {
    $('#kunci').select2();
});