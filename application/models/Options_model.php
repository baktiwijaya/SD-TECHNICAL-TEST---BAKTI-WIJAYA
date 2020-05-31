<?php

class Options_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function options_tim() {
        $list = $this->db->get('T_TIM');
        $option = array();
        $option[''] = '-- Pilih Tim --';
        foreach ($list->result() as $row) {
            $option[$row->ID] = $row->NAMA_TIM;
        }
        $this->db->close();
        return $option;
    }
    
    public function options_tahun() {
        $option = array();
        $option[''] = '-- Pilih Tahun --';
        $option['2018'] = '2018';
        $option['2019'] = '2019';
        $option['2020'] = '2020';
        $option['2021'] = '2021';
        $option['2022'] = '2022';
        $option['2023'] = '2023';
        return $option;
    }
    
    public function options_posisi() {
       
        $option = array();
        $option[''] = '-- Pilih Posisi --';
        $option['1'] = 'Penyerang';
        $option['2'] = 'Gelandang';
        $option['3'] = 'Bertahan';
        $option['4'] = 'Penjaga Gawang';
       
        return $option;
    }

    
}

