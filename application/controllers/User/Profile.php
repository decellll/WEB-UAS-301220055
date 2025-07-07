<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'siswa') {
            redirect('auth');
        }
    }
    public function index()
    {
        $user = $this->User_model->getByUsername($this->session->userdata('user'));
        $data['user'] = $user;
        $data['content_view'] = 'user/profile/index';
        $data['title'] = 'Profil Saya - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'profile';
        $this->load->view('templates/user_layout', $data);
    }
}
