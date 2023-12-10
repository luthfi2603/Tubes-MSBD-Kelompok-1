/* const cancelButton = document.getElementById('cancelbutton');
cancelButton.addEventListener('click', function () {
    Swal.fire({
        title: "Perubahan tidak akan tersimpan",
        text: "Tekan OK untuk kembali ke halaman sebelumnya atau Cancel untuk mengedit kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#daa520",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Cancelled!",
                text: "Perubahan tidak akan disimpan",
                icon: "error"
            });
            // document.location.href = '/profile';
        }
    });
}); */

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
            /* Swal.fire({
                title: "Succesed!",
                text: "Perubahan berhasil disimpan",
                icon: "success"
            }); */
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