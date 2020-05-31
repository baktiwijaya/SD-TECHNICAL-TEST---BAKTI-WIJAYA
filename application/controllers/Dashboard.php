<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        is_logged_in();
    }
    public function index() {
        $data['title'] = 'Dashboard';
   
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email') ])->row_array();
        $data['content'] = 'dashboard/dashboard/index';
        $this->load->view('templates/main', $data);
    }

}

