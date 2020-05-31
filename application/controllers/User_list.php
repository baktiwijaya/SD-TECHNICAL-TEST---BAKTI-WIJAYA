<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class User_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{	
		$data['title'] = 'Daftar Pengguna';
		 //atas
		$data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email')])->row_array();

        $data['content'] = 'master/user_list/index';
        $this->load->view('templates/main', $data);
	}

	public function load_table() {
		$data['list'] = $this->Crud_m->all_data('USER','*','role_id IN (2,3)');
		$this->load->view('master/user_list/table', $data);
	}

	public function edit() {
		$id = $this->input->post('id');
		$data['id'] = $id;
		$data['detail'] = $this->Crud_m->get_one('*','USER','id',$id);
		$data['options_role'] = $this->Options_model->options_role();
		$data['options_unit'] = $this->Options_model->options_unit();
		
		$this->load->view('master/user_list/edit', $data);
	}

	public function aktifkan() {

		$data['is_active'] = 1;
		$aktif = $this->Crud_m->edit('USER',$data,'id',$this->input->post('id'));

		if($aktif) {
			$message = array(TRUE,'Berhasil','User Berhasil di aktifkan !');
		} else {
			$message = array(FALSE,'Gagal','User Gagal di aktifkan !');
		}

		echo json_encode($message);
	}

	public function nonaktif() {

		$data['is_active'] = 0;
		$aktif = $this->Crud_m->edit('USER',$data,'id',$this->input->post('id'));

		if($aktif) {
			$message = array(TRUE,'Berhasil','User Berhasil di nonaktifkan !');
		} else {
			$message = array(FALSE,'Gagal','User Gagal di nonaktifkan !');
		}

		echo json_encode($message);
	}

	public function save() {
		$data['role_id'] = $this->input->post('role_id');
		$data['level_unit'] = $this->input->post('level_unit');
		$save = $this->Crud_m->edit('USER',$data,'id',$this->input->post('id'));

		if($save) {
			$message = array(TRUE,'Berhasil','User berhasil di set !');
		} else {
			$message = array(FALSE,'Gagal','User gagal di set !');
		}

		echo json_encode($message);
	}
}

?>
