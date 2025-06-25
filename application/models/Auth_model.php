<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /**
     * Ambil data user berdasarkan username
     */
    public function getUser($user)
    {
        return $this->db->where('user', $user)
            ->get('tb_admin')
            ->row_array();
    }

    /**
     * Register user baru
     */
    public function registerUser($data)
    {
        return $this->db->insert('tb_admin', $data);
    }
}
