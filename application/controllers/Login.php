<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {

        $this->load->view('tampilan_login');
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('Model_login');
        $cek = $this->Model_login->cek_login($username, $password);

        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $ck) {
                $sess_data['username'] = $ck->username;
                $sess_data['level'] = $ck->level;
                $sess_data['status'] = $ck->status;
                $this->session->set_userdata($sess_data);
            }
            if ($sess_data['level'] == 'siswa' &&  $sess_data['status'] == '1') {
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username dan Password salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username dan Password salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}