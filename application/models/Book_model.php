<?php
if (!defined('BASEPATH')) exit('BASEPATH');
class Book_model extends CI_Model
{
    public function countKategori()
    {
        return $this->db->count_all('tb_kategori');
    }

    public function getAll($keyword = null, $limit = 10, $offset = 0)
    {
        if ($keyword) {
            $this->db->like('title', $keyword);
            $this->db->or_like('isbn', $keyword);
            $this->db->or_like('penerbit', $keyword);
            $this->db->or_like('pengarang', $keyword);
        }
        $this->db->limit($limit, $offset);
        return $this->db->get('tb_buku')->result_array();
    }

    public function countAll($keyword = null)
    {
        if ($keyword) {
            $this->db->like('title', $keyword);
            $this->db->or_like('isbn', $keyword);
            $this->db->or_like('penerbit', $keyword);
            $this->db->or_like('pengarang', $keyword);
        }
        return $this->db->count_all_results('tb_buku');
    }
}
