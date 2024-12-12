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
                        <li class="breadcrumb-item active">Data Dokter</li>
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
                    <a class="btn btn-app bg-success" data-toggle="modal" data-target="#modal-tambahdokter">
                        <i class="fas fa-stethoscope"></i> Tambah Dokter
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokter</th>
                                        <th>Alamat</th>
                                        <th>Nomor HP</th>
                                        <th>Poli</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($dokter as $datadokter){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$datadokter['nama']?></td>
                                        <td><?=$datadokter['alamat']?></td>
                                        <td><?=$datadokter['no_hp']?></td>
                                        <td><?=$datadokter['nama_poli']?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btnAdminEditDokter"
                                                data-id="<?=$datadokter['id']?>" data-toggle="modal"
                                                data-target="#modal-ubahdokter"><i class="fa fa-edit"></i> Edit</button> |
                                            <button type="button" class="btn btn-danger btn-sm btnAdminHapusDokter"
                                                data-id="<?=$datadokter['id']?>"><i class="fa fa-trash"></i>
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


<!-- MODAL FORM TAMBAH DOKTER-->
<div class="modal fade" id="modal-tambahdokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tambah Dokter Form -->
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="namadokter">Nama Dokter</label>
                        <input type="text" class="form-control" id="tambahnamadokter" name="tambahnamadokter"
                            placeholder="Masukkan Nama Dokter">
                    </div>
                    <div class="form-group">
                        <label for="alamatdokter">Alamat</label>
                        <input type="text" class="form-control" id="tambahalamatdokter" name="tambahalamatdokter"
                            placeholder="Masukkan Alamat Dokter">
                    </div>
                    <div class="form-group">
                        <label for="nohpdokter">Nomor HP</label>
                        <input type="number" class="form-control" id="tambahnohpdokter" name="tambahnohpdokter"
                            placeholder="Masukkan Nomor HP Dokter">
                    </div>
                    <div class="form-group">
                        <label>Poli</label>
                        <select class="form-control" id="tambahpolidokter" name="tambahpolidokter">
                            <option>Pilih Tempat Poli</option>
                            <?php foreach($poli as $listpoli){?>
                            <option value="<?=$listpoli['id']?>"><?=$listpoli['nama_poli']?></option>
                            <?php }?>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitDokter">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- MODAL FORM EDIT DOKTER-->
<div class="modal fade" id="modal-ubahdokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ubah Dokter Form -->
                <form class="form-horizontal" id="ubahDokterForm">
                    <input type="hidden" class="form-control" id="iddokter" name="iddokter">
                    <div class="form-group">
                        <label for="namadokter">Nama Dokter</label>
                        <input type="text" class="form-control" id="ubahnamadokter" name="ubahnamadokter"
                            placeholder="Masukkan Nama Dokter">
                    </div>
                    <div class="form-group">
                        <label for="alamatdokter">Alamat</label>
                        <input type="text" class="form-control" id="ubahalamatdokter" name="ubahalamatdokter"
                            placeholder="Masukkan Alamat Dokter">
                    </div>
                    <div class="form-group">
                        <label for="nohpdokter">Nomor HP</label>
                        <input type="number" class="form-control" id="ubahnohpdokter" name="ubahnohpdokter"
                            placeholder="Masukkan Nomor HP Dokter">
                    </div>
                    <div class="form-group">
                        <label>Poli</label>
                        <select class="form-control" id="ubahpolidokter" name="ubahpolidokter">
                            <option>Pilih Tempat Poli</option>
                            <?php foreach($poli as $listpoli){?>
                            <option value="<?=$listpoli['id']?>"><?=$listpoli['nama_poli']?></option>
                            <?php }?>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnAdminSubmitEditDokter">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->