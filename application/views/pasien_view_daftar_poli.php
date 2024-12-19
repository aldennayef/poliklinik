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
                    <!-- Daftar Poli Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Poli</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="daftarPoliForm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="norm">Nomor Rekam Medis</label>
                                    <input type="text" class="form-control" id="norm" name="norm"
                                        value="<?=$user['no_rm']?>" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pilih Poli</label>
                                            <select class="form-control" id="polidaftar" name="polidaftar">
                                                <option value="">Pilih Poli</option>
                                                <?php foreach($poli as $datapoli){?>
                                                <option value="<?=$datapoli['id']?>"><?=$datapoli['nama_poli']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="jadwal">Jadwal</label>
                                            <select class="form-control" id="jadwaldaftar" name="jadwaldaftar">
                                                <option value="">Pilih Jadwal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keluhan">Keluhan</label>
                                    <textarea class="form-control" id="keluhandaftar" name="keluhandaftar"
                                        placeholder="Apa Keluhan Anda ?"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btnPasienSubmitDaftarPoli">Submit</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Daftar Poli</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datamaster" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Poli</th>
                                        <th>Dokter</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Nomor Antrian</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($daftar_poli as $daftarpoli){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$daftarpoli['nama_poli']?></td>
                                        <td><?=$daftarpoli['dokter_nama']?></td>
                                        <td><?=$daftarpoli['hari']?></td>
                                        <td><?=$daftarpoli['tanggal']?></td>
                                        <td><?=$daftarpoli['jam_mulai']?></td>
                                        <td><?=$daftarpoli['jam_selesai']?></td>
                                        <td><?=$daftarpoli['no_antrian']?></td>
                                        <td><button type="button"
                                                class="btn btn-info btn-sm"><?=$daftarpoli['status']?></button></td>
                                        <?php if($daftarpoli['status']==='Sudah diperiksa'){?>
                                        <td><button type="button" class="btn btn-info btn-sm btnPasienDetailPeriksa"
                                                data-toggle="modal" data-target="#modal-detailperiksa"
                                                data-id="<?=$daftarpoli['daftar_poli_id']?>">Detail
                                                Periksa</button></td>
                                        <?php }else{ ?>
                                        <td><button type="button" class="btn btn-danger btn-sm">Tidak Tersedia</button>
                                        </td>
                                        <?php }?>
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


<!-- MODAL FORM DETAIL PERIKSA-->
<div class="modal fade" id="modal-detailperiksa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Periksa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Periksa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered" id="detailperiksa">
                            <tbody>
                                <tr>
                                    <th>Poli</th>
                                    <td id="poli_detail"></td> <!-- Poli akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Dokter</th>
                                    <td id="dokter_detail"></td> <!-- Dokter akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td id="tanggal_detail"></td> <!-- Tanggal akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <td id="keluhan_detail"></td> <!-- Keluhan akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Obat</th>
                                    <td id="obat_detail"></td> <!-- Obat akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Catatan Dokter</th>
                                    <td id="catatan_dokter_detail"></td> <!-- Catatan Dokter akan ditampilkan di sini -->
                                </tr>
                                <tr>
                                    <th>Biaya Periksa</th>
                                    <td id="biaya_periksa_detail"></td> <!-- Biaya Periksa akan ditampilkan di sini -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->