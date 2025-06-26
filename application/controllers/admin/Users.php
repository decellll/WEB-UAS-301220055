<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('User_model');
        if (!$this->session->userdata('logged_in') || $this->session->userdata('level') != 'admin') {
            redirect('auth');
        }
    }
    // List user dengan search & pagination
    public function index()
    {
        $keyword = $this->input->get('q');
        $data['users'] = $this->User_model->getAll($keyword);
        $data['keyword'] = $keyword;
        $data['content_view'] = 'admin/users/index';
        $data['title'] = 'Data Pengguna - Perpustakaan MA Al-Hijrah';
        $data['active_menu'] = 'users';
        $this->load->view('templates/admin_layout', $data);
    }
    // Tambah user
    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('user', 'Username', 'required|is_unique[tb_admin.user]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_admin.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('level', 'Level', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['mode'] = 'add';
            $data['content_view'] = 'admin/users/form';
            $data['title'] = 'Tambah User - Perpustakaan MA Al-Hijrah';
            $data['active_menu'] = 'users';
            $this->load->view('templates/admin_layout', $data);
        } else {
            $foto = $this->_uploadFoto();
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
                'foto' => $foto
            ];
            $this->User_model->insert($data);
            $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
            redirect('admin/users');
        }
    }
    // Edit user
    public function edit($id)
    {
        $user = $this->User_model->getById($id);
        if (!$user) redirect('admin/users');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('level', 'Level', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['mode'] = 'edit';
            $data['user'] = $user;
            $data['content_view'] = 'admin/users/form';
            $data['title'] = 'Update User - ' . $user['nama'] . ' - Perpustakaan MA Al-Hijrah';
            $data['active_menu'] = 'users';
            $this->load->view('templates/admin_layout', $data);
        } else {
            $foto = $this->_uploadFoto($user['foto']);
            $data = [
                'nama' => $this->input->post('nama'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'telpon' => $this->input->post('telpon'),
                'email' => $this->input->post('email'),
                'level' => $this->input->post('level'),
                'foto' => $foto
            ];
            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->User_model->update($id, $data);
            $this->session->set_flashdata('success', 'User berhasil diupdate!');
            redirect('admin/users');
        }
    }
    // Hapus user
    public function delete($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('admin/users');
    }
    // Upload foto (opsional)
    private function _uploadFoto($old = null)
    {
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './uploads/foto/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;
            $config['file_name'] = uniqid('foto_');
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                if ($old && file_exists('./uploads/foto/' . $old)) {
                    @unlink('./uploads/foto/' . $old);
                }
                return $this->upload->data('file_name');
            }
        }
        return $old;
    }
}
