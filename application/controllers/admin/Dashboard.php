<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    public function index()
    {
        $this->load->model('User_model');
        $this->load->model('Book_model');
        $this->load->model('Borrowing_model');
        $data['total_anggota'] = $this->User_model->countAll();
        $data['total_kategori'] = $this->Book_model->countKategori();
        $data['total_pinjam'] = $this->Borrowing_model->countPinjam();
        $data['total_kembali'] = $this->Borrowing_model->countKembali();
        $data['content_view'] = 'admin/dashboard';
        $data['title'] = 'Dashboard Admin - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'dashboard';
        $this->load->view('templates/admin_layout', $data);
    }
}
