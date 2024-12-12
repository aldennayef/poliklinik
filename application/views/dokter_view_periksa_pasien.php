<style>
.input-group {
    margin-bottom: 10px;
    /* Memberikan jarak di bawah dropdown */
}

.input-group .btn {
    margin-left: 5px;
    /* Memberikan jarak di kiri tombol */
}

}
</style>
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
                        <li class="breadcrumb-item active">Periksa Pasien</li>
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
                    <!-- Periksa Pasien Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Periksa Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="periksaPasienForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="iddaftarpoli" value="<?=$pasien['daftar_poli_id']?>" readonly>
                                        <div class="form-group">
                                            <label for="rekammedis">No. Rekam Medis</label>
                                            <input type="text" class="form-control" name="norm"
                                                value="<?=$pasien['no_rm']?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="namapasien">Nama Pasien</label>
                                            <input type="text" class="form-control" name="namapasien"
                                                value="<?=$pasien['pasien_nama']?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jammulai">Tanggal</label>
                                    <input type="datetime-local" class="form-control" id="tanggal"
                                        name="tanggal" placeholder="Masukkan Jam Mulai">
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan Periksa</label>
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                                <div id="obat-container">
                                    <div class="input-group mt-2">
                                        <select class="form-control obat" name="obat[]">
                                            <option value="">Pilih Obat</option>
                                            <?php foreach($obat as $listobat){?>
                                            <option value="<?=$listobat['harga']?>"
                                                data-id="<?=$listobat['id']?>"><?=$listobat['nama_obat']?> -
                                                <?=$listobat['kemasan']?> - <?=$listobat['harga']?></option>
                                            <?php }?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-sm remove-obat"
                                                style="display:none">-</button>
                                            <button type="button" class="btn btn-success btn-sm add-obat"
                                                style="margin-left: 5px;">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="biayaobat">Biaya Obat</label>
                                    <input type="text" class="form-control" name="biayaobat" id="biayaobat" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="biayadokter">Biaya Dokter</label>
                                    <input type="text" class="form-control" name="biayadokter" value="150000" disabled>
                                    <!-- Biaya tetap dokter -->
                                </div>

                                <div class="form-group">
                                    <label for="biayaperiksa">Total Biaya Periksa</label>
                                    <input type="text" class="form-control" name="biayaperiksa" id="biayaperiksa"
                                        readonly>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btnDokterSubmitPeriksaPasien">Submit</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
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