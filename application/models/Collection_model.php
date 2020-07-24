<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collection_model extends CI_Model
{
    function __construct()
    {
        $this->colTable = 'collection';
        $this->custTable = 'customers';
        $this->ordTable = 'orders';
        $this->ordItemsTable = 'order_items';
    }

    public function getRows($id = '')
    {
        $this->db->select('*');
        $this->db->from($this->colTable);
        $this->db->where('status', '1');

        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        return !empty($result) ? $result : false;
    }

    public function getOrder($id)
    {
        $this->db->select('o.*, c.name, c.email, c.phone, c.address');
        $this->db->from($this->ordTable . ' as o');
        $this->db->join($this->custTable . ' as c', 'c.id = o.customer_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        //get order items
        $this->db->select('i.*, c.image, c.name, c.price');
        $this->db->from($this->ordItemsTable . ' as i');
        $this->db->join($this->colTable . ' as c', 'c.id = i.collection_id', 'left');
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)
            ? $query2->result_array() : array();

        return !empty($result) ? $result : false;
    }

    public function insertCustomer($data)
    {
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        $insert = $this->db->insert($this->custTable, $data);

        return $insert ? $this->db->insert_id() : false;
    }

    public function insertOrder($data)
    {
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }

        //insert order data
        $insert = $this->db->insert($this->ordTable, $data);

        return $insert ? $this->db->insert_id() : false;
    }

    public function insertOrderItems($data = array())
    {
        //insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);

        //return status
        return $insert ? true : false;
    }
}
