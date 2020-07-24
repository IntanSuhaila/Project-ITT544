<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('collection_model');
    }

    function cart()
    {
        $data['title'] = 'Cart';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $data = array();
        $data['cartItems'] = $this->cart->contents();

        $this->load->view('cart/cart', $data);
        $this->load->view('templates/footer');
    }

    function updateItemQty()
    {
        $update = 0;

        //Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');

        //Update item in the cart
        if (!empty($rowid) && !empty($qty)) {
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty
            );
        }

        echo $update ? 'ok' : 'err';
    }

    function removeItem($rowid)
    {
        $remove = $this->cart->remove($rowid);

        redirect('carts/cart');
    }
}
