<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?=base_url('pendaftaran')?>"><strong style="color:red;">POLI</strong>KLINIK</a><br>
            <a href="<?=base_url('pendaftaran')?>">SEHAT<strong style="color:Red;">BERSAMA</strong></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silakan isi data diri anda</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="namaDaftar" placeholder="Masukkan Nama">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-badge"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="alamatDaftar" placeholder="Masukkan Alamat (KOTA)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-home"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="noktpDaftar" placeholder="Masukkan Nomor KTP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-address-card"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nohpDaftar" placeholder="Masukkan Nomor HP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-info btn-block btnDaftarAkun">Daftar</button>
                        </div>
                        <div class="col-4"></div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="<?=base_url('home')?>" class="btn btn-block btn-success">
                        Login Akun
                    </a>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->