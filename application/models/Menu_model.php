<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu
                  FROM user_sub_menu JOIN user_menu
                  ON user_sub_menu.menu_id = user_menu.id
        ";
        return $this->db->query($query)->result_array();
    }

    function delete($id)
    {
        $this->db->where("id", $id);
        $this->db->delete('user_sub_menu');
    }

    function edit($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    function getById($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get('user_sub_menu');
        return $query->row();
    }

    function deleteMenu($id)
    {
        $this->db->where("id", $id);
        $this->db->delete('user_menu');
    }
}
