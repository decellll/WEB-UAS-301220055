<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    /**
     * Halaman login
     */
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            if ($this->session->userdata('level') == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('user/dashboard');
            }
        }
        $this->form_validation->set_rules('user', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    /**
     * Proses login
     */
    private function _login()
    {
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        $data = $this->Auth_model->getUser($user);
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $session = [
                    'id_login' => $data['id_login'],
                    'user' => $data['user'],
                    'level' => $data['level'],
                    'nama' => $data['nama'],
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session);
                if ($data['level'] == 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Password salah!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            redirect('auth');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
