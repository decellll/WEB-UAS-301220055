<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Books extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    // List buku dengan search & pagination
    public function index()
    {
        $keyword = $this->input->get('q');
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $data['books'] = $this->Book_model->getAll($keyword, $limit, $offset);
        $data['total'] = $this->Book_model->countAll($keyword);
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['keyword'] = $keyword;
        $data['content_view'] = 'admin/books/index';
        $data['title'] = 'Data Buku - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'books';
        $this->load->view('templates/admin_layout', $data);
    }
    // Tambah, edit, hapus, detail akan menyusul
    public function add()
    {
        $this->load->model('Category_model');
        $this->load->model('Rack_model');
        $this->form_validation->set_rules('title', 'Judul Buku', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun_buku', 'Tahun Buku', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('id_rak', 'Rak', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['mode'] = 'add';
            $data['kategori'] = $this->Category_model->getAll();
            $data['rak'] = $this->Rack_model->getAll();
            $data['content_view'] = 'admin/books/form';
            $data['title'] = 'Tambah Buku - Perpustakaan MA Al-Hijrah';
            $data['active_menu'] = 'books';
            $this->load->view('templates/admin_layout', $data);
        } else {
            $sampul = $this->_uploadSampul();
            $data = [
                'buku_id' => uniqid('BK'),
                'id_kategori' => $this->input->post('id_kategori'),
                'id_rak' => $this->input->post('id_rak'),
                'sampul' => $sampul,
                'isbn' => $this->input->post('isbn'),
                'lampiran' => null,
                'title' => $this->input->post('title'),
                'penerbit' => $this->input->post('penerbit'),
                'pengarang' => $this->input->post('pengarang'),
                'tahun_buku' => $this->input->post('tahun_buku'),
                'isi' => $this->input->post('isi'),
                'jumlah' => $this->input->post('jumlah'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
            ];
            $this->Book_model->insert($data);
            $this->session->set_flashdata('success', 'Buku berhasil ditambahkan!');
            redirect('admin/books');
        }
    }
    private function _uploadSampul()
    {
        if (!empty($_FILES['sampul']['name'])) {
            $config['upload_path'] = './uploads/sampul/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;
            $config['file_name'] = uniqid('sampul_');
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul')) {
                return $this->upload->data('file_name');
            }
        }
        return null;
    }
}
