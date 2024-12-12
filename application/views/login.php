<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?=base_url('home')?>"><strong style="color:red;">POLI</strong>KLINIK</a><br>
            <a href="<?=base_url('home')?>">SEHAT<strong style="color:Red;">BERSAMA</strong></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silakan melakukan login terlebih dahulu</p>

                <form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="usernameLogin" placeholder="Masukkan Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="passwordLogin" placeholder="Masukkan Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-block btnLoginAkun">Login</button>
                        </div>
                        <div class="col-4"></div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="<?=base_url('pendaftaran')?>" class="btn btn-block btn-info">
                        Daftar Akun
                    </a>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->