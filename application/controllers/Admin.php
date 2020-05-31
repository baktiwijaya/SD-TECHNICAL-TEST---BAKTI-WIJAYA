<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array();
        $data['content'] = 'admin/index';
        $this->load->view('templates/main',$data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('USER_ROLE')->result_array();
        $this->form_validation->set_rules('role', 'User Role', 'required');
        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),
            ];
            $this->db->insert('USER_ROLE', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil ditambah !</div>');
            redirect('admin/role');
        }
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('USER_ROLE', ['id' => $role_id])->row_array();

        $data['menu'] = $this->db->get('USER_MENU')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('USER_ACCESS_MENU', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('USER_ACCESS_MENU', $data);
        } else {
            $this->db->delete('USER_ACCESS_MENU', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function delete($id) {
        $this->db->where('id',$id);
        $this->db->delete('USER_ROLE');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
        redirect('admin/role');
    }
}
