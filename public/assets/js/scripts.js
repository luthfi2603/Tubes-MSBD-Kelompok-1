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

function deleteEBook($id){
    Swal.fire({
        title: "Hapus E-Book",
        text: "Apakah anda yakin untuk menghapus e-book ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Hapus E-Book",
                text: "Jika anda benar-benar ingin menhapus e-book ini, maka e-book tersebut tidak dapat dikembalikan jika sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#006633",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Hapus E-Book",
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

function deleteStatus($status){
    Swal.fire({
        title: "Hapus Status",
        text: "Apakah anda yakin untuk menghapus Status ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$status}`).submit();
        }
    });
}

function deleteJenisTulisan($jenisTulisan){
    Swal.fire({
        title: "Hapus Jenis Tulisan",
        text: "Apakah anda yakin untuk menghapus jenis tulisan ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$jenisTulisan}`).submit();
        }
    });
}

function deleteBidangIlmu($bidangIlmu){
    Swal.fire({
        title: "Hapus Bidang Ilmu",
        text: "Apakah anda yakin untuk menghapus bidang ilmu ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$bidangIlmu}`).submit();
        }
    });
}

function deleteMahasiswa($mahasiswa){
    Swal.fire({
        title: "Hapus Data Mahasiswa",
        text: "Apakah anda yakin untuk menghapus data mahasiswa ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$mahasiswa}`).submit();
        }
    });
}

function deleteDosen($dosen){
    Swal.fire({
        title: "Hapus Data Dosen",
        text: "Apakah anda yakin untuk menghapus data dosen ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#006633",
        confirmButtonText: "Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${$dosen}`).submit();
        }
    });
}

let i = 1;

async function buatKolaborator(){
    const response = await fetch('/get-mahasiswa-dan-dosen');
    const data = await response.json();
    const mahasiswas = data.mahasiswas;
    const dosens = data.dosens;
    
    const response2 = await fetch('/get-status-kontributor');
    const data2 = await response2.json();
    const statuss = data2.statuss;

    const divId = document.createElement('div');
    divId.classList.add('col-lg-4');
    divId.setAttribute('id', `penulis-${i}`);
    if(document.getElementsByClassName('close').length == 0){
        divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator(${i})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="tingkatan" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="status" name="status[]"><option value="" selected>Pilih Status</option></select></div></div></fieldset>`;
    }else{
        divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 37.7%" onclick="deleteKolaborator(${i})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="tingkatan" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="status" name="status[]"><option value="" selected>Pilih Status</option></select></div></div></fieldset>`;
    }

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

    const selectStatus = divId.querySelector('#status');

    statuss.forEach(status => {
        const option = document.createElement('option');
        option.value = status.nama_status;
        option.textContent = status.nama_status;
        selectStatus.appendChild(option);
    });

    document.getElementById('tambah-kolaborator').append(divId);

    i++;
}

async function buatKolaborator2(){
    const response = await fetch('/get-mahasiswa-dan-dosen');
    const data = await response.json();
    const mahasiswas = data.mahasiswas;
    const dosens = data.dosens;
    
    const response2 = await fetch('/get-status-kontributor');
    const data2 = await response2.json();
    const statuss = data2.statuss;

    const divId = document.createElement('div');
    divId.classList.add('col-lg-4');
    divId.setAttribute('id', `penulis-${j}`);
    if(document.getElementsByClassName('close').length == 0){
        divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 45.4%" onclick="deleteKolaborator(${j})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="tingkatan" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="status" name="status[]"><option value="" selected>Pilih Status</option></select></div></div></fieldset>`;
    }else{
        divId.innerHTML = `<fieldset class="border border-dark rounded p-1 mb-4"><legend style="margin-left: 15px !important">Kolaborator<i class="fa-solid fa-xmark" style="cursor: pointer; position: relative; left: 37.7%" onclick="deleteKolaborator(${j})"></i></legend><div class="inputan-form"><div class="mb-3"><label for="kategori" class="form-label">Masukkan Nama</label><select class="form-select custom-form" aria-label="Default select example" id="nim_nidn" name="nim_nidn[]"><option value="" selected>Pilih Nama</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Tingkatan</label><select class="form-select custom-form" aria-label="Default select example" id="tingkatan" name="tingkatan[]"><option value="" selected>Pilih Tingkatan</option><option value="1">Mahasiswa</option><option value="2">Dosen</option></select></div><div class="mb-3"><label for="kategori" class="form-label">Status</label><select class="form-select custom-form" aria-label="Default select example" id="status" name="status[]"><option value="" selected>Pilih Status</option></select></div></div></fieldset>`;
    }

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

    const selectStatus = divId.querySelector('#status');

    statuss.forEach(status => {
        const option = document.createElement('option');
        option.value = status.nama_status;
        option.textContent = status.nama_status;
        selectStatus.appendChild(option);
    });

    document.getElementById('tambah-kolaborator').append(divId);

    i++;
}

function deleteKolaborator($id){
    const tempatTambahKolaborator = document.getElementById(`penulis-${$id}`);
    tempatTambahKolaborator.setAttribute('hidden', true);
    tempatTambahKolaborator.innerHTML = '';
}

$(document).ready(function() {
    $('#kunci').select2();
});