<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=base_url('assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <?php if($this->session->userdata('role')==='admin'){?>
                <a href="#" class="d-block"><?=$user['username']?></a>
                <?php }else{?>
                <a href="#" class="d-block"><?=$user['nama']?></a>
                <?php }?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?=base_url('')?>" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if($this->session->userdata('role')==='admin'){?>
                <li class="nav-header">Data Master</li>
                <li class="nav-item">
                    <a href="<?=base_url('data_dokter')?>" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Data Dokter
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('data_pasien')?>" class="nav-link">
                        <i class="nav-icon fas fa-hospital-user"></i>
                        <p>
                            Data Pasien
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('data_poli')?>" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Data Poli
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('data_obat')?>" class="nav-link">
                        <i class="nav-icon fas fa-medkit"></i>
                        <p>
                            Data Obat
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <?php }?>
                <?php if($this->session->userdata('role')==='dokter'){?>
                <li class="nav-header">Fitur</li>
                <li class="nav-item">
                    <a href="<?=base_url('profilku')?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('jadwal_periksa')?>" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Jadwal Periksa
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('list_periksa_pasien')?>" class="nav-link">
                        <i class="nav-icon fas fa-hospital-user"></i>
                        <p>
                            Periksa Pasien
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('riwayat_periksa_pasien')?>" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Riwayat Periksa Pasien
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <?php }?>
                <?php if($this->session->userdata('role')==='pasien'){?>
                <li class="nav-header">Layanan</li>
                <li class="nav-item">
                    <a href="<?=base_url('daftar_poli')?>" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Daftar Poli
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <?php }?>
                <li class="nav-header">Autentikasi</li>
                <li class="nav-item">
                    <a href="<?=base_url('mycontroller/logout')?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Log Out
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>