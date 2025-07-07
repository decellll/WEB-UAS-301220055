<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Denda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Denda_model');
        $this->load->model('Borrowing_model');
        $this->load->model('Book_model');
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    public function index()
    {
        // Generate denda otomatis untuk pinjaman yang telat
        $this->load->model('Borrowing_model');
        $this->load->model('Denda_model');
        $telat = $this->Borrowing_model->getTelatDipinjam();
        $tarif_per_hari = 5000;
        foreach ($telat as $t) {
            // Cek apakah sudah ada denda untuk pinjam_id ini
            if (!$this->Denda_model->exists($t['pinjam_id'])) {
                $hari_telat = (int)date_diff(date_create($t['tgl_balik']), date_create(date('Y-m-d')))->format('%a');
                if ($hari_telat > 0) {
                    $data = [
                        'pinjam_id' => $t['pinjam_id'],
                        'denda' => $hari_telat * $tarif_per_hari,
                        'lama_waktu' => $hari_telat,
                        'tgl_denda' => date('Y-m-d')
                    ];
                    $this->Denda_model->insert($data);
                }
            }
        }
        $keyword = $this->input->get('q');
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $data['denda'] = $this->Denda_model->getAllDenda($keyword, $limit, $offset);
        $data['total'] = $this->Denda_model->countAllDenda($keyword);
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['keyword'] = $keyword;
        $data['content_view'] = 'admin/denda/index';
        $data['title'] = 'Data Denda - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'denda';
        $this->load->view('templates/admin_layout', $data);
    }
    public function confirm($id)
    {
        $this->load->model('Denda_model');
        $this->Denda_model->setLunas($id);
        $this->session->set_flashdata('success', 'Denda telah dikonfirmasi lunas!');
        redirect('admin/denda');
    }
    public function detail($id)
    {
        $data['denda'] = $this->Denda_model->getDetailDenda($id);
        $data['content_view'] = 'admin/denda/detail';
        $data['title'] = 'Detail Denda - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'denda';
        $this->load->view('templates/admin_layout', $data);
    }
}
