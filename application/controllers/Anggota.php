<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Anggota extends CI_Controller {
    private $_table = 'T_ANGGOTA';
    private $_pk = 'ID';
    private $_module = 'anggota';
    public function __construct() {
        parent::__construct();
        is_logged_in();
    }
    public function index() {
        $data['title'] = 'Master Data Anggota Tim';
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
        
        $data['ID_TIM']         = $this->input->post('ID_TIM');
        $data['NAMA_ANGGOTA']   = $this->input->post('NAMA_ANGGOTA');
        $data['TINGGI_BADAN']   = $this->input->post('TINGGI_BADAN');
        $data['BERAT_BADAN'] 	= $this->input->post('BERAT_BADAN');
        $data['POSISI']         = $this->input->post('POSISI');
        $data['NOMOR_PUNGGUNG'] = $this->input->post('NOMOR_PUNGGUNG');
        $id                     = $this->input->post('id');
        if ($id == '') {
            $data['TGL_CREATE'] = date('Y-m-d H:i:s');
            $exist = $this->Global_m->isExists2Key('NOMOR_PUNGGUNG', $this->input->post('NOMOR_PUNGGUNG'), 'ID_TIM', $this->input->post('ID_TIM'), $this->_table);
            if($exist) {
                $message = array(FALSE, 'Gagal', 'Nomor Punggung telah tersedia !');
            } else {
                $save = $this->Crud_m->add($this->_table, $data);
                if ($save) {
                    $message = array(TRUE, 'Berhasil', 'Data Berhasil Ditambah !');
                }
                else {
                    $message = array(FALSE, 'Gagal', 'Data Gagal Ditambah !');
                }
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
