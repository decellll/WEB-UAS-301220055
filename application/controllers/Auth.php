<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->library('session');
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

    /**
     * Halaman register
     */
    public function register()
    {
        $this->load->helper('form');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('user', 'Username', 'required|is_unique[tb_admin.user]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_admin.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('level', 'Level', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'anggota' => $this->input->post('user'),
                'user' => $this->input->post('user'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level'),
                'nama' => $this->input->post('nama'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'telpon' => $this->input->post('telpon'),
                'email' => $this->input->post('email'),
                'tgl_bergabung' => date('Y-m-d'),
                'foto' => null
            ];
            $this->Auth_model->registerUser($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth');
        }
    }
}
