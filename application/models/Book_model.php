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

    public function getAvailable()
    {
        $this->db->where('jumlah >', 0);
        return $this->db->get('tb_buku')->result_array();
    }

    public function decrementStock($buku_id)
    {
        $this->db->set('jumlah', 'jumlah-1', false);
        $this->db->where('buku_id', $buku_id);
        $this->db->update('tb_buku');
    }

    public function incrementStock($buku_id)
    {
        $this->db->set('jumlah', 'jumlah+1', false);
        $this->db->where('buku_id', $buku_id);
        $this->db->update('tb_buku');
    }
}
