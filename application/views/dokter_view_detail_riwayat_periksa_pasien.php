<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Poliklinik Sehat Bersama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url('')?>">Home</a></li>
                        <li class="breadcrumb-item active">Riwayat Periksa Pasien</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Riwayat Periksa Pasien No. RM
                                    <?=$row_detail_riwayat_pasien['no_rm']?>
                                    (<?=$row_detail_riwayat_pasien['nama']?>)</strong></h3>
                        </div>
                        <div class="card-body">
                            <table id="periksaPasien" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keluhan</th>
                                        <th>Tanggal Daftar Periksa</th>
                                        <th>Tanggal Diperiksa</th>
                                        <th>Catatan</th>
                                        <th>Obat</th>
                                        <th>Biaya Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 1; foreach ($result_detail_riwayat_pasien as $rdrp): ?>
                                    <tr>
                                        <td><?=$x++;?></td>
                                        <td><?=$rdrp['keluhan']?></td>
                                        <td><?=$rdrp['tanggal_daftar_poli']?></td>
                                        <td><?=$rdrp['tgl_periksa']?></td>
                                        <td><?=$rdrp['catatan']?></td>
                                        <td><?=$rdrp['obat_list']?></td>
                                        <!-- Menampilkan daftar obat yang digabungkan -->
                                        <td><?=$rdrp['biaya_periksa']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



</div>