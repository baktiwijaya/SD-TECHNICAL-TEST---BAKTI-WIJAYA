<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Detail_pertandingan extends CI_Controller {
    private $_table = 'T_DETAIL_PERTANDINGAN';
    private $_table2 = 'T_PERTANDINGAN';
    private $_pk = 'ID';
    private $_module = 'detail_pertandingan';
    public function __construct() {
        parent::__construct();
        is_logged_in();
    }
    public function index() {
        $data['title'] = 'Master Data Detail Pertandingan';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email') ])->row_array();
        $data['content'] = $this->_module.'/index';
        $this->load->view('templates/main', $data);
    }
    public function load_table() {
        $data['list'] = $this->Crud_m->all_data($this->_table2, '*');
        $this->load->view($this->_module . '/table', $data);
    }

    public function load_detail() {
        $id = $this->input->post('id');
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*',$this->_table2,'ID',$id);
        $data['list'] = $this->Crud_m->all_data($this->_table, '*',"ID_PERTANDINGAN=$id");
        $data['gol'] = $this->Crud_m->all_data($this->_table, '*',"ID_PERTANDINGAN=$id AND TIPE = 1");
        $data['offside'] = $this->Crud_m->all_data($this->_table, '*',"ID_PERTANDINGAN=$id AND TIPE = 2");
        $data['pelanggaran'] = $this->Crud_m->all_data($this->_table, '*',"ID_PERTANDINGAN=$id AND TIPE = 3");
        $this->load->view($this->_module . '/detail', $data);
    }
    public function add($id = '') {
        $data['options_tim'] = $this->Options_model->options_tim();
        $data['options_posisi'] = $this->Options_model->options_posisi();
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
        
        $data['ID_TIM']          = $this->input->post('ID_TIM');
        $data['ID_PERTANDINGAN'] = $this->input->post('id');
        $data['ID_ANGGOTA']      = $this->input->post('ID_ANGGOTA');
        $data['WAKTU']           = $this->input->post('WAKTU');
        $data['TIPE']            = $this->input->post('TIPE');
       
            
        $save = $this->Crud_m->add($this->_table, $data);
        if ($save) {
            $message = array(TRUE, 'Berhasil', 'Data Berhasil Ditambah !');
        }
        else {
            $message = array(FALSE, 'Gagal', 'Data Gagal Ditambah !');
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

    public function get_pemain() {
        $id = $this->input->post('id');
        $data = $this->Crud_m->all_data('T_ANGGOTA','*',"ID_TIM=$id");
        echo json_encode($data);
    }
}
?>
