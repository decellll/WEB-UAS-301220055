<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Borrowing_model extends CI_Model
{
    public function countPinjam()
    {
        $this->db->where('status', 'dipinjam');
        return $this->db->count_all_results('tb_pinjam');
    }
    public function countKembali()
    {
        $this->db->where('status', 'dikembalikan');
        return $this->db->count_all_results('tb_pinjam');
    }
}
