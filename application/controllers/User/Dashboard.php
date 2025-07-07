<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        $this->load->model('Borrowing_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'siswa') {
            redirect('auth');
        }
    }
    public function index()
    {
        $anggota_id = $this->session->userdata('user');
        $data['user'] = $this->session->userdata();
        $data['total_buku'] = $this->Book_model->countAll();
        $data['dipinjam'] = $this->Borrowing_model->countByUser($anggota_id, 'dipinjam');
        $data['dikembalikan'] = $this->Borrowing_model->countByUser($anggota_id, 'dikembalikan');
        $data['histori'] = $this->Borrowing_model->getLastHistory($anggota_id, 5);
        $data['content_view'] = 'user/dashboard';
        $data['title'] = 'Dashboard Anggota - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'dashboard';
        $this->load->view('templates/user_layout', $data);
    }
}
