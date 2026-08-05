<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_keamanan extends CI_Model
{
    public function getKeamanan()
    {
        $username = $this->session->userdata('username');
        $logged_in = $this->session->userdata('logged_in');
        $app_session_id = $this->input->cookie('app_session_id', TRUE);

        if (empty($username) || $logged_in !== TRUE || empty($app_session_id)) {
            $this->clearAuthAndRedirect();
            return;
        }

        $session = $this->Session_Model->get_session($app_session_id);
        if (!$session || $session->username !== $username) {
            $this->clearAuthAndRedirect();
            return;
        }

        // Refresh last activity timestamp so session stays valid while user aktif
        $this->Session_Model->update_session_timestamp($app_session_id);
    }

    protected function clearAuthAndRedirect()
    {
        $this->session->sess_destroy();
        $this->input->set_cookie(array(
            'name'     => 'app_session_id',
            'value'    => '',
            'expire'   => 0,
            'path'     => '/',
            'httponly' => TRUE,
            'secure'   => FALSE,
        ));
        redirect('/');
    }
}
