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
                        <li class="breadcrumb-item active">Jadwal Periksa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-6">
                    <!-- Jadwal Periksa Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Atur Jadwal Periksa</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="jadwalPeriksaForm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hari Praktek/Periksa</label>
                                    <select class="form-control" id="hariJadwal" name="hariJadwal">
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jammulai">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jamMulaiJadwal" name="jamMulaiJadwal"
                                        placeholder="Masukkan Jam Mulai">
                                </div>
                                <div class="form-group">
                                    <label for="jamselesai">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jamSelesaiJadwal"
                                        name="jamSelesaiJadwal" placeholder="Masukkan Jam Selesai">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btnDokterSubmitJadwal">Submit</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal Praktek/Periksa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($jadwal as $datajadwal){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$datajadwal['hari']?></td>
                                        <td><?=$datajadwal['jam_mulai']?></td>
                                        <td><?=$datajadwal['jam_selesai']?></td>
                                        <td>
                                            <!-- Toggle berdasarkan status -->
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    class="custom-control-input btnDokterToggleJadwal"
                                                    id="statusSwitch<?=$datajadwal['id']?>"
                                                    <?= ($datajadwal['status'] == 'aktif') ? 'checked' : ''; ?>>
                                                <label class="custom-control-label"
                                                    for="statusSwitch<?=$datajadwal['id']?>">Aktif</label>
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-info btn-sm btnDokterEditJadwal"
                                                data-id="<?=$datajadwal['id']?>" data-toggle="modal"
                                                data-target="#modal-ubahjadwal"><i class="fa fa-edit"></i> Edit</button>
                                        </td> -->
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

<!-- MODAL FORM EDIT JADWAL-->
<div class="modal fade" id="modal-ubahjadwal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Ubah Jadwal Form -->
                <form class="form-horizontal" id="ubahJadwalForm">
                    <input type="hidden" class="form-control" id="idjadwal" name="idjadwal">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hari Praktek/Periksa</label>
                        <select class="form-control" id="ubahharijadwal" name="ubahharijadwal">
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jammulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="ubahjammulai" name="ubahjammulai"
                            placeholder="Masukkan Jam Mulai">
                    </div>
                    <div class="form-group">
                        <label for="jamselesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="ubahjamselesai" name="ubahjamselesai"
                            placeholder="Masukkan Jam Selesai">
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnDokterSubmitEditJadwal">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->