<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ujian extends CI_Model
{


    public function data_jadwal_siswa($sess, $jadwal, $waktu)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
WHERE a_siswa.username='$sess' AND a_jadwal.tanggal_mulai='$jadwal' AND a_jadwal.waktu_mulai<='$waktu' AND a_jadwal.waktu_selesai>'$waktu';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function detail_ujian($sess, $id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_siswa.username,a_siswa.nama_siswa, a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,
TIMESTAMPDIFF(
    MINUTE,
    a_jadwal.waktu_mulai,
    a_jadwal.waktu_selesai
) AS selisih_menit
FROM a_jadwal
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.id_jadwal='$id_jadwal' AND a_siswa.username='$sess'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}
