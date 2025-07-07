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
    public function countByUser($anggota_id, $status)
    {
        $this->db->where('anggota_id', $anggota_id);
        $this->db->where('status', $status);
        return $this->db->count_all_results('tb_pinjam');
    }
    public function getLastHistory($anggota_id, $limit = 5)
    {
        $this->db->where('anggota_id', $anggota_id);
        $this->db->order_by('tgl_pinjam', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('tb_pinjam')->result_array();
    }
    public function getAllTransaksi($keyword = null, $limit = 10, $offset = 0)
    {
        $this->db->select('tb_pinjam.*, tb_buku.title as judul_buku, tb_admin.nama as nama_anggota');
        $this->db->from('tb_pinjam');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('tb_pinjam.pinjam_id', $keyword);
            $this->db->or_like('tb_pinjam.anggota_id', $keyword);
            $this->db->or_like('tb_buku.title', $keyword);
            $this->db->or_like('tb_pinjam.status', $keyword);
            $this->db->group_end();
        }
        $this->db->order_by('tb_pinjam.tgl_pinjam', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }
    public function countAllTransaksi($keyword = null)
    {
        $this->db->from('tb_pinjam');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('tb_pinjam.pinjam_id', $keyword);
            $this->db->or_like('tb_pinjam.anggota_id', $keyword);
            $this->db->or_like('tb_buku.title', $keyword);
            $this->db->or_like('tb_pinjam.status', $keyword);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }
    public function getDetailTransaksi($id)
    {
        $this->db->select('tb_pinjam.*, tb_buku.title as judul_buku, tb_buku.isbn, tb_buku.penerbit, tb_buku.pengarang, tb_admin.nama as nama_anggota, tb_admin.user as username, tb_admin.email, tb_admin.level, tb_denda.denda, tb_denda.lama_waktu, tb_denda.tgl_denda');
        $this->db->from('tb_pinjam');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        $this->db->join('tb_denda', 'tb_denda.pinjam_id = tb_pinjam.pinjam_id', 'left');
        $this->db->where('tb_pinjam.id_pinjam', $id);
        return $this->db->get()->row_array();
    }
    public function insert($data)
    {
        return $this->db->insert('tb_pinjam', $data);
    }
    public function getTelatDipinjam()
    {
        $today = date('Y-m-d');
        $this->db->where('status', 'dipinjam');
        $this->db->where('tgl_balik <', $today);
        return $this->db->get('tb_pinjam')->result_array();
    }
    public function getById($id)
    {
        return $this->db->get_where('tb_pinjam', ['id_pinjam' => $id])->row_array();
    }
    public function update($id, $data)
    {
        $this->db->where('id_pinjam', $id);
        return $this->db->update('tb_pinjam', $data);
    }
    public function getHistoryByUser($anggota_id)
    {
        $this->db->select('tb_pinjam.*, tb_buku.title as judul_buku');
        $this->db->from('tb_pinjam');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->where('tb_pinjam.anggota_id', $anggota_id);
        $this->db->order_by('tb_pinjam.tgl_pinjam', 'DESC');
        return $this->db->get()->result_array();
    }
}
