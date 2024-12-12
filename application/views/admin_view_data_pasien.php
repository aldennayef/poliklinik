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
                        <li class="breadcrumb-item active">Data Pasien</li>
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
                    <a class="btn btn-app bg-success" data-toggle="modal" data-target="#modal-tambahpasien">
                        <i class="fas fa-hospital-user"></i> Tambah Pasien
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Rekam Medis</th>
                                        <th>Nama Pasien</th>
                                        <th>Alamat</th>
                                        <th>Nomor KTP</th>
                                        <th>Nomor HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($pasien as $datapasien){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$datapasien['no_rm']?></td>
                                        <td><?=$datapasien['nama']?></td>
                                        <td><?=$datapasien['alamat']?></td>
                                        <td><?=$datapasien['no_ktp']?></td>
                                        <td><?=$datapasien['no_hp']?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btnAdminEditPasien"
                                                data-id="<?=$datapasien['id']?>" data-toggle="modal"
                                                data-target="#modal-ubahpasien"><i class="fa fa-edit"></i> Edit</button>
                                            |
                                            <button type="button" class="btn btn-danger btn-sm btnAdminHapusPasien"
                                                data-id="<?=$datapasien['id']?>"><i class="fa fa-trash"></i>
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



<!-- MODAL FORM TAMBAH PASIEN-->
<div class="modal fade" id="modal-tambahpasien">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tambah Pasien Form -->
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="namapasien">Nama Pasien</label>
                        <input type="text" class="form-control" id="tambahnamapasien" name="tambahnamapasien"
                            placeholder="Masukkan Nama Pasien">
                    </div>
                    <div class="form-group">
                        <label for="alamatpasien">Alamat</label>
                        <input type="text" class="form-control" id="tambahalamatpasien" name="tambahalamatpasien"
                            placeholder="Masukkan Alamat Pasien">
                    </div>
                    <div class="form-group">
                        <label for="noktppasien">Nomor KTP</label>
                        <input type="number" class="form-control" id="tambahnoktppasien" name="tambahnoktppasien"
                            placeholder="Masukkan Nomor KTP Pasien">
                    </div>
                    <div class="form-group">
                        <label for="nohppasien">Nomor HP</label>
                        <input type="number" class="form-control" id="tambahnohppasien" name="tambahnohppasien"
                            placeholder="Masukkan Nomor HP Pasien">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitPasien">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- MODAL FORM EDIT PASIEN-->
<div class="modal fade" id="modal-ubahpasien">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ubah Pasien Form -->
                <form class="form-horizontal" id="ubahPasienForm">
                    <input type="hidden" class="form-control" id="idpasien" name="idpasien">
                    <div class="form-group">
                        <label for="normpasien">Nomor Rekam Medis Pasien</label>
                        <input type="text" class="form-control" id="ubahnormpasien" name="ubahnormpasien"
                            placeholder="Masukkan Nomor Rekam Medis Pasien" disabled>
                    </div>
                    <div class="form-group">
                        <label for="namapasien">Nama Pasien</label>
                        <input type="text" class="form-control" id="ubahnamapasien" name="ubahnamapasien"
                            placeholder="Masukkan Nama Pasien">
                    </div>
                    <div class="form-group">
                        <label for="alamatpasien">Alamat</label>
                        <input type="text" class="form-control" id="ubahalamatpasien" name="ubahalamatpasien"
                            placeholder="Masukkan Alamat Pasien">
                    </div>
                    <div class="form-group">
                        <label for="noktppasien">Nomor KTP</label>
                        <input type="number" class="form-control" id="ubahnoktppasien" name="ubahnoktppasien"
                            placeholder="Masukkan Nomor KTP Pasien">
                    </div>
                    <div class="form-group">
                        <label for="nohppasien">Nomor HP</label>
                        <input type="number" class="form-control" id="ubahnohppasien" name="ubahnohppasien"
                            placeholder="Masukkan Nomor HP Pasien">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitEditPasien">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->