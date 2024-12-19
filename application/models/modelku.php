<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelku extends CI_Model{

    public function insert_data($tabel, $data)
    {
        return $this->db->insert($tabel,$data);
    }

    public function delete_data($tabel, $where)
    {
        return $this->db->delete($tabel,$where);
    }

    public function update_data($tabel, $data, $where){
        return $this->db->update($tabel, $data, $where);
    }

    public function get_data($tabel){
        return $this->db->get($tabel)->result_array();
    }

    public function get_where_data($tabel, $where){
        return $this->db->get_where($tabel,$where);
    }

    // public function generate_no_rm() {
    //     // Ambil tahun dan bulan sekarang
    //     $tahun_bulan = date('Ym'); // Format: 202411
    
    //     // Hitung jumlah pasien yang terdaftar dengan prefix tahun-bulan yang sama
    //     $this->db->like('no_rm', $tahun_bulan, 'after'); // Menggunakan 'after' agar mencari yang setelah prefix tahun-bulan
    //     $this->db->from('pasien');
    //     $jumlah_pasien = $this->db->count_all_results(); // Menghitung jumlah pasien yang memiliki prefix yang sama
    
    //     // Posisi data adalah jumlah pasien + 1
    //     $posisi_data = $jumlah_pasien + 1;
        
    //     // Buat NoRM dengan format tahunbulan-posisi tanpa padding angka
    //     $norm = $tahun_bulan . '-' . $posisi_data; // Misalnya 202411-1, 202411-2
        
    //     return $norm;
    // }

    public function generate_no_rm() {
        // Ambil tahun dan bulan sekarang
        $tahun_bulan = date('Ym'); // Format: 202411
    
        // Hitung jumlah pasien yang terdaftar dengan prefix tahun-bulan yang sama
        $this->db->like('no_rm', $tahun_bulan, 'after'); // Menggunakan 'after' agar mencari yang setelah prefix tahun-bulan
        $this->db->from('pasien');
        $jumlah_pasien = $this->db->count_all_results(); // Menghitung jumlah pasien yang memiliki prefix yang sama
    
        // Posisi data adalah jumlah pasien + 1
        $posisi_data = $jumlah_pasien + 1;
    
        // Tambahkan padding untuk memastikan 3 digit di belakang
        $posisi_data_padded = str_pad($posisi_data, 3, '0', STR_PAD_LEFT); // Menambahkan nol di depan jika kurang dari 3 digit
    
        // Buat NoRM dengan format tahunbulan-posisi
        $norm = $tahun_bulan . '-' . $posisi_data_padded; // Misalnya 202411-001, 202411-002
    
        return $norm;
    }
    

    public function generate_no_antrian($id_jadwal, $tanggal) {
        // Cek jumlah pendaftar pada tanggal dan id_jadwal yang sama
        // $this->db->where('tanggal', $tanggal); // Cek tanggal pendaftaran
        $this->db->where('id_jadwal', $id_jadwal); // Cek id_jadwal
        $this->db->from('daftar_poli');
        $jumlah_pendaftar = $this->db->count_all_results(); // Menghitung jumlah pendaftar yang sudah terdaftar dengan id_jadwal dan tanggal yang sama
        
        // Posisi antrian adalah jumlah pendaftar + 1
        $no_antrian = $jumlah_pendaftar + 1;
        
        return $no_antrian;
    }
    

    // public function generate_no_daftar() {
    //     // Ambil tahun dan bulan sekarang
    //     $tahun_bulan = date('Ym'); // Format: 202411
    
    //     // Hitung jumlah pasien yang terdaftar dengan prefix tahun-bulan yang sama
    //     $this->db->like('no_rm', $tahun_bulan, 'after'); // Menggunakan 'after' agar mencari yang setelah prefix tahun-bulan
    //     $this->db->from('pasien');
    //     $jumlah_pasien = $this->db->count_all_results(); // Menghitung jumlah pasien yang memiliki prefix yang sama
    
    //     // Posisi data adalah jumlah pasien + 1
    //     $posisi_data = $jumlah_pasien + 1;
        
    //     // Buat NoRM dengan format tahunbulan-posisi tanpa padding angka
    //     $norm = $tahun_bulan . '-' . $posisi_data; // Misalnya 202411-1, 202411-2
        
    //     return $norm;
    // }

    public function get_data_dokter_and_poli(){
        $this->db->select('dokter.*, poli.id AS poli_id, poli.nama_poli');
        $this->db->from('dokter');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        return $this->db->get()->result_array();
    }

    public function get_where_data_dokter_and_poli($target){
        $this->db->select('dokter.*, poli.id AS poli_id, poli.nama_poli');
        $this->db->from('dokter');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->where('dokter.id', $target['id']);
        return $this->db->get()->row_array();
    }

    public function get_data_jadwal_dokter($idpoli){
        $this->db->select('dokter.nama, jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai');
        $this->db->from('dokter');
        $this->db->join('jadwal_periksa','dokter.id = jadwal_periksa.id_dokter');
        $this->db->where('dokter.id_poli',$idpoli);
        return $this->db->get()->result_array();
    }

    public function get_riwayat_poli($where){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm, 
        dokter.id AS dokter_id, dokter.nama AS dokter_nama, dokter.id_poli, 
        poli.id AS poli_id, poli.nama_poli, 
        jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai');
        $this->db->from('daftar_poli');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->where('daftar_poli.id_pasien', $where);
        return $this->db->get()->result_array();
    }

    public function get_list_periksa_pasien($id_dokter){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm, 
        dokter.id AS dokter_id, dokter.nama AS dokter_nama, dokter.id_poli, 
        poli.id AS poli_id, poli.nama_poli, 
        jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai');
        $this->db->from('daftar_poli');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->where('jadwal_periksa.id_dokter', $id_dokter);
        return $this->db->get()->result_array();
    }

    public function get_periksa_pasien_by_id_daftar_poli($iddaftarpoli){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm');
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->where('daftar_poli.id', $iddaftarpoli);
        return $this->db->get()->row_array();
    }

    public function get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        periksa.id AS periksa_id, periksa.id_daftar_poli, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm,
        detail_periksa.id AS detail_periksa_id, detail_periksa.id_periksa, detail_periksa.id_obat');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->where('periksa.id_daftar_poli', $iddaftarpoli);
        return $this->db->get();
    }

    public function get_detail_periksa_pasien_by_id_daftar_poli_for_pasien($iddaftarpoli){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        poli.id AS poli_id, poli.nama_poli, dokter.id AS dokter_id, dokter.nama AS dokter_nama, jadwal_periksa.id,jadwal_periksa.id_dokter,
        periksa.id AS periksa_id, periksa.id_daftar_poli, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm,
        detail_periksa.id AS detail_periksa_id, detail_periksa.id_periksa, detail_periksa.id_obat');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal= jadwal_periksa.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->where('periksa.id_daftar_poli', $iddaftarpoli);
        return $this->db->get()->row_array();
    }

    public function get_detail_periksa_obat_pasien_by_id_daftar_poli_for_pasien($iddaftarpoli){
        $this->db->select('
        daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
        poli.id AS poli_id, poli.nama_poli, dokter.id AS dokter_id, dokter.nama AS dokter_nama, jadwal_periksa.id,jadwal_periksa.id_dokter,
        periksa.id AS periksa_id, periksa.id_daftar_poli, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa,
        pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm,
        detail_periksa.id_obat, obat.id AS obat_id, obat.nama_obat, obat.harga, obat.kemasan,
        detail_periksa.id AS detail_periksa_id, detail_periksa.id_periksa, detail_periksa.id_obat');
        $this->db->from('periksa');
        $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal= jadwal_periksa.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->join('obat', 'detail_periksa.id_obat = obat.id');
        $this->db->where('periksa.id_daftar_poli', $iddaftarpoli);
        return $this->db->get()->result_array();
    }

    public function get_list_riwayat_periksa_pasien($id_dokter) {
        $this->db->select('
            pasien.no_rm, pasien.id AS pasien_id, pasien.nama AS pasien_nama,
            MAX(daftar_poli.id) AS daftar_poli_id, MAX(daftar_poli.keluhan) AS keluhan, 
            MAX(daftar_poli.no_antrian) AS no_antrian, MAX(daftar_poli.status) AS status, 
            MAX(daftar_poli.tanggal) AS tanggal, 
            MAX(dokter.id) AS dokter_id, MAX(dokter.nama) AS dokter_nama, MAX(poli.id) AS poli_id, 
            MAX(poli.nama_poli) AS poli_nama, 
            MAX(jadwal_periksa.id) AS jadwal_periksa_id, MAX(jadwal_periksa.hari) AS hari, 
            MAX(jadwal_periksa.jam_mulai) AS jam_mulai, MAX(jadwal_periksa.jam_selesai) AS jam_selesai');
        $this->db->from('daftar_poli');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        
        $this->db->where('jadwal_periksa.id_dokter', $id_dokter);
        $this->db->where('daftar_poli.status', 'Sudah diperiksa');
        
        // Grouping by patient ID (no_rm), ensuring one row per patient
        $this->db->group_by('pasien.no_rm, pasien.id');
        
        $this->db->order_by('pasien.nama', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    
    public function get_detail_riwayat_pasien($idpasien, $iddokter) {
        $this->db->select('
            daftar_poli.id AS daftar_poli_id, daftar_poli.id_pasien, daftar_poli.id_jadwal, daftar_poli.keluhan, daftar_poli.tanggal AS tanggal_daftar_poli,
            jadwal_periksa.id AS jadwal_periksa_id, jadwal_periksa.id_dokter, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai,
            pasien.id AS pasien_id, pasien.nama, pasien.no_rm,
            MAX(periksa.id) AS periksa_id, MAX(periksa.id_daftar_poli) AS periksa_id_daftar_poli, MAX(periksa.tgl_periksa) AS tgl_periksa,
            MAX(periksa.catatan) AS catatan, MAX(periksa.biaya_periksa) AS biaya_periksa,
            GROUP_CONCAT(obat.nama_obat ORDER BY obat.nama_obat ASC SEPARATOR ", ") AS obat_list,  
            MAX(obat.id) AS obat_id, MAX(obat.kemasan) AS kemasan, MAX(obat.harga) AS harga,
            MAX(dokter.id) AS dokter_id, dokter.id_poli, 
            MAX(poli.id) AS poli_id, MAX(poli.nama_poli) AS poli_nama');
        
        $this->db->from('daftar_poli');
        $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
        $this->db->join('jadwal_periksa', 'daftar_poli.id_jadwal = jadwal_periksa.id');
        $this->db->join('dokter', 'jadwal_periksa.id_dokter = dokter.id');
        $this->db->join('poli', 'dokter.id_poli = poli.id');
        $this->db->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli');
        $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
        $this->db->join('obat', 'detail_periksa.id_obat = obat.id');
        
        $this->db->where('daftar_poli.id_pasien', $idpasien);
        $this->db->where('jadwal_periksa.id_dokter', $iddokter);
        
        // Group by berdasarkan daftar poli (ID pasien)
        $this->db->group_by('daftar_poli.id');  
        
        return $this->db->get();
    }
    
    

    // public function get_detail_periksa_pasien_by_id_daftar_poli($iddaftarpoli){
    //     $this->db->select('
    //     daftar_poli.id AS daftar_poli_id, daftar_poli.keluhan, daftar_poli.no_antrian, daftar_poli.status, daftar_poli.tanggal,
    //     periksa.id AS periksa_id, periksa.id_daftar_poli, periksa.tgl_periksa, periksa.catatan, periksa.biaya_periksa,
    //     pasien.id AS pasien_id, pasien.nama AS pasien_nama, pasien.no_rm,
    //     detail_periksa.id AS detail_periksa_id, detail_periksa.id_periksa, detail_periksa.id_obat');
    //     $this->db->from('periksa');
    //     $this->db->join('daftar_poli', 'periksa.id_daftar_poli = daftar_poli.id_pasien');
    //     $this->db->join('pasien', 'daftar_poli.id_pasien = pasien.id');
    //     $this->db->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa');
    //     $this->db->where('periksa.id_daftar_poli', $iddaftarpoli);
    //     return $this->db->get()->result_array();
    // }

    
    // public function user_get_data_pasien(){
    //     $this->db->select('user.id, pasien.*');
    //     $this->db->from('user');
    //     $this->db->join('pasien','user.id = pasien.id_user');
    //     return $this->db->get()->row_array();
    // }

}