<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?=base_url('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- daterangepicker -->
<script src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<!-- Toastr -->
<script src="<?=base_url('assets/plugins/toastr/toastr.min.js')?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<script>
$(function() {
    $("#periksaPasien").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
$(document).ready(function() {

    $('#datamaster').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('.btnDaftarAkun').click(function(event) {
        event.preventDefault();

        var nama = $('[name="namaDaftar"]').val();
        var alamat = $('[name="alamatDaftar"]').val();
        var noktp = $('[name="noktpDaftar"]').val();
        var nohp = $('[name="nohpDaftar"]').val();

        if (nama.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Akun Gagal !</label><br>Nama wajib diisi.'
            })
            return;
        }
        if (alamat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Akun Gagal !</label><br>Alamat wajib diisi.'
            })
            return;
        }
        if (noktp.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Akun Gagal !</label><br>Nomor KTP wajib diisi.'
            })
            return;
        }
        if (nohp.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Akun Gagal !</label><br>Nomor HP wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?= base_url("mycontroller/auth") ?>',
            type: 'POST',
            data: {
                nama: nama,
                alamat: alamat,
                noktp: noktp,
                nohp: nohp,
                type: 'daftar',
            }, // Menentukan bahwa kita mengharapkan JSON sebagai respons
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Pendaftaran berhasil !</label><br>Mohon ditunggu.'
                    });
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Daftar Akun Gagal !</label><br>' +
                            response.message
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnLoginAkun').click(function(event) {
        event.preventDefault();

        var username = $('[name="usernameLogin"]').val();
        var password = $('[name="passwordLogin"]').val();

        if (username.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Login Akun Gagal !</label><br>Username wajib diisi.'
            })
            return;
        }
        if (password.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Login Akun Gagal !</label><br>Password wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?= base_url("mycontroller/auth") ?>',
            type: 'POST',
            data: {
                username: username,
                password: password,
                type: 'login',
            }, // Menentukan bahwa kita mengharapkan JSON sebagai respons
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Login berhasil !</label><br>Mohon ditunggu.'
                    });
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Login Akun Gagal !</label><br>' +
                            response.message
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    /*
    JAVASCRIPT (JS) UNTUK ROLE ADMIN HALAMAN DATA POLI
    */
    $('.btnAdminSubmitPoli').click(function(event) {
        event.preventDefault();

        var namapoli = $('[name="tambahnamapoli"]').val();
        var keteranganpoli = $('[name="tambahketeranganpoli"]').val();

        if (namapoli.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Poli Gagal !</label><br>Nama poli wajib diisi.'
            })
            return;
        }
        if (keteranganpoli.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Poli Gagal !</label><br>Keterangan wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_poli")?>',
            type: 'post',
            data: {
                namapoli: namapoli,
                keteranganpoli: keteranganpoli,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Tambah Poli Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Poli Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminHapusPoli').click(function(event) {
        event.preventDefault();

        var idpoli = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Poli?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '<?=base_url("mycontroller/manage_data_poli")?>',
                    type: 'post',
                    data: {
                        idpoli: idpoli,
                        type: 'hapus_data'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: '<label style="color:green;">Hapus Poli Sukses !</label><br>' +
                                    response.message
                            })
                            // Reload halaman setelah 3 detik (3000ms)
                            setTimeout(function() {
                                    location
                                        .reload(); // Untuk me-reload halaman
                                },
                                1500
                            ); // Waktu delay sebelum reload (dalam milidetik)
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<label style="color:red;">Hapus Poli Gagal !</label><br>' +
                                    response.message
                            })
                            return;
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                            'error');
                    }
                });
            }
        });
    });

    $('.btnAdminEditPoli').click(function(event) {
        event.preventDefault();

        var idpoli = $(this).data('id');

        $.ajax({
            url: '<?= base_url("mycontroller/get_data_poli") ?>',
            type: 'POST',
            data: {
                idpoli: idpoli
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Isi field di dalam modal dengan data yang didapat
                    $('#ubahPoliForm input[name="idpoli"]').val(data.id);
                    $('#ubahPoliForm input[name="ubahnamapoli"]').val(data.nama_poli);
                    $('#ubahPoliForm input[name="ubahketeranganpoli"]').val(data
                        .keterangan);
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminSubmitEditPoli').click(function(event) {
        event.preventDefault();

        var idpoli = $('[name=idpoli]').val();
        var namapoli = $('[name=ubahnamapoli]').val();
        var keteranganpoli = $('[name=ubahketeranganpoli]').val();

        if (namapoli.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Poli Gagal !</label><br>Nama poli wajib diisi'
            })
            return;
        }
        if (keteranganpoli.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Poli Gagal !</label><br>Keterangan wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_poli")?>',
            type: 'post',
            data: {
                idpoli: idpoli,
                namapoli: namapoli,
                keteranganpoli: keteranganpoli,
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Ubah Poli Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location
                                .reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Ubah Poli Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });
    //END



    /*
    JAVASCRIPT (JS) UNTUK ROLE ADMIN HALAMAN DATA OBAT
    */
    $('.btnAdminSubmitObat').click(function(event) {
        event.preventDefault();

        var namaobat = $('[name="tambahnamaobat"]').val();
        var kemasanobat = $('[name="tambahkemasanobat"]').val();
        var hargaobat = $('[name="tambahhargaobat"]').val();

        if (namaobat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Obat Gagal !</label><br>Nama obat wajib diisi.'
            })
            return;
        }
        if (kemasanobat.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Obat Gagal !</label><br>Kemasan wajib diisi.'
            })
            return;
        }
        if (hargaobat.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Obat Gagal !</label><br>Harga obat wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_obat")?>',
            type: 'post',
            data: {
                namaobat: namaobat,
                kemasanobat: kemasanobat,
                hargaobat: hargaobat,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Tambah Obat Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Obat Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminHapusObat').click(function(event) {
        event.preventDefault();

        var idobat = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Obat?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '<?=base_url("mycontroller/manage_data_obat")?>',
                    type: 'post',
                    data: {
                        idobat: idobat,
                        type: 'hapus_data'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: '<label style="color:green;">Hapus Obat Sukses !</label><br>' +
                                    response.message
                            })
                            // Reload halaman setelah 3 detik (3000ms)
                            setTimeout(function() {
                                    location
                                        .reload(); // Untuk me-reload halaman
                                },
                                1500
                            ); // Waktu delay sebelum reload (dalam milidetik)
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<label style="color:red;">Hapus Obat Gagal !</label><br>' +
                                    response.message
                            })
                            return;
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                            'error');
                    }
                });
            }
        });
    });

    $('.btnAdminEditObat').click(function(event) {
        event.preventDefault();

        var idobat = $(this).data('id');

        $.ajax({
            url: '<?= base_url("mycontroller/get_data_obat") ?>',
            type: 'POST',
            data: {
                idobat: idobat
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Isi field di dalam modal dengan data yang didapat
                    $('#ubahObatForm input[name="idobat"]').val(data.id);
                    $('#ubahObatForm input[name="ubahnamaobat"]').val(data.nama_obat);
                    $('#ubahObatForm input[name="ubahkemasanobat"]').val(data.kemasan);
                    $('#ubahObatForm input[name="ubahhargaobat"]').val(data.harga);
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminSubmitEditObat').click(function(event) {
        event.preventDefault();

        var idobat = $('[name=idobat]').val();
        var namaobat = $('[name=ubahnamaobat]').val();
        var kemasanobat = $('[name=ubahkemasanobat]').val();
        var hargaobat = $('[name=ubahhargaobat]').val();

        if (namaobat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Obat Gagal !</label><br>Nama obat wajib diisi'
            })
            return;
        }
        if (kemasanobat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Obat Gagal !</label><br>Kemasan wajib diisi.'
            })
            return;
        }
        if (hargaobat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Obat Gagal !</label><br>Harga obat wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_obat")?>',
            type: 'post',
            data: {
                idobat: idobat,
                namaobat: namaobat,
                kemasanobat: kemasanobat,
                hargaobat: hargaobat,
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Ubah Obat Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Ubah Obat Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });
    //END



    /*
    JAVASCRIPT (JS) UNTUK ROLE ADMIN HALAMAN DATA DOKTER
    */
    $('.btnAdminSubmitDokter').click(function(event) {
        event.preventDefault();

        var namadokter = $('[name="tambahnamadokter"]').val();
        var alamatdokter = $('[name="tambahalamatdokter"]').val();
        var nohpdokter = $('[name="tambahnohpdokter"]').val();
        var polidokter = $('[name="tambahpolidokter"]').val();

        if (namadokter.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Dokter Gagal !</label><br>Nama dokter wajib diisi.'
            })
            return;
        }
        if (alamatdokter.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Dokter Gagal !</label><br>Alamat wajib diisi.'
            })
            return;
        }
        if (nohpdokter.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Dokter Gagal !</label><br>Nomor HP dokter wajib diisi.'
            })
            return;
        }
        if (polidokter === '' || polidokter === 'Pilih Tempat Poli') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Dokter Gagal !</label><br>Tempat poli wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_dokter")?>',
            type: 'post',
            data: {
                namadokter: namadokter,
                alamatdokter: alamatdokter,
                nohpdokter: nohpdokter,
                polidokter: polidokter,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Tambah Dokter Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Dokter Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminHapusDokter').click(function(event) {
        event.preventDefault();

        var iddokter = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Dokter?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '<?=base_url("mycontroller/manage_data_dokter")?>',
                    type: 'post',
                    data: {
                        iddokter: iddokter,
                        type: 'hapus_data'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: '<label style="color:green;">Hapus Dokter Sukses !</label><br>' +
                                    response.message
                            })
                            // Reload halaman setelah 3 detik (3000ms)
                            setTimeout(function() {
                                    location
                                        .reload(); // Untuk me-reload halaman
                                },
                                1500
                            ); // Waktu delay sebelum reload (dalam milidetik)
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<label style="color:red;">Hapus Dokter Gagal !</label><br>' +
                                    response.message
                            })
                            return;
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                            'error');
                    }
                });
            }
        });
    });

    $('.btnAdminEditDokter').click(function(event) {
        event.preventDefault();

        var iddokter = $(this).data('id');

        $.ajax({
            url: '<?= base_url("mycontroller/get_data_dokter") ?>',
            type: 'POST',
            data: {
                iddokter: iddokter
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Isi field di dalam modal dengan data yang didapat
                    $('#ubahDokterForm input[name="iddokter"]').val(data.id);
                    $('#ubahDokterForm input[name="ubahnamadokter"]').val(data.nama);
                    $('#ubahDokterForm input[name="ubahalamatdokter"]').val(data.alamat);
                    $('#ubahDokterForm input[name="ubahnohpdokter"]').val(data.no_hp);
                    $('#ubahDokterForm select[name="ubahpolidokter"]').val(data.poli_id);
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminSubmitEditDokter').click(function(event) {
        event.preventDefault();

        var iddokter = $('[name=iddokter]').val();
        var namadokter = $('[name=ubahnamadokter]').val();
        var alamatdokter = $('[name=ubahalamatdokter]').val();
        var nohpdokter = $('[name=ubahnohpdokter]').val();
        var polidokter = $('[name=ubahpolidokter]').val();

        if (namadokter.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Dokter Gagal !</label><br>Nama dokter wajib diisi'
            })
            return;
        }
        if (alamatdokter.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Dokter Gagal !</label><br>Alamat dokter wajib diisi.'
            })
            return;
        }
        if (nohpdokter.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Dokter Gagal !</label><br>Nomor HP dokter wajib diisi.'
            })
            return;
        }
        if (polidokter === '' || polidokter === 'Pilih Tempat Poli') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Dokter Gagal !</label><br>Tempat poli wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_dokter")?>',
            type: 'post',
            data: {
                iddokter: iddokter,
                namadokter: namadokter,
                alamatdokter: alamatdokter,
                nohpdokter: nohpdokter,
                polidokter: polidokter,
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Ubah Dokter Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Ubah Dokter Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });
    //END




    /*
        JAVASCRIPT (JS) UNTUK ROLE ADMIN HALAMAN DATA PASIEN
    */
    $('.btnAdminSubmitPasien').click(function(event) {
        event.preventDefault();

        var namapasien = $('[name="tambahnamapasien"]').val();
        var alamatpasien = $('[name="tambahalamatpasien"]').val();
        var nohppasien = $('[name="tambahnohppasien"]').val();
        var noktppasien = $('[name="tambahnoktppasien"]').val();

        if (namapasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>Nama pasien wajib diisi.'
            })
            return;
        }
        if (alamatpasien.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>Alamat pasien wajib diisi.'
            })
            return;
        }
        if (nohppasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>Nomor HP pasien wajib diisi.'
            })
            return;
        }
        if (noktppasien == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>Nomor KTP pasien wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_pasien")?>',
            type: 'post',
            data: {
                namapasien: namapasien,
                alamatpasien: alamatpasien,
                nohppasien: nohppasien,
                noktppasien: noktppasien,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Tambah Pasien Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                        location.reload(); // Untuk me-reload halaman
                    }, 3000); // Waktu delay sebelum reload (dalam milidetik)
                } else if (response.status === 'duplicate') {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>' +
                            response.message
                    })
                    return;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Pasien Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminHapusPasien').click(function(event) {
        event.preventDefault();

        var idpasien = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Pasien?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '<?=base_url("mycontroller/manage_data_pasien")?>',
                    type: 'post',
                    data: {
                        idpasien: idpasien,
                        type: 'hapus_data'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: '<label style="color:green;">Hapus Pasien Sukses !</label><br>' +
                                    response.message
                            })
                            // Reload halaman setelah 3 detik (3000ms)
                            setTimeout(function() {
                                    location
                                        .reload(); // Untuk me-reload halaman
                                },
                                1500
                            ); // Waktu delay sebelum reload (dalam milidetik)
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<label style="color:red;">Hapus Pasien Gagal !</label><br>' +
                                    response.message
                            })
                            return;
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                            'error');
                    }
                });
            }
        });
    });

    $('.btnAdminEditPasien').click(function(event) {
        event.preventDefault();

        var idpasien = $(this).data('id');

        $.ajax({
            url: '<?= base_url("mycontroller/get_data_pasien") ?>',
            type: 'POST',
            data: {
                idpasien: idpasien
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Isi field di dalam modal dengan data yang didapat
                    $('#ubahPasienForm input[name="idpasien"]').val(data.id);
                    $('#ubahPasienForm input[name="ubahnormpasien"]').val(data.no_rm);
                    $('#ubahPasienForm input[name="ubahnamapasien"]').val(data.nama);
                    $('#ubahPasienForm input[name="ubahalamatpasien"]').val(data.alamat);
                    $('#ubahPasienForm input[name="ubahnohppasien"]').val(data.no_hp);
                    $('#ubahPasienForm input[name="ubahnoktppasien"]').val(data.no_ktp);
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnAdminSubmitEditPasien').click(function(event) {
        event.preventDefault();

        var idpasien = $('[name=idpasien]').val();
        var namapasien = $('[name=ubahnamapasien]').val();
        var alamatpasien = $('[name=ubahalamatpasien]').val();
        var nohppasien = $('[name=ubahnohppasien]').val();
        var noktppasien = $('[name=ubahnoktppasien]').val();

        if (namapasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Pasien Gagal !</label><br>Nama pasien wajib diisi'
            })
            return;
        }
        if (alamatpasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Pasien Gagal !</label><br>Alamat pasien wajib diisi.'
            })
            return;
        }
        if (nohppasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Pasien Gagal !</label><br>Nomor HP pasien wajib diisi.'
            })
            return;
        }
        if (noktppasien.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Ubah Pasien Gagal !</label><br>Nomor KTP pasien wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_data_pasien")?>',
            type: 'post',
            data: {
                idpasien: idpasien,
                namapasien: namapasien,
                alamatpasien: alamatpasien,
                nohppasien: nohppasien,
                noktppasien: noktppasien,
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Ubah Pasien Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Ubah Pasien Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });
    //END



    /*
        JAVASCRIPT (JS) UNTUK ROLE DOKTER HALAMAN UPDATE PROFILE
    */

    $('.btnDokterUpdateProfile').click(function(event) {
        event.preventDefault(); // Mencegah aksi default link

        var iddokter = $(this).data('id');

        $.ajax({
            url: '<?= base_url("mycontroller/get_data_profile_dokter") ?>',
            type: 'POST',
            data: {
                iddokter: iddokter
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Isi field di dalam modal dengan data yang didapat
                    $('#updateProfileForm input[name="idProfile"]').val(data.id);
                    $('#updateProfileForm input[name="namaProfile"]').val(data.nama);
                    $('#updateProfileForm input[name="alamatProfile"]').val(data.alamat);
                    $('#updateProfileForm input[name="nohpProfile"]').val(data.no_hp);
                    $('#updateProfileForm select[name="poliProfile"]').val(data.id_poli);
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });

        // Jika form saat ini tersembunyi, tampilkan dengan fadeIn
        if ($('#profileForm').is(':hidden')) {
            $('#profileForm').fadeIn(); // Menampilkan form dengan efek fade
        } else {
            $('#profileForm').fadeOut(); // Menyembunyikan form dengan efek fade
        }
    });

    $('.btnDokterCancelUpdateProfile').click(function(event) {
        event.preventDefault(); // Mencegah aksi default link

        $('[name=idProfile]').val('');
        $('[name=namaProfile]').val('');
        $('[name=alamatProfile]').val('');
        $('[name=nohpProfile]').val('');
    });

    $('.btnDokterSubmitUpdateProfile').click(function(event) {
        event.preventDefault(); // Mencegah aksi default link

        var id = $('[name=idProfile]').val();
        var nama = $('[name=namaProfile]').val();
        var alamat = $('[name=alamatProfile]').val();
        var nohp = $('[name=nohpProfile]').val();
        var poli = $('[name=poliProfile]').val();

        if (nama.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Profile Gagal !</label><br>Nama wajib diisi.'
            })
            return;
        }

        if (alamat.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Profile Gagal !</label><br>Alamat wajib diisi.'
            })
            return;
        }

        if (nohp.length == 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Profile Gagal !</label><br>Nomor HP wajib diisi.'
            })
            return;
        }

        if (poli === 'Pilih Tempat Poli' || poli === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Profile Gagal !</label><br>Tempat poli wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_profile_dokter")?>',
            type: 'post',
            data: {
                idProfile: id,
                namaProfile: nama,
                alamatProfile: alamat,
                nohpProfile: nohp,
                poliProfile: poli
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Update Profile Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Update Profile Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    /*
        JAVASCRIPT (JS) UNTUK ROLE DOKTER HALAMAN JADWAL PERIKSA
    */

    $('.btnDokterSubmitJadwal').click(function(event) {
        event.preventDefault(); // Mencegah aksi default link

        var hari = $('[name=hariJadwal]').val();
        var jamMulai = $('[name=jamMulaiJadwal]').val();
        var jamSelesai = $('[name=jamSelesaiJadwal]').val();

        if (hari === 'Pilih Hari' || hari === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Jadwal Gagal !</label><br>Hari praktek wajib diisi.'
            })
            return;
        }

        if (jamMulai === 'Pilih Jam' || jamMulai === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Jadwal Gagal !</label><br>Jam mulai praktek wajib diisi.'
            })
            return;
        }

        if (jamSelesai === 'Pilih Jam' || jamSelesai === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Tambah Jadwal Gagal !</label><br>Jam selesai praktek wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_jadwal_dokter")?>',
            type: 'post',
            data: {
                hariDokter: hari,
                jamMulaiDokter: jamMulai,
                jamSelesaiDokter: jamSelesai,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Tambah Jadwal Periksa Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Tambah Jadwal Periksa Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnDokterToggleJadwal').click(function(event) {
        var status = $(this).prop('checked') ? 'aktif' : 'tidak aktif';
        var id_jadwal = $(this).attr('id').replace('statusSwitch',
            ''); // Ambil ID jadwal dari ID toggle

        // Kirim request AJAX untuk update status
        $.ajax({
            url: '<?=base_url("mycontroller/manage_jadwal_dokter")?>', // Ganti dengan URL yang sesuai untuk update status
            type: 'POST',
            data: {
                id: id_jadwal,
                status: status,
                type: 'toggle_jadwal'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Perubahan Jadwal Sukses !</label><br>' +
                            response.message
                    });
                    return;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Perubahan Jadwal Gagal !</label><br>' +
                            response.message
                    });
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnDokterEditJadwal').click(function(event) {
        event.preventDefault();

        var idjadwal = $(this).data('id');

        $.ajax({
            url: '<?=base_url("mycontroller/get_data_jadwal_periksa")?>',
            data: {
                idjadwal: idjadwal
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $('#ubahJadwalForm input[name="idjadwal"]').val(data.id);
                    $('#ubahJadwalForm select[name="ubahharijadwal"]').val(data.hari);
                    $('#ubahJadwalForm input[name="ubahjammulai"]').val(data.jam_mulai);
                    $('#ubahJadwalForm input[name="ubahjamselesai"]').val(data.jam_selesai);

                    $('input[name="radio"]').prop('checked', false);
                    if (data.status === 'aktif') {
                        $('#radioaktif').prop('checked', true);
                    } else if (data.status === 'tidak aktif') {
                        $('#radiotidakaktif').prop('checked', true);
                    }

                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        })
    });

    $('.btnDokterSubmitEditJadwal').click(function(event) {
        event.preventDefault(); // Mencegah aksi default link

        var id = $('[name=idjadwal]').val();
        var hari = $('[name=ubahharijadwal]').val();
        var jamMulai = $('[name=ubahjammulai]').val();
        var jamSelesai = $('[name=ubahjamselesai]').val();
        var status = $('input[name="radio"]:checked').val();

        if (hari === 'Pilih Hari' || hari === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Jadwal Gagal !</label><br>Hari praktek wajib diisi.'
            })
            return;
        }

        if (jamMulai === 'Pilih Jam' || jamMulai === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Jadwal Gagal !</label><br>Jam mulai praktek wajib diisi.'
            })
            return;
        }

        if (jamSelesai === 'Pilih Jam' || jamSelesai === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Update Jadwal Gagal !</label><br>Jam selesai praktek wajib diisi.'
            })
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_jadwal_dokter")?>',
            type: 'post',
            data: {
                idJadwal: id,
                hariDokter: hari,
                jamMulaiDokter: jamMulai,
                jamSelesaiDokter: jamSelesai,
                statusJadwal: status,
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Update Jadwal Periksa Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location.reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Update Jadwal Periksa Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data', 'error');
            }
        });
    });

    $('.btnDokterHapusJadwal').click(function(event) {
        event.preventDefault();

        var id = $(this).data('id');
        Swal.fire({
            title: 'Hapus Jadwal Periksa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '<?=base_url("mycontroller/manage_jadwal_dokter")?>',
                    type: 'post',
                    data: {
                        idjadwal: id,
                        type: 'hapus_data'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: '<label style="color:green;">Hapus Jadwal Periksa Sukses !</label><br>' +
                                    response.message
                            })
                            // Reload halaman setelah 3 detik (3000ms)
                            setTimeout(function() {
                                    location
                                        .reload(); // Untuk me-reload halaman
                                },
                                1500
                            ); // Waktu delay sebelum reload (dalam milidetik)
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: '<label style="color:red;">Hapus Jadwal Periksa Gagal !</label><br>' +
                                    response.message
                            })
                            return;
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                            'error');
                    }
                });
            }
        });
    });

    /*
        JAVASCRIPT (JS) UNTUK ROLE DOKTER HALAMAN PERIKSA PASIEN
    */

    // Fungsi untuk memperbarui tombol + dan - sesuai dengan jumlah dropdown
    function updateButtons() {
        var dropdowns = $('#obat-container .input-group');
        var count = dropdowns.length;

        dropdowns.each(function(index) {
            var addButton = $(this).find('.add-obat');
            var removeButton = $(this).find('.remove-obat');

            // Jika hanya ada satu dropdown
            if (count === 1) {
                addButton.show(); // Tombol + hanya pada dropdown pertama
                removeButton.hide(); // Tidak ada tombol - jika hanya satu dropdown
            }
            // Jika ada dua atau lebih dropdown
            else {
                if (index === count - 1) {
                    // Tombol + hanya pada dropdown terakhir
                    addButton.show();
                } else {
                    // Tombol - ada di setiap dropdown selain dropdown terakhir
                    removeButton.show();
                    addButton.hide(); // Tidak ada tombol + di dropdown selain yang terakhir
                }

                // Tombol - muncul di semua dropdown yang lebih dari satu
                removeButton.show();
            }
        });
    }

    // Ketika tombol + diklik
    $(document).on('click', '.add-obat', function() {
        var newObatSelect = `
            <div class="input-group mt-2">
                <select class="form-control obat" name="obat[]">
                    <option value="">Pilih Obat</option>
                    <?php foreach($obat as $listobat){?>
                        <option value="<?=$listobat['harga']?>" data-id="<?=$listobat['id']?>"><?=$listobat['nama_obat']?> - <?=$listobat['kemasan']?> - <?=$listobat['harga']?></option>
                    <?php }?>
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger btn-sm remove-obat">-</button>
                    <button type="button" class="btn btn-success btn-sm add-obat">+</button>
                </div>
            </div>
        `;
        $('#obat-container').append(newObatSelect);
        updateButtons(); // Perbarui tombol setelah menambah dropdown
        calculateTotal(); // Hitung total setiap kali dropdown ditambah
    });

    $(document).on('click', '.remove-obat', function() {
        $(this).closest('.input-group').remove();
        updateButtons(); // Perbarui tombol setelah menghapus dropdown
        calculateTotal(); // Hitung total setelah dropdown dihapus
    });


    // Fungsi untuk menghitung total biaya obat
    function calculateTotal() {
        var totalBiayaObat = 0;

        // Ambil semua pilihan obat yang dipilih
        $('.obat').each(function() {
            var harga = $(this).val(); // Ambil harga obat
            if (harga) {
                totalBiayaObat += parseInt(harga); // Tambahkan ke total biaya obat
            }
        });

        // Menampilkan total biaya obat
        $('#biayaobat').val(totalBiayaObat);

        // Biaya Dokter tetap
        var biayaDokter = 150000; // Biaya dokter tetap

        // Total biaya periksa = biaya obat + biaya dokter
        var totalBiaya = totalBiayaObat + biayaDokter;

        // Tampilkan total biaya periksa
        $('#biayaperiksa').val(totalBiaya);
    }

    // Fungsi untuk menangani perubahan pilihan obat secara langsung
    $(document).on('change', '.obat', function() {
        calculateTotal(); // Setiap kali pilihan obat berubah, hitung ulang total biaya
    });

    // Perbarui tombol dan hitung total saat halaman dimuat pertama kali
    updateButtons();
    calculateTotal();

    /*
    JAVASCRIPT (JS) UNTUK ROLE DOKTER SUBMIT PERIKSA PASIEN
    */
    $('.btnDokterSubmitPeriksaPasien').click(function(event) {
        event.preventDefault();

        // Ambil nilai input lainnya
        var iddaftarpoli = $('[name=iddaftarpoli]').val();
        var tanggal = $('[name=tanggal]').val();
        var catatan = $('[name=catatan]').val();
        var biayaperiksa = $('[name=biayaperiksa]').val();

        // Ambil data-id dari setiap dropdown obat yang dipilih
        var obatIds = [];
        $('.obat').each(function() {
            var selectedOption = $(this).find('option:selected');
            var obatId = selectedOption.data('id');
            if (obatId) {
                obatIds.push(obatId); // Simpan id obat ke dalam array
            }
        });

        // Jika ingin mengirim data ini ke server menggunakan AJAX
        $.ajax({
            url: '<?=base_url("mycontroller/manage_periksa_pasien")?>', // Ganti dengan URL endpoint server Anda
            method: 'POST',
            data: {
                iddaftarpoli: iddaftarpoli,
                tanggal: tanggal,
                catatan: catatan,
                biayaperiksa: biayaperiksa,
                obat_ids: obatIds, // Kirimkan array obatIds
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Periksa Pasien Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            window.location.href = '<?=base_url("home")?>';
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Periksa Pasien Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function(xhr, status, error) {
                console.log('Terjadi kesalahan:', error);
            }
        });
    });


    /*
        JAVASCRIPT (JS) UNTUK ROLE DOKTER HALAMAN EDIT PERIKSA PASIEN (DETAIL PERIKSA)
    */

    $('.btnDokterSubmitEditPeriksaPasien').click(function(event) {
        event.preventDefault();

        // Ambil nilai input lainnya
        var iddaftarpoli = $('[name=iddaftarpoli]').val();
        var tanggal = $('[name=tanggal]').val();
        var catatan = $('[name=catatan]').val();
        var biayaperiksa = $('[name=biayaperiksa]').val();

        // Ambil data-id dari setiap dropdown obat yang dipilih
        var obatIds = [];
        $('.obat').each(function() {
            var selectedOption = $(this).find('option:selected');
            var obatId = selectedOption.data('id');
            if (obatId) {
                obatIds.push(obatId); // Simpan id obat ke dalam array
            }
        });

        // Jika ingin mengirim data ini ke server menggunakan AJAX
        $.ajax({
            url: '<?=base_url("mycontroller/manage_periksa_pasien")?>', // Ganti dengan URL endpoint server Anda
            method: 'POST',
            data: {
                iddaftarpoli: iddaftarpoli,
                tanggal: tanggal,
                catatan: catatan,
                biayaperiksa: biayaperiksa,
                obat_ids: obatIds, // Kirimkan array obatIds
                type: 'ubah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Periksa Pasien Sukses !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            window.location.href = '<?=base_url("home")?>';
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Periksa Pasien Gagal !</label><br>' +
                            response.message
                    })
                    return;
                }
            },
            error: function(xhr, status, error) {
                console.log('Terjadi kesalahan:', error);
            }
        });
    });



    /*
        JAVASCRIPT (JS) UNTUK ROLE PASIEN HALAMAN DAFTAR POLI
    */

    // Ketika memilih poli
    $('#polidaftar').change(function() {
        var idPoli = $(this).val();

        // Cek apakah id_poli terpilih
        if (idPoli !== "") {
            $.ajax({
                url: '<?= base_url("mycontroller/get_data_jadwal_dokter") ?>', // Ganti dengan URL controller yang sesuai
                type: 'POST',
                data: {
                    id_poli: idPoli
                },
                dataType: 'json',
                success: function(data) {
                    // Kosongkan jadwal daftar sebelumnya
                    $('#jadwaldaftar').html('<option value="">Pilih Jadwal</option>');
                    if (data.length > 0) {

                        // Menampilkan jadwal untuk poli yang dipilih
                        $.each(data, function(index, jadwal) {
                            // Tambahkan jadwal ke select jadwal
                            $('#jadwaldaftar').append('<option value="' + jadwal
                                .id + '">Dr. ' + jadwal.nama + ' | ' + jadwal
                                .hari +
                                ' | ' + jadwal
                                .jam_mulai + ' - ' + jadwal.jam_selesai +
                                '</option>');
                        });
                    } else {
                        // Jika tidak ada data yang ditemukan
                        $('#jadwaldaftar').html(
                            '<option value="">Jadwal tidak tersedia</option>');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data jadwal.');
                }
            });
        } else {
            // Kosongkan daftar jadwal jika tidak ada poli yang dipilih
            $('#jadwaldaftar').html('<option value="">Pilih Poli terlebih dahulu</option>');
        }
    });

    $('.btnPasienSubmitDaftarPoli').click(function(event) {
        event.preventDefault();

        var idjadwal = $('[name=jadwaldaftar]').val();
        var keluhan = $('[name=keluhandaftar]').val();

        if (idjadwal === '') {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Poli Gagal !</label><br>Jadwal periksa wajib diisi.'
            });
            return;
        }

        if (keluhan.length === 0) {
            Toast.fire({
                icon: 'error',
                title: '<label style="color:red;">Daftar Poli Gagal !</label><br>Keluhan wajib diisi.'
            });
            return;
        }

        $.ajax({
            url: '<?=base_url("mycontroller/manage_daftar_poli")?>',
            type: 'post',
            data: {
                idjadwal: idjadwal,
                keluhan: keluhan,
                type: 'tambah_data'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: '<label style="color:green;">Daftar Poli Berhasil !</label><br>' +
                            response.message
                    })
                    // Reload halaman setelah 3 detik (3000ms)
                    setTimeout(function() {
                            location
                                .reload(); // Untuk me-reload halaman
                        },
                        1500
                    ); // Waktu delay sebelum reload (dalam milidetik)
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: '<label style="color:red;">Daftar Poli Gagal !</label><br>' +
                            response.message
                    });
                    return;
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data',
                    'error');
            }
        });
    });

    $('.btnPasienDetailPeriksa').click(function(event) {
        event.preventDefault();

        var id_daftar_poli = $(this).data('id');

        $.ajax({
            url: '<?=base_url("mycontroller/get_detail_periksa_pasien")?>',
            type: 'post',
            data: {
                daftar_poli_id: id_daftar_poli
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    // Jika data ditemukan, isi modal dengan data yang diterima
                    $('#poli_detail').text(data.detail_periksa.nama_poli);
                    $('#dokter_detail').text(data.detail_periksa.dokter_nama);
                    $('#tanggal_detail').text(data.detail_periksa.tgl_periksa);
                    $('#keluhan_detail').text(data.detail_periksa.keluhan);
                    $('#catatan_dokter_detail').text(data.detail_periksa.catatan);
                    $('#biaya_periksa_detail').text(data.detail_periksa.biaya_periksa);

                    // Menampilkan obat yang diberikan
                    var obatList = '';
                    $.each(data.obat, function(index, obat) {
                        obatList += '<li>' + obat.nama_obat + ' - ' + obat.harga +
                            ' (' + obat.kemasan + ')</li>';
                    });
                    $('#obat_detail').html(obatList);

                    // Tampilkan modal
                    $('#modal-detailperiksa').modal('show');
                } else {
                    alert('Data not found');
                }
            },
            error: function() {
                alert('Kesalahan dalam mengirim data');
            }
        })
    });






});
</script>
</body>

</html>