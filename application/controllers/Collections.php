<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collections extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('collection_model');
    }

    function collection()
    {
        $data['title'] = 'Collection';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['collection'] = $this->collection_model->getRows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('collections/collection', $data);
        $this->load->view('templates/footer');
    }


    function addToCart($colID)
    {
        $collection = $this->collection_model->getRows($colID);

        $data = array(
            'id' => $collection['id'],
            'qty' => 1,
            'price' => $collection['price'],
            'name' => $collection['name'],
            'image' => $collection['image']
        );
        $this->cart->insert($data);

        redirect('collections/collection');
    }
}
