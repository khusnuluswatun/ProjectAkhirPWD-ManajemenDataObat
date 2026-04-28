const modal = document.getElementById('mdlTambahObat');
if (modal) {
    modal.addEventListener('hidden.bs.modal', function () {
        const form = modal.querySelector('form');
        form.reset();
        form.querySelectorAll('input[type="file"]').forEach(input => {
            input.value = '';
        });
        form.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
        });
    });
}

function deleteObat(id) {
    Swal.fire({
        title: 'Yakin hapus data?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {
            fetch(`delete.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'dashboard.php';
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server',
                        icon: 'error'
                    });
                });
        }


    });
}


function balas(id) {
    Swal.fire({
        title: 'Balasan dokter',
        input: "textarea",
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {
            let txt = result.value;
            fetch(`update.php?id=${id}&why=admin&pesan=${txt}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'dashboard.php';
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server',
                        icon: 'error'
                    });
                });
        }


    });
}