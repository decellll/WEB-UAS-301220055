<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Borrowing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Borrowing_model');
        $this->load->model('Book_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'siswa') {
            redirect('auth');
        }
    }
    public function index()
    {
        $anggota_id = $this->session->userdata('user');
        $data['riwayat'] = $this->Borrowing_model->getHistoryByUser($anggota_id);
        $data['content_view'] = 'user/borrowing/index';
        $data['title'] = 'Riwayat Peminjaman - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'borrowing';
        $this->load->view('templates/user_layout', $data);
    }
}
