<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function countAll()
    {
        return $this->db->count_all('tb_admin');
    }
}
