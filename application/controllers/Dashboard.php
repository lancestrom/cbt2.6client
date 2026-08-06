<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $this->Model_keamanan->getKeamanan();
        $sess = $this->session->userdata('username');

        $jadwal = date('Y-m-d');
        $waktu =  date('H:i:s');
        $isi['siswa'] = $this->Model_siswa->dataSiswaID($sess);
        $isi['ujian'] = $this->Model_ujian->data_jadwal_siswa($sess, $jadwal, $waktu);

        $this->load->view('templates/header');
        $this->load->view('tampilan_siswa', $isi);
        $this->load->view('templates/footer');
    }

    public function detail_ujian($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $sess = $this->session->userdata('username');
        $isi['siswa'] = $this->Model_siswa->dataSiswaID($sess);
        $isi['detail_ujian'] = $this->Model_ujian->detail_ujian($sess, $id_jadwal);

        $this->load->view('templates/header');
        $this->load->view('detail_ujian', $isi);
        $this->load->view('templates/footer');
    }

    public function soal_ujian_username($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $sess = $this->session->userdata('username');
        $isi['siswa'] = $this->Model_ujian->soal_ujian_siswa($id_jadwal, $sess);
        $isi['soal'] = $this->Model_ujian->soal_ujian($id_jadwal, $sess);

        $this->load->view('templates/header');
        $this->load->view('tampilan_soal_ujian', $isi);
        $this->load->view('templates/footer');
    }

    public function kirim_jawaban()
    {
        $this->Model_keamanan->getKeamanan();

        $usernames = $this->input->post('username');
        $id_mapel = $this->input->post('id_mapel');
        $id_soal = $this->input->post('id_soal');
        $jawaban = $this->input->post('jawaban');

        if (!is_array($id_soal)) {
            redirect('dashboard');
            return;
        }

        foreach ($id_soal as $index => $soal_id) {
            $user = isset($usernames[$index]) ? $usernames[$index] : $this->session->userdata('username');
            $mapel = isset($id_mapel[$index]) ? $id_mapel[$index] : null;
            $jawab = isset($jawaban[$soal_id]) ? $jawaban[$soal_id] : '';

            $data = array(
                'id_siswa_jawab' => $user . '_' . uniqid(),
                'id_mapel' => $mapel,
                'username' => $user,
                'soal_id' => $soal_id,
                'jawaban' => $jawab
            );

            $this->db->insert('siswa_jawab', $data);
        }

        $username = $this->session->userdata('username');

        if ($username) {
            $this->Session_Model->delete_user_sessions($username);
        }

        $this->input->set_cookie(array(
            'name'     => 'app_session_id',
            'value'    => '',
            'expire'   => 0,
            'path'     => '/',
            'httponly' => TRUE,
            'secure'   => FALSE,
        ));

        $this->session->sess_destroy();
        redirect('/');
    }

    public function logout()
    {
        $username = $this->session->userdata('username');

        if ($username) {
            $this->Session_Model->delete_user_sessions($username);
        }

        $this->input->set_cookie(array(
            'name'     => 'app_session_id',
            'value'    => '',
            'expire'   => 0,
            'path'     => '/',
            'httponly' => TRUE,
            'secure'   => FALSE,
        ));

        $this->session->sess_destroy();
        redirect('/');
    }
}
