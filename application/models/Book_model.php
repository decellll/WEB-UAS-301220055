<?php
if (!defined('BASEPATH')) exit('BASEPATH');
class Book_model extends CI_Model
{
    public function countKategori()
    {
        return $this->db->count_all('tb_kategori');
    }
}
