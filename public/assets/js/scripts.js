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

const submitButton = document.getElementById('submitbutton');
submitButton.addEventListener('click', function () {
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
});