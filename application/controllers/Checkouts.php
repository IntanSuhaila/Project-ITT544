<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkouts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('hijab_helper');
        $this->load->library('cart');
        $this->load->model('collection_model');
    }

    function checkout()
    {
        $data['title'] = 'Order Preview';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $custData = $data = array();

        //if order request is submitted
        $submit = $this->input->post('placeOrder');
        if (isset($submit)) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');

            $custData = array(
                'name' => strip_tags($this->input->post('name')),
                'email' => strip_tags($this->input->post('email')),
                'phone' => strip_tags($this->input->post('phone')),
                'address' => strip_tags($this->input->post('address'))
            );

            if ($this->form_validation->run() == true) {
                $insert = $this->collection_model->insertCustomer($custData);

                if ($insert) {
                    // insert order
                    $order = $this->placeOrder($insert);

                    // if the order submission is successful
                    if ($order) {
                        $this->session->set_userdata('success_msg', 'Order placed successfully.');
                        redirect('checkouts/orderSuccess' . $order);
                    } else {
                        $data['error_msg'] = 'Order submission failed, Please try again.';
                    }
                } else {
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }

        // customer data
        $data['custData'] = $custData;

        // retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        // pass collection data to the view
        $this->load->view('checkout/checkout', $data);
        $this->load->view('templates/footer');
    }

    function placeOrder($custID)
    {
        //insert order data
        $ordData = array(
            'customer_id' => $custID,
            'grand_total' => $this->cart->total()
        );
        $insertOrder = $this->collection_model->insertOrder($ordData);

        if ($insertOrder) {
            // retrieve cart data from session
            $cartItems = $this->cart->contents();

            //cart items
            $ordItemData = array();
            $i = 0;
            foreach ($cartItems as $item) {
                $ordItemData[$i]['order_id'] = $insertOrder;
                $ordItemData[$i]['collection_id'] = $item['id'];
                $ordItemData[$i]['quantity'] = $item['qty'];
                $ordItemData[$i]['sub_total'] = $item['subtotal'];
                $i++;
            }

            if (!empty($ordItemData)) {
                //insert order items
                $insertOrderItems = $this->collection_model->insertOrderItems($ordItemData);

                if ($insertOrderItems) {
                    //remove items from cart
                    $this->cart->destroy();

                    //return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }

    function orderSuccess($ordID)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['order'] = $this->collection_model->getOrder($ordID);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('checkout/order-success', $data);
        $this->load->view('templates/footer');
    }
}
