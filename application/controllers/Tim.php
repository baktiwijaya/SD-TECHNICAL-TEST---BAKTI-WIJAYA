<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tim extends CI_Controller {
    private $_table = 'T_TIM';
    private $_pk = 'ID';
    private $_module = 'tim';
    public function __construct() {
        parent::__construct();
        is_logged_in();
    }
    public function index() {
        $data['title'] = 'Master Data Tim';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email') ])->row_array();
        $data['content'] = $this->_module.'/index';
        $this->load->view('templates/main', $data);
    }
    public function load_table() {
        $data['list'] = $this->Crud_m->all_data($this->_table, '*');
        $this->load->view($this->_module . '/table', $data);
    }
    public function add($id = '') {
    if ($id != '') {

            $data['detail'] = $this->Crud_m->get_one('*', $this->_table, $this->_pk, (int)$id);
            $data['id'] = $id;
        }
        else {
            $data['id'] = '';
        }
        $this->load->view($this->_module . '/add', $data);
    }
    public function edit() {
        $id = $this->input->post('id');
        $this->add($id);
    }
    public function save() {

        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        if($upload1 != '') {
            $config['upload_path']          = './uploads/logo';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $data1 = $this->upload->data();
            $this->upload->do_upload('gambar');

            $image = $data1['file_name'];
        } else {
            $image = '';
        }
        $data['NAMA_TIM']      = $this->input->post('NAMA_TIM');
        $data['LOGO_TIM']      = $image;
        $data['TAHUN_BERDIRI'] = $this->input->post('TAHUN_BERDIRI');
        $data['ALAMAT'] 	   = $this->input->post('ALAMAT');
        $data['KOTA_MARKAS']   = $this->input->post('KOTA_MARKAS');
        $id = $this->input->post('id');
        if ($id == '') {
            $data['TGL_CREATE'] = date('Y-m-d H:i:s');
            $save = $this->Crud_m->add($this->_table, $data);
            if ($save) {
                $message = array(TRUE, 'Berhasil', 'Data Berhasil Ditambah !');
            }
            else {
                $message = array(FALSE, 'Gagal', 'Data Gagal Ditambah !');
            }
        }
        else {
            $save = $this->Crud_m->edit($this->_table, $data, $this->_pk, $id);
            if ($save) {
                $message = array(TRUE, 'Berhasil', 'Data Berhasil Diubah !');
            }
            else {
                $message = array(FALSE, 'Gagal', 'Data Gagal Diubah !');
            }
        }
        echo json_encode($message);
    }
    public function delete() {
        $id = $this->input->post('id');
        $delete = $this->Crud_m->delete($this->_table, $this->_pk, $id);
        if ($delete) {
            $message = array(TRUE, 'Berhasil', 'Data Berhasil Dihapus !');
        }
        else {
            $message = array(FALSE, 'Gagal', 'Data Gagal Dihapus !');
        }
        echo json_encode($message);
    }
}
?>
