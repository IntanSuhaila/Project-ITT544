<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getRole()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $query = $this->db->get();
        return $query->result();
    }

    function delete($id)
    {
        $this->db->where("id", $id);
        $this->db->delete('user_role');
    }
}
