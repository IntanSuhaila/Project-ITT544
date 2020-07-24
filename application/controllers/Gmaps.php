<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gmaps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
    }

    public function maps()
    {
        $data['title'] = 'Location';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->library('googlemaps');

        $config['center'] = '2.962049, 101.757281';
        $config['zoom'] = '10';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '2.962049, 101.757281';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        $this->load->view('gmaps/maps', $data);
        $this->load->view('templates/footer');
    }
}
