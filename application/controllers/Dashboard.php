<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $sess = $this->session->userdata('username');
        $isi['siswa'] = $this->Model_siswa->dataSiswaID($sess);

        $this->load->view('templates/header');
        $this->load->view('tampilan_siswa', $isi);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        // Dapatkan username dari session sebelum menghancurkan session CodeIgniter
        $username = $this->session->userdata('username');

        if ($username) {
            // Hapus semua session dari database berdasarkan username
            $this->Session_Model->delete_user_sessions($username);
        }

        // Hapus cookie
        // delete_cookie('cbt25_session', '', '/', '', FALSE, TRUE); // Menghapus cookie dengan domain, path, prefix, secure, dan httponly yang sesuai

        // Hapus session CodeIgniter
        $this->session->sess_destroy();

        // Redirect ke login
        redirect('/');
    }
}
