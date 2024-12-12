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
                        <li class="breadcrumb-item active">Profile</li>
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
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?=base_url('assets/dist/img/user4-128x128.jpg')?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Dokter <?=$user['nama']?></h3>

                            <p class="text-muted text-center"><?=$user['nama_poli']?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Alamat</b> <a class="float-right"><?=$user['alamat']?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor HP</b> <a class="float-right"><?=$user['no_hp']?></a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block btnDokterUpdateProfile" data-id="<?=$user['id']?>"><b>Update
                                    Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6" style="display: none;" id="profileForm">
                    <!-- Update Profile Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="updateProfileForm">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" id="idProfile" name="idProfile">
                                    <label for="inputNama3" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namaProfile" name="namaProfile"
                                            placeholder="Masukkan Nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAlamat3" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamatProfile" name="alamatProfile"
                                            placeholder="Masukkan Alamat (Kab/Kota)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNomorHP3" class="col-sm-2 col-form-label">Nomor HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nohpProfile" name="nohpProfile"
                                            placeholder="Masukkan nomor hp">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Poli</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="poliProfile" name="poliProfile">
                                            <option>Pilih Tempat Poli</option>
                                            <?php foreach($poli as $listpoli){?>
                                            <option value="<?=$listpoli['id']?>"><?=$listpoli['nama_poli']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btnDokterSubmitUpdateProfile">Update</button>
                                <button type="submit"
                                    class="btn btn-default float-right btnDokterCancelUpdateProfile">Cancel</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->