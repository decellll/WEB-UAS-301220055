<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Borrowing_model');
        $this->load->model('Book_model');
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    public function index()
    {
        $keyword = $this->input->get('q');
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $data['transaksi'] = $this->Borrowing_model->getAllTransaksi($keyword, $limit, $offset);
        $data['total'] = $this->Borrowing_model->countAllTransaksi($keyword);
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['keyword'] = $keyword;
        $data['content_view'] = 'admin/transaksi/index';
        $data['title'] = 'Transaksi Peminjaman - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'transaksi';
        $this->load->view('templates/admin_layout', $data);
    }
    public function detail($id)
    {
        $data['transaksi'] = $this->Borrowing_model->getDetailTransaksi($id);
        $data['content_view'] = 'admin/transaksi/detail';
        $data['title'] = 'Detail Transaksi - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'transaksi';
        $this->load->view('templates/admin_layout', $data);
    }
    public function add()
    {
        $this->load->model('Book_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('anggota_id', 'Anggota', 'required');
        $this->form_validation->set_rules('buku_id', 'Buku', 'required');
        $this->form_validation->set_rules('tgl_pinjam', 'Tanggal Pinjam', 'required');
        $this->form_validation->set_rules('lama_pinjam', 'Lama Pinjam', 'required|integer');
        if ($this->form_validation->run() == FALSE) {
            $data['anggota'] = $this->User_model->getAllByLevel('siswa');
            $data['buku'] = $this->Book_model->getAvailable();
            $data['content_view'] = 'admin/transaksi/form';
            $data['title'] = 'Tambah Transaksi - Perpustakaan MA Al-Hijrah';
            $data['active_menu'] = 'transaksi';
            $this->load->view('templates/admin_layout', $data);
        } else {
            $pinjam_id = $this->input->post('pinjam_id') ?: uniqid('PJ');
            $data = [
                'pinjam_id' => $pinjam_id,
                'anggota_id' => $this->input->post('anggota_id'),
                'buku_id' => $this->input->post('buku_id'),
                'status' => 'dipinjam',
                'tgl_pinjam' => $this->input->post('tgl_pinjam'),
                'lama_pinjam' => $this->input->post('lama_pinjam'),
                'tgl_balik' => date('Y-m-d', strtotime($this->input->post('tgl_pinjam') . ' +' . $this->input->post('lama_pinjam') . ' days')),
                'tgl_kembali' => null
            ];
            $this->Borrowing_model->insert($data);
            $this->Book_model->decrementStock($this->input->post('buku_id'));
            $this->session->set_flashdata('success', 'Transaksi peminjaman berhasil ditambahkan!');
            redirect('admin/transaksi');
        }
    }
    public function return($id)
    {
        $this->load->model('Borrowing_model');
        $this->load->model('Book_model');
        $trx = $this->Borrowing_model->getById($id);
        if ($trx && $trx['status'] == 'dipinjam') {
            $this->Borrowing_model->update($id, [
                'status' => 'dikembalikan',
                'tgl_kembali' => date('Y-m-d')
            ]);
            $this->Book_model->incrementStock($trx['buku_id']);
            $this->session->set_flashdata('success', 'Buku berhasil dikembalikan!');
        }
        redirect('admin/transaksi');
    }
}
