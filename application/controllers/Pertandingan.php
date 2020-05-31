<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pertandingan extends CI_Controller {
    private $_table = 'T_PERTANDINGAN';
    private $_pk = 'ID';
    private $_module = 'pertandingan';
    public function __construct() {
        parent::__construct();
        is_logged_in();
    }
    public function index() {
        $data['title'] = 'Master Data Pertandingan';
        $data['user'] = $this->db->get_where('USER', ['email' => $this->session->userdata('email') ])->row_array();
        $data['content'] = $this->_module.'/index';
        $this->load->view('templates/main', $data);
    }
    public function load_table() {
        $data['list'] = $this->Crud_m->all_data($this->_table, '*');
        $this->load->view($this->_module . '/table', $data);
    }
    public function add($id = '') {
        $data['options_tim'] = $this->Options_model->options_tim();
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

        $date2                        = date_create($this->input->post('JADWAL_PERTANDINGAN'));
        $data['TANGGAL_PERTANDINGAN'] = date_format($date2,"Y-m-d");
        $data['JAM_PERTANDINGAN']     = $this->input->post('JAM_PERTANDINGAN');
        $data['TUAN_RUMAH']           = $this->input->post('TUAN_RUMAH');
        $data['TAMU']                 = $this->input->post('TAMU');
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
