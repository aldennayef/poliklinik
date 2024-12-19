<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mycontroller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('modelku');
    }

    /* 
    - HANDLE SISTEM JIKA TIDAK ADA SESSION YANG AKTIF, MAKA AKAN REDIRECT KE HALAMAN LOGIN
    - HANDLE SISTEM UNTUK MENGARAHKAN USER KE HALAMAN SESUAI ROLE NYA
    */
	public function index()
	{
        $session = $this->session->userdata('role');
        if(!$session){
            $comp['title'] = "Poliklinik Sehat Bersama | Login";
            $this->load->view('template/navbar',$comp);
            $this->load->view('login');
            $this->load->view('template/footer');
        }
        elseif($session==='admin'){
            $comp['title'] = "Poliklinik Sehat Bersama | Pasien";
            $comp['user'] = $this->modelku->get_where_data('admin', ['id'=>$this->session->userdata('id')])->row_array();
            $comp['pasien'] = count($this->modelku->get_data('pasien'));
            $comp['dokter'] = count($this->modelku->get_data('dokter'));
            $comp['poli'] = count($this->modelku->get_data('poli'));
            $comp['obat'] = count($this->modelku->get_data('obat'));
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dashboard_admin');
            $this->load->view('template/footer');
        }
        elseif($session==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Dokter";
            $comp['user'] = $this->modelku->get_where_data('dokter',['id'=>$this->session->userdata('id')])->row_array();
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dashboard_dokter');
            $this->load->view('template/footer');
        }
        else{
            $comp['title'] = "Poliklinik Sehat Bersama | Pasien";
            $comp['user'] = $this->modelku->get_where_data('pasien',['id'=>$this->session->userdata('id')])->row_array();
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dashboard_pasien');
            $this->load->view('template/footer');
        }
	}
    // END

    // DIRECT PASIEN KE HALAMAN PENDAFTARAN
    public function hal_daftar(){
        if(!$this->session->userdata('role')){
            $comp['title'] = "Poliklinik Sehat Bersama | Daftar";
            $this->load->view('template/navbar',$comp);
            $this->load->view('daftar');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }
    // END


    /*  ===============================      ADMIN       =====================================
        ======================================================================================
    */

    /* 
    - HALAMAN DIRECT KHUSUS ROLE "ADMIN" KE HALAMAN DATA DOKTER, PASIEN, POLI, DAN OBAT
    - JIKA ROLE SELAIN "ADMIN" MENCOBA MASUK, MAKA REDIRECT KE CONTROLLER "HOME" (MYCONTROLLER)
    */
    public function hal_manage_data_dokter(){
        if($this->session->userdata('role')==='admin'){
            $comp['title'] = "Poliklinik Sehat Bersama | Data Dokter";
            $comp['user'] = $this->modelku->get_where_data('admin',['id'=>$this->session->userdata('id')])->row_array();
            $comp['dokter'] = $this->modelku->get_data_dokter_and_poli();
            $comp['poli'] = $this->modelku->get_data('poli');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('admin_view_data_dokter');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_manage_data_pasien(){
        if($this->session->userdata('role')==='admin'){
            $comp['title'] = "Poliklinik Sehat Bersama | Data Pasien";
            $comp['user'] = $this->modelku->get_where_data('admin',['id'=>$this->session->userdata('id')])->row_array();
            $comp['pasien'] = $this->modelku->get_data('pasien');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('admin_view_data_pasien');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_manage_data_poli(){
        if($this->session->userdata('role')==='admin'){
            $comp['title'] = "Poliklinik Sehat Bersama | Data Poli";
            $comp['user'] = $this->modelku->get_where_data('admin',['id'=>$this->session->userdata('id')])->row_array();
            $comp['poli'] = $this->modelku->get_data('poli');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('admin_view_data_poli');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_manage_data_obat(){
        if($this->session->userdata('role')==='admin'){
            $comp['title'] = "Poliklinik Sehat Bersama | Data Obat";
            $comp['user'] = $this->modelku->get_where_data('admin',['id'=>$this->session->userdata('id')])->row_array();
            $comp['obat'] = $this->modelku->get_data('obat');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('admin_view_data_obat');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }
    // END

    /*
    - ROLE ADMIN
    - DARI HALAMAN "admin_view_data_poli" AKAN MENGIRIMKAN TYPE AKSI (TAMBAH_DATA, UBAH_DATA, HAPUS_DATA)
    - DARI TYPE AKSI TERSEBUT MAKA AKAN MASUK KE PERKONDISIAN YANG SESUAI
    */
    public function manage_data_poli(){
        if($this->session->userdata('role')==='admin'){
            $type = $this->input->post('type');

            if($type==='tambah_data'){
                $data = array(
                    'nama_poli' => $this->input->post('namapoli'),
                    'keterangan' => $this->input->post('keteranganpoli'),
                );
                if($this->modelku->insert_data('poli',$data)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Poli ditambahkan.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Poli gagal ditambahkan.']);
                }
            }

            elseif($type==='ubah_data'){
                $target = array(
                    'id' => $this->input->post('idpoli')
                );
                $data = array(
                    'nama_poli' => $this->input->post('namapoli'),
                    'keterangan' => $this->input->post('keteranganpoli'),
                );
                if($this->modelku->update_data('poli',$data,$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Poli diubah.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Poli gagal diubah.']);
                }
            }

            else{
                $target = array(
                    'id' => $this->input->post('idpoli')
                );
                if($this->modelku->delete_data('poli',$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Poli dihapus.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Poli gagal dihapus.']);
                }
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_poli(){
        if($this->session->userdata('role')==='admin'){
            $target = array(
                'id' => $this->input->post('idpoli')
            );
            $data = $this->modelku->get_where_data('poli',$target)->row_array();
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }
    // END

    /*
    - ROLE ADMIN
    - DARI HALAMAN "admin_view_data_obat" AKAN MENGIRIMKAN TYPE AKSI (TAMBAH_DATA, UBAH_DATA, HAPUS_DATA)
    - DARI TYPE AKSI TERSEBUT MAKA AKAN MASUK KE PERKONDISIAN YANG SESUAI
    */
    public function manage_data_obat(){
        if($this->session->userdata('role')==='admin'){
            $type = $this->input->post('type');

            if($type==='tambah_data'){
                $data = array(
                    'nama_obat' => $this->input->post('namaobat'),
                    'kemasan' => $this->input->post('kemasanobat'),
                    'harga' => $this->input->post('hargaobat'),
                );
                if($this->modelku->insert_data('obat',$data)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Obat ditambahkan.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Obat gagal ditambahkan.']);
                }
            }

            elseif($type==='ubah_data'){
                $target = array(
                    'id' => $this->input->post('idobat')
                );
                $data = array(
                    'nama_obat' => $this->input->post('namaobat'),
                    'kemasan' => $this->input->post('kemasanobat'),
                    'harga' => $this->input->post('hargaobat'),
                );
                if($this->modelku->update_data('obat',$data,$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Obat diubah.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Obat gagal diubah.']);
                }
            }

            else{
                $target = array(
                    'id' => $this->input->post('idobat')
                );
                if($this->modelku->delete_data('obat',$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Obat dihapus.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Obat gagal dihapus.']);
                }
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_obat(){
        if($this->session->userdata('role')==='admin'){
            $target = array(
                'id' => $this->input->post('idobat')
            );
            $data = $this->modelku->get_where_data('obat',$target)->row_array();
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }
    // END

    /*
    - ROLE ADMIN
    - DARI HALAMAN "admin_view_data_dokter" AKAN MENGIRIMKAN TYPE AKSI (TAMBAH_DATA, UBAH_DATA, HAPUS_DATA)
    - DARI TYPE AKSI TERSEBUT MAKA AKAN MASUK KE PERKONDISIAN YANG SESUAI
    */
    public function manage_data_dokter(){
        if($this->session->userdata('role')==='admin'){
            $type = $this->input->post('type');

            if($type==='tambah_data'){
                $data = array(
                    'nama' => $this->input->post('namadokter'),
                    'alamat' => $this->input->post('alamatdokter'),
                    'no_hp' => $this->input->post('nohpdokter'),
                    'id_poli' => $this->input->post('polidokter'),
                );
                if($this->modelku->insert_data('dokter',$data)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Dokter ditambahkan.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Dokter gagal ditambahkan.']);
                }
            }

            elseif($type==='ubah_data'){
                $target = array(
                    'id' => $this->input->post('iddokter')
                );
                $data = array(
                    'nama' => $this->input->post('namadokter'),
                    'alamat' => $this->input->post('alamatdokter'),
                    'no_hp' => $this->input->post('nohpdokter'),
                    'id_poli' => $this->input->post('polidokter'),
                );
                if($this->modelku->update_data('dokter',$data,$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Dokter diubah.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Dokter gagal diubah.']);
                }
            }

            else{
                $target = array(
                    'id' => $this->input->post('iddokter')
                );
                if($this->modelku->delete_data('dokter',$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Dokter dihapus.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Dokter gagal dihapus.']);
                }
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_dokter(){
        if($this->session->userdata('role')==='admin'){
            $target = array(
                'id' => $this->input->post('iddokter')
            );
            $data = $this->modelku->get_where_data_dokter_and_poli($target);
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }
    // END

    /*
    - ROLE ADMIN
    - DARI HALAMAN "admin_view_data_pasien" AKAN MENGIRIMKAN TYPE AKSI (TAMBAH_DATA, UBAH_DATA, HAPUS_DATA)
    - DARI TYPE AKSI TERSEBUT MAKA AKAN MASUK KE PERKONDISIAN YANG SESUAI
    */
    public function manage_data_pasien(){
        if($this->session->userdata('role')==='admin'){
            $type = $this->input->post('type');

            if($type==='tambah_data'){
                $data = array(
                    'nama' => $this->input->post('namapasien'),
                    'alamat' => $this->input->post('alamatpasien'),
                    'no_ktp' => $this->input->post('noktppasien'),
                    'no_hp' => $this->input->post('nohppasien'),
                    'no_rm' => $this->modelku->generate_no_rm()
                );
                $checkPasien = $this->db->get_where('pasien',['no_ktp'=>$this->input->post('noktppasien')])->row_array();
                if($checkPasien){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'duplicate', 'message' => 'Nomor KTP telah terdaftar.']);
                }else{
                    if($this->modelku->insert_data('pasien',$data)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Pasien ditambahkan.']);
                    }
                    else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal ditambahkan.']);
                    }
                }
            }

            elseif($type==='ubah_data'){
                $target = array(
                    'id' => $this->input->post('idpasien')
                );
                $data = array(
                    'nama' => $this->input->post('namapasien'),
                    'alamat' => $this->input->post('alamatpasien'),
                    'no_ktp' => $this->input->post('noktppasien'),
                    'no_hp' => $this->input->post('nohppasien'),
                );

                $checkPasien = $this->db->get_where('pasien',['no_ktp'=>$this->input->post('noktppasien')])->row_array();
                if($checkPasien && $checkPasien['id'] === $this->input->post('idpasien')){
                    if($this->modelku->update_data('pasien',$data,$target)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Pasien diubah.']);
                    }
                    else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal diubah.']);
                    }
                }
                elseif($checkPasien){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'duplicate', 'message' => 'Nomor KTP telah terdaftar.']);
                }
                else{
                    if($this->modelku->update_data('pasien',$data,$target)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Pasien diubah.']);
                    }
                    else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal diubah.']);
                    }
                }
                
            }

            else{
                $target = array(
                    'id' => $this->input->post('idpasien')
                );
                if($this->modelku->delete_data('pasien',$target)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Pasien dihapus.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal dihapus.']);
                }
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_pasien(){
        if($this->session->userdata('role')==='admin'){
            $target = array(
                'id' => $this->input->post('idpasien')
            );
            $data = $this->modelku->get_where_data('pasien',$target)->row_array();
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }
    // END


    /*  ===============================      PASIEN       =====================================
        ======================================================================================
    */


    /* 
    - HALAMAN DIRECT KHUSUS ROLE "PASIEN" KE HALAMAN DAFTAR POLI / REGISTRASI POLI
    - JIKA ROLE SELAIN "PASIEN" MENCOBA MASUK, MAKA REDIRECT KE CONTROLLER "HOME" (MYCONTROLLER)
    */


    public function hal_daftar_poli(){
        if($this->session->userdata('role')==='pasien'){
            $comp['title'] = "Poliklinik Sehat Bersama | Daftar Poli";
            $comp['user'] = $this->modelku->get_where_data('pasien',['id'=>$this->session->userdata('id')])->row_array();
            $comp['poli'] = $this->modelku->get_data('poli');
            $comp['daftar_poli'] = $this->modelku->get_riwayat_poli($this->session->userdata('id'));
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('pasien_view_daftar_poli');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function get_data_jadwal_dokter(){
        $idpoli = $this->input->post('id_poli');
        $data = $this->modelku->get_data_jadwal_dokter($idpoli);
        echo json_encode($data);
    }

    public function manage_daftar_poli(){
        $type = $this->input->post('type');
        if($type==='tambah_data'){
            $idpasien = $this->session->userdata('id');
            $idjadwal = $this->input->post('idjadwal');
            $keluhan = $this->input->post('keluhan');
            // Set zona waktu ke Jakarta (WIB)
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');

            $data = array(
                'id_pasien' => $idpasien,
                'id_jadwal' => $idjadwal,
                'keluhan' => $keluhan,
                'no_antrian' => $this->modelku->generate_no_antrian($idjadwal,$tanggal),
                'status' => 'Belum diperiksa',
                'tanggal' => $tanggal
            );

            if($this->modelku->insert_data('daftar_poli',$data)){
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Nomor antrian poli dibuat.']);
            }
            else{
                header('Content-Type: application/json');
                echo json_encode(['status' => 'gagal', 'message' => 'Nomor antrian poli gagal dibuat.']);
            }
        }
        elseif($type==='ubah_data'){

        }
        else{

        }
    }

    public function get_detail_periksa_pasien(){
        if($this->session->userdata('role')==='pasien'){
            $id_daftar_poli = $this->input->post('daftar_poli_id');
            $data['detail_periksa'] = $this->modelku->get_detail_periksa_pasien_by_id_daftar_poli_for_pasien($id_daftar_poli);
            $data['obat'] = $this->modelku->get_detail_periksa_obat_pasien_by_id_daftar_poli_for_pasien($id_daftar_poli);
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }

    // END





    /*  ===============================      DOKTER       =====================================
        ======================================================================================
    */


    /* 
    - HALAMAN DIRECT KHUSUS ROLE "DOKTER" KE HALAMAN PROFILE, INPUT JADWAL, PERIKSA PASIEN
    - JIKA ROLE SELAIN "DOKTER" MENCOBA MASUK, MAKA REDIRECT KE CONTROLLER "HOME" (MYCONTROLLER)
    */

    public function hal_lihat_profile(){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Profile";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            $comp['poli'] = $this->modelku->get_data('poli');
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_profile');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_jadwal_dokter(){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Jadwal Dokter";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            $comp['jadwal'] = $this->modelku->get_where_data('jadwal_periksa',['id_dokter'=>$this->session->userdata('id')])->result_array();
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_jadwal');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_list_periksa_pasien(){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | List Periksa Pasien";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            $comp['list_pasien'] = $this->modelku->get_list_periksa_pasien($this->session->userdata('id'));
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_list_periksa_pasien');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_periksa_pasien($iddaftarpoli){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Periksa Pasien";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            $comp['pasien'] = $this->modelku->get_periksa_pasien_by_id_daftar_poli($iddaftarpoli);
            $comp['obat'] = $this->modelku->get_data('obat');
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_periksa_pasien');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_edit_periksa_pasien($iddaftarpoli){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Edit Periksa Pasien";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            $comp['pasien'] = $this->modelku->get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli)->row_array();
            $comp['detail_periksa'] = $this->modelku->get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli)->result_array();
            $comp['obat'] = $this->modelku->get_data('obat');
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_edit_periksa_pasien');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_riwayat_periksa_pasien(){
        if($this->session->userdata('role')==='dokter'){
            $comp['title'] = "Poliklinik Sehat Bersama | Riwayat Periksa Pasien";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            // $comp['pasien'] = $this->modelku->get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli)->row_array();
            // $comp['detail_periksa'] = $this->modelku->get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli)->result_array();
            $comp['obat'] = $this->modelku->get_data('obat');
            $comp['list_riwayat_pasien'] = $this->modelku->get_list_riwayat_periksa_pasien($this->session->userdata('id'));
            // $comp['dokter'] = $this->modelku->get_data('dokter');
            $this->load->view('template/navbar',$comp);
            $this->load->view('template/sidebar',$comp);
            $this->load->view('dokter_view_riwayat_periksa_pasien');
            $this->load->view('template/footer');
        }
        else{
            redirect('home');
        }
    }

    public function hal_detail_riwayat_periksa_pasien($id_pasien) {
        if ($this->session->userdata('role') === 'dokter') {
            $comp['title'] = "Poliklinik Sehat Bersama | Riwayat Periksa Pasien";
            $target = array(
                'id' => $this->session->userdata('id')
            );
            $comp['user'] = $this->modelku->get_where_data_dokter_and_poli($target);
            
            // Ambil riwayat periksa pasien dan obat-obatan terkait
            $comp['result_detail_riwayat_pasien'] = $this->modelku->get_detail_riwayat_pasien($id_pasien, $this->session->userdata('id'))->result_array();
            
            // Mengambil data detail obat per pasien dan daftar poli
            $comp['row_detail_riwayat_pasien'] = $this->modelku->get_detail_riwayat_pasien($id_pasien, $this->session->userdata('id'))->row_array();
            
            // Mengambil data obat berdasarkan daftar poli
            $iddaftarpoli = $comp['row_detail_riwayat_pasien']['daftar_poli_id'];
            $comp['obat'] = $this->modelku->get_detail_periksa_obat_pasien_by_id_daftar_poli_for_pasien($iddaftarpoli);
            
            $this->load->view('template/navbar', $comp);
            $this->load->view('template/sidebar', $comp);
            $this->load->view('dokter_view_detail_riwayat_periksa_pasien');
            $this->load->view('template/footer');
        } else {
            redirect('home');
        }
    }
    
    

    /*
    - ROLE DOKTER
    - MENERIMA DATA DARI HALAMAN "dokter_view_profile" UNTUK DIUPDATE/DIUBAH
    */

    public function manage_profile_dokter(){
        if($this->session->userdata('role')==='dokter'){
            $data = array(
                'nama' => $this->input->post('namaProfile'),
                'alamat' => $this->input->post('alamatProfile'),
                'no_hp' => $this->input->post('nohpProfile'),
                'id_poli' => $this->input->post('poliProfile'),
            );

            $target = array(
                'id' => $this->input->post('idProfile')
            );

            if($this->modelku->update_data('dokter',$data, $target)){
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Profile diupdate.']);
            }
            else{
                header('Content-Type: application/json');
                echo json_encode(['status' => 'gagal', 'message' => 'Profile gagal diupdate.']);
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_profile_dokter(){
        if($this->session->userdata('role')==='dokter'){
            $target = array(
                'id' => $this->input->post('iddokter')
            );
            $data = $this->modelku->get_where_data_dokter_and_poli($target);
            echo json_encode($data);
        }
        else{
            redirect('home');
        }
    }

    /*
    - ROLE DOKTER
    - MENERIMA DATA DARI HALAMAN "dokter_view_jadwal" UNTUK DIUPDATE/DIUBAH
    */

    public function manage_jadwal_dokter(){
        if($this->session->userdata('role')==='dokter'){
            
            $type = $this->input->post('type');
            if($type === 'tambah_data'){
                $data = array(
                    'id_dokter' => $this->session->userdata('id'),
                    'hari' => $this->input->post('hariDokter'),
                    'jam_mulai' => $this->input->post('jamMulaiDokter'),
                    'jam_selesai' => $this->input->post('jamSelesaiDokter'),
                    'status' => 'aktif',
                );
    
                if($this->modelku->insert_data('jadwal_periksa',$data)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Jadwal periksa ditambah.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Jadwal periksa gagal ditambah.']);
                }
            }
            elseif($type === 'ubah_data'){
                $data = array(
                    'hari' => $this->input->post('hariDokter'),
                    'jam_mulai' => $this->input->post('jamMulaiDokter'),
                    'jam_selesai' => $this->input->post('jamSelesaiDokter'),
                    'status' => $this->input->post('statusJadwal'),
                );

                $where = array(
                    'id' => $this->input->post('idJadwal')
                );

                if($this->modelku->update_data('jadwal_periksa',$data,$where)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Jadwal periksa diupdate.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Jadwal periksa gagal diupdate.']);
                }
            }
            elseif($type === 'toggle_jadwal'){
                $status = $this->input->post('status');
                $data = array(
                    'status' => $status
                );
                $target = array('id' => $this->input->post('id'));
                if($this->modelku->update_data('jadwal_periksa',$data,$target)){
                    if($status==='aktif'){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Jadwal periksa diaktifkan.']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Jadwal periksa dinonaktifkan.']);
                    }
                }
                else{
                    if($status==='aktif'){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Jadwal periksa gagal diaktifkan.']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Jadwal periksa gagal dinonaktifkan.']);
                    }                
                }
            }
            else{
                $id = $this->input->post('idjadwal');
                $where = array(
                    'id' => $id
                );

                if($this->modelku->delete_data('jadwal_periksa',$where)){
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Jadwal periksa dihapus.']);
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Jadwal periksa gagal dihapus.']);
                }
            }
        }
        else{
            redirect('home');
        }
    }

    public function get_data_jadwal_periksa(){
        $id = $this->input->post('idjadwal');
        $target = array(
            'id'=>$id
        );
        $data = $this->modelku->get_where_data('jadwal_periksa',$target)->row_array();
        echo json_encode ($data);
    }

    /*
    - ROLE DOKTER
    - MENERIMA DATA DARI HALAMAN "dokter_view_periksa_pasien" UNTUK DIUPDATE/DIUBAH
    */

    public function manage_periksa_pasien() {
        $type = $this->input->post('type');
        if ($this->session->userdata('role') === 'dokter') {
            if ($type === 'tambah_data') {
                // Ambil data yang dikirim dari frontend
                $iddaftarpoli = $this->input->post('iddaftarpoli');
                $tanggal = $this->input->post('tanggal');
                $catatan = $this->input->post('catatan');
                $biayaperiksa = $this->input->post('biayaperiksa');
                $obatIds = $this->input->post('obat_ids'); // Array obatIds
    
                // Insert data ke tabel 'periksa'
                $data_periksa = array(
                    'id_daftar_poli' => $iddaftarpoli,
                    'tgl_periksa' => $tanggal,
                    'catatan' => $catatan,
                    'biaya_periksa' => $biayaperiksa
                );
                if($this->modelku->insert_data('periksa', $data_periksa)){
                    // Ambil id_periksa yang baru saja dimasukkan
                    $id_periksa = $this->db->insert_id();
                        
                    // Insert data ke tabel 'detail_periksa' untuk setiap obat yang dipilih
                    if (!empty($obatIds)) {
                        foreach ($obatIds as $obatId) {
                            $data_detail = array(
                                'id_periksa' => $id_periksa,
                                'id_obat' => $obatId
                            );
                            $this->modelku->insert_data('detail_periksa', $data_detail);
                        }
                    }

                    $datas = array(
                        'status' => 'Sudah diperiksa'
                    );
                    $where = array('id' => $iddaftarpoli);
                    if($this->modelku->update_data('daftar_poli',$datas,$where)){
                        // Kembalikan response sukses
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Pasien telah diperiksa.']);
                    }
                    else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal diperiksa.']);
                    }
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Pasien gagal diperiksa.']);
                }
            } elseif ($type === 'ubah_data') {
                // Ambil data yang dikirim dari frontend
                $iddaftarpoli = $this->input->post('iddaftarpoli');
                $tanggal = $this->input->post('tanggal');
                $catatan = $this->input->post('catatan');
                $biayaperiksa = $this->input->post('biayaperiksa');
                $obatIds = $this->input->post('obat_ids'); // Array obatIds
                
                // Update data ke tabel 'periksa'
                $data_periksa = array(
                    'tgl_periksa' => $tanggal,
                    'catatan' => $catatan,
                    'biaya_periksa' => $biayaperiksa
                );
                
                $where = array('id_daftar_poli' => $iddaftarpoli);
                
                if($this->modelku->update_data('periksa', $data_periksa, $where)) {
                    // Hapus detail_periksa yang lama
                    $this->modelku->delete_data('detail_periksa', array('id_periksa' => $iddaftarpoli));
                    
                    // Insert ulang data detail_periksa untuk obat yang dipilih
                    if (!empty($obatIds)) {
                        foreach ($obatIds as $obatId) {
                            $data_detail = array(
                                'id_periksa' => $iddaftarpoli,
                                'id_obat' => $obatId
                            );
                            $this->modelku->insert_data('detail_periksa', $data_detail);
                        }
                    }
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Data periksa pasien berhasil diubah.']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Data periksa pasien gagal diubah.']);
                }
            } else {
                
            }
        } else {
            redirect('home');
        }
    }
    


    /*
    - HANDLE PENDAFTARAN MAUPUN LOGIN
    - PENDAFTARAN PASIEN AKAN MENGECEK, APAKAH NOMOR KTP SUDAH TERDAFTAR ATAU BELUM ?
    - LOGIN UNTUK PASIEN DAN DOKTER MENGGUNAKAN "NAMA" SEBAGAI USERNAME, DAN "ALAMAT" SEBAGAI PASSWORD
    - DATA LOGIN YANG DIINPUTKAN USER (PASIEN/DOKTER) AKAN DICEK SATU-SATU PADA TABEL PASIEN DAN DOKTER,
        APAKAH TERDAFTAR SEBAGAI USER ATAU DOKTER
    - KHUSUS LOGIN UNTUK ADMIN, USERNAME DAN PASSWORD = ADMIN
    */
    public function auth(){
        $type = $this->input->post('type');
        if($type==='daftar'){
            $cekUser = $this->modelku->get_where_data('pasien',['no_ktp'=>$this->input->post('noktp')])->row_array();
            if(!$cekUser){

                // INPUT DATA PASIEN BARU KE DATABASE TABEL PASIEN
                $data_pasien = array(
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'no_ktp' => $this->input->post('noktp'),
                    'no_hp' => $this->input->post('nohp'),
                    'no_rm' => $this->modelku->generate_no_rm(),
                );
                $this->modelku->insert_data('pasien',$data_pasien);

                // $this->db->insert_id() adalah bawaan dari CI untuk ambil ID terakhir database       
                $user_id = $this->db->insert_id();   

                // START SESSION USER
                $data = array(
                    'id' => $user_id,
                    'noktp' => $this->input->post('noktp'),
                    'role' => 'pasien',
                );
                $this->session->set_userdata($data);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Sukses login']);
            }
            else{
                header('Content-Type: application/json');
                echo json_encode(['status' => 'gagal', 'message' => 'Nomor KTP sudah terdaftar.']);
            }
        }
        else{
            $cekPasien = $this->modelku->get_where_data('pasien',['nama'=>$this->input->post('username'), 'alamat'=>$this->input->post('password')])->row_array();
            if($cekPasien){
                // password disini adalah kota/alamat
                $password = $this->input->post('password');
                if($password === $cekPasien['alamat']){
                    $data = array(
                        'id' => $cekPasien['id'],
                        'role' => 'pasien',
                    );
                    $this->session->set_userdata($data);
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Sukses login']);
                    return;
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Password salah.']);
                    return;
                }
            }
            $cekDokter = $this->modelku->get_where_data('dokter',['nama'=>$this->input->post('username')])->row_array();
            if($cekDokter){
                // password disini adalah kota/alamat
                $password = $this->input->post('password');
                if($password === $cekDokter['alamat']){
                    $data = array(
                        'id' => $cekDokter['id'],
                        'role' => 'dokter',
                    );
                    $this->session->set_userdata($data);
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Sukses login']);
                    return;
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Password salah.']);
                    return;
                }
            }
            $cekAdmin = $this->modelku->get_where_data('admin',['username'=>$this->input->post('username')])->row_array();
            if($cekAdmin){
                // password disini adalah admin
                $password = password_verify($this->input->post('password'),$cekAdmin['password']);
                if($password){
                    $data = array(
                        'id' => $cekAdmin['id'],
                        'role' => 'admin',
                    );
                    $this->session->set_userdata($data);
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Sukses login']);
                    return;
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'gagal', 'message' => 'Password salah.']);
                    return;
                }
            }
            else{
                header('Content-Type: application/json');
                echo json_encode(['status' => 'gagal', 'message' => 'Username tidak terdaftar.']);
                return;
            }
        }
    }
    // END

    // HANDLE SISTEM UNTUK MENGAKHIRI SESSION
    public function logout(){
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        redirect('home');
    }
    // END
}