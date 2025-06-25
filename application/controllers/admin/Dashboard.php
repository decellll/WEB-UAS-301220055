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
        $this->load->view('admin/dashboard');
    }
}
