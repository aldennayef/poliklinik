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
                            <h3 class="card-title"><strong>Riwayat Periksa Pasien Dr. <?=$user['nama']?></strong></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="periksaPasien" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. RM</th>
                                        <th>Pasien</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1; foreach($list_riwayat_pasien as $lrp){?>
                                    <tr>
                                        <td><?=$x++;?></td>
                                        <td><?=$lrp['no_rm']?></td>
                                        <td><?=$lrp['pasien_nama']?></td>
                                        <td>
                                            <a href="<?=base_url('detail_riwayat_periksa_pasien/'.$lrp['pasien_id'])?>">
                                                <button type="button" class="btn btn-success btn-sm">
                                                    <i class="fa fa-info"></i> Riwayat Periksa</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
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