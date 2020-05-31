<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array(); 
        $data['content'] = 'menu/index';
        $this->load->view('templates/main', $data);
    }

    function load_table() {
        $data['menu'] = $this->db->get('USER_MENU')->result_array();
        $this->load->view('menu/table',$data);
    }

    function add() {
        $this->load->view('menu/add');
    }

    function save() {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu Gagal ditambah!</div>');
           redirect('menu');
            
        } else {
            $this->db->insert('USER_MENU', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }


    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array();

        $data['content'] = 'menu/submenu';
        $this->load->view('templates/main', $data);
        
    }

    function add_submenu() {
        $data['menu'] = $this->db->get('USER_MENU')->result_array();
        $this->load->view('menu/add_submenu',$data);
    }

    function load_table_submenu() {
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('USER_MENU')->result_array();
        $this->load->view('menu/table_submenu',$data);
    }

    function save_submenu() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('USER_SUB_MENU', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }
}
