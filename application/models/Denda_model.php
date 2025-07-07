<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Denda_model extends CI_Model
{
    public function getAllDenda($keyword = null, $limit = 10, $offset = 0)
    {
        $this->db->select('tb_denda.*, tb_pinjam.anggota_id, tb_pinjam.pinjam_id, tb_buku.title as judul_buku, tb_admin.nama as nama_anggota');
        $this->db->from('tb_denda');
        $this->db->join('tb_pinjam', 'tb_pinjam.pinjam_id = tb_denda.pinjam_id', 'left');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('tb_denda.pinjam_id', $keyword);
            $this->db->or_like('tb_pinjam.anggota_id', $keyword);
            $this->db->or_like('tb_buku.title', $keyword);
            $this->db->group_end();
        }
        $this->db->order_by('tb_denda.tgl_denda', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }
    public function countAllDenda($keyword = null)
    {
        $this->db->from('tb_denda');
        $this->db->join('tb_pinjam', 'tb_pinjam.pinjam_id = tb_denda.pinjam_id', 'left');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('tb_denda.pinjam_id', $keyword);
            $this->db->or_like('tb_pinjam.anggota_id', $keyword);
            $this->db->or_like('tb_buku.title', $keyword);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }
    public function exists($pinjam_id)
    {
        return $this->db->where('pinjam_id', $pinjam_id)->count_all_results('tb_denda') > 0;
    }
    public function insert($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 'belum lunas';
        }
        return $this->db->insert('tb_denda', $data);
    }
    public function setLunas($id)
    {
        $this->db->where('id_denda', $id);
        return $this->db->update('tb_denda', ['status' => 'lunas']);
    }
    public function getDetailDenda($id)
    {
        $this->db->select('tb_denda.*, tb_pinjam.anggota_id, tb_pinjam.pinjam_id, tb_pinjam.tgl_pinjam, tb_pinjam.tgl_balik, tb_pinjam.tgl_kembali, tb_buku.title as judul_buku, tb_buku.isbn, tb_buku.penerbit, tb_buku.pengarang, tb_admin.nama as nama_anggota, tb_admin.user as username, tb_admin.email, tb_admin.level');
        $this->db->from('tb_denda');
        $this->db->join('tb_pinjam', 'tb_pinjam.pinjam_id = tb_denda.pinjam_id', 'left');
        $this->db->join('tb_buku', 'tb_buku.buku_id = tb_pinjam.buku_id', 'left');
        $this->db->join('tb_admin', 'tb_admin.user = tb_pinjam.anggota_id', 'left');
        $this->db->where('tb_denda.id_denda', $id);
        return $this->db->get()->row_array();
    }
}
