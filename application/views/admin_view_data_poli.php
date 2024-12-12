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
                        <li class="breadcrumb-item active">Data Poli</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <a class="btn btn-app bg-success" data-toggle="modal" data-target="#modal-tambahpoli">
                        <i class="fas fa-clinic-medical"></i> Tambah Poli
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Poli</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Poli</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($poli as $datapoli){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$datapoli['nama_poli']?></td>
                                        <td><?=$datapoli['keterangan']?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btnAdminEditPoli" data-id="<?=$datapoli['id']?>" data-toggle="modal" data-target="#modal-ubahpoli"><i class="fa fa-edit"></i> Edit</button> |
                                            <button type="button" class="btn btn-danger btn-sm btnAdminHapusPoli" data-id="<?=$datapoli['id']?>"><i class="fa fa-trash"></i> Hapus</button>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- MODAL FORM TAMBAH POLI-->
<div class="modal fade" id="modal-tambahpoli">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Poli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tambah Poli Form -->
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="namapoli">Nama Poli</label>
                        <input type="text" class="form-control" id="tambahnamapoli" name="tambahnamapoli"
                            placeholder="Masukkan Nama Poli">
                    </div>
                    <div class="form-group">
                        <label for="keteranganpoli">Keterangan</label>
                        <input type="text" class="form-control" id="tambahketeranganpoli" name="tambahketeranganpoli"
                            placeholder="Masukkan Keterangan">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitPoli">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- MODAL FORM EDIT POLI-->
<div class="modal fade" id="modal-ubahpoli">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Poli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ubah Poli Form -->
                <form class="form-horizontal" id="ubahPoliForm">
                    <input type="hidden" class="form-control" id="idpoli" name="idpoli">
                    <div class="form-group">
                        <label for="namapoli">Nama Poli</label>
                        <input type="text" class="form-control" id="ubahnamapoli" name="ubahnamapoli"
                            placeholder="Masukkan Nama Poli">
                    </div>
                    <div class="form-group">
                        <label for="keteranganpoli">Keterangan</label>
                        <input type="text" class="form-control" id="ubahketeranganpoli" name="ubahketeranganpoli"
                            placeholder="Masukkan Keterangan">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitEditPoli">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->