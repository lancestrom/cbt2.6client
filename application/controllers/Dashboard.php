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
}