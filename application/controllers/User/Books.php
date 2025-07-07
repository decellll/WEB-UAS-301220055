<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Books extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'siswa') {
            redirect('auth');
        }
    }
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
        $data['content_view'] = 'user/books/index';
        $data['title'] = 'Data Buku - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'books';
        $this->load->view('templates/user_layout', $data);
    }
}
