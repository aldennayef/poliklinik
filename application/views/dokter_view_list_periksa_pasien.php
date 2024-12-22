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
                        <li class="breadcrumb-item active">List Periksa Pasien</li>
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
                            <h3 class="card-title"><strong>Daftar Pasien Dr. <?=$user['nama']?></strong></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="periksaPasien" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. RM</th>
                                        <th>Pasien</th>
                                        <th>No. Antrian</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Keluhan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1; foreach($list_pasien as $lp){?>
                                    <tr>
                                        <td><?=$x++;?></td>
                                        <td><?=$lp['no_rm']?></td>
                                        <td><?=$lp['pasien_nama']?></td>
                                        <td><?=$lp['no_antrian']?></td>
                                        <td><?=$lp['tanggal']?></td>
                                        <td><?=$lp['hari']?></td>
                                        <td><?=$lp['jam_mulai']?> - <?=$lp['jam_selesai']?></td>
                                        <td><?=$lp['keluhan']?></td>
                                        <td>
                                            <?php if($lp['status']==='Belum diperiksa'){?>
                                            <a href="<?=base_url('periksa_pasien/'.$lp['daftar_poli_id'])?>"><button
                                                    type="button" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-stethoscope"></i> Periksa</button></a>
                                            <?php } else{?>
                                            <a href="<?=base_url('edit_periksa_pasien/'.$lp['daftar_poli_id'])?>"><button
                                                    type="button" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-info"></i> Detail Periksa</button>
                                                <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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