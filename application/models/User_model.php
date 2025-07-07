<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function countAll()
    {
        return $this->db->count_all('tb_admin');
    }

    public function getAll($keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('user', $keyword);
            $this->db->or_like('email', $keyword);
        }
        return $this->db->get('tb_admin')->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('tb_admin', ['id_login' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('tb_admin', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_login', $id);
        return $this->db->update('tb_admin', $data);
    }

    public function delete($id)
    {
        $user = $this->getById($id);
        if ($user && $user['foto'] && file_exists('./uploads/foto/' . $user['foto'])) {
            @unlink('./uploads/foto/' . $user['foto']);
        }
        $this->db->where('id_login', $id);
        return $this->db->delete('tb_admin');
    }

    public function getAllByLevel($level)
    {
        $this->db->where('level', $level);
        return $this->db->get('tb_admin')->result_array();
    }

    public function getByUsername($username)
    {
        return $this->db->get_where('tb_admin', ['user' => $username])->row_array();
    }
}
