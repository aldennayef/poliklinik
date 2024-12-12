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
                        <li class="breadcrumb-item active">Data Obat</li>
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
                    <a class="btn btn-app bg-success" data-toggle="modal" data-target="#modal-tambahobat">
                        <i class="fas fa-medkit"></i> Tambah Obat
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Obat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($obat as $dataobat){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$dataobat['nama_obat']?></td>
                                        <td><?=$dataobat['kemasan']?></td>
                                        <td><?=$dataobat['harga']?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btnAdminEditObat"
                                                data-id="<?=$dataobat['id']?>" data-toggle="modal"
                                                data-target="#modal-ubahobat"><i class="fa fa-edit"></i> Edit</button> |
                                            <button type="button" class="btn btn-danger btn-sm btnAdminHapusObat"
                                                data-id="<?=$dataobat['id']?>"><i class="fa fa-trash"></i>
                                                Hapus</button>
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


<!-- MODAL FORM TAMBAH OBAT-->
<div class="modal fade" id="modal-tambahobat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tambah Obat Form -->
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="namaobat">Nama Obat</label>
                        <input type="text" class="form-control" id="tambahnamaobat" name="tambahnamaobat"
                            placeholder="Masukkan Nama Obat">
                    </div>
                    <div class="form-group">
                        <label for="kemasanobat">Kemasan</label>
                        <input type="text" class="form-control" id="tambahkemasanobat" name="tambahkemasanobat"
                            placeholder="Masukkan Kemasan Obat">
                    </div>
                    <div class="form-group">
                        <label for="hargaobat">Harga</label>
                        <input type="number" class="form-control" id="tambahhargaobat" name="tambahhargaobat"
                            placeholder="Masukkan Harga Obat">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitObat">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- MODAL FORM EDIT OBAT-->
<div class="modal fade" id="modal-ubahobat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ubah Obat Form -->
                <form class="form-horizontal" id="ubahObatForm">
                    <input type="hidden" class="form-control" id="idobat" name="idobat">
                    <div class="form-group">
                        <label for="namaobat">Nama Obat</label>
                        <input type="text" class="form-control" id="ubahnamaobat" name="ubahnamaobat"
                            placeholder="Masukkan Nama Obat">
                    </div>
                    <div class="form-group">
                        <label for="kemasanobat">Kemasan</label>
                        <input type="text" class="form-control" id="ubahkemasanobat" name="ubahkemasanobat"
                            placeholder="Masukkan Kemasan Obat">
                    </div>
                    <div class="form-group">
                        <label for="hargaobat">Harga</label>
                        <input type="number" class="form-control" id="ubahhargaobat" name="ubahhargaobat"
                            placeholder="Masukkan Harga Obat">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitEditObat">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->