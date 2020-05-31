<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_data()
    {
        $ID_LEVEL2 = $this->session->userdata('level_unit');
        $this->db->select('B.NAMA_PEKERJAAN,IF(D.TARGET IS NULL, 0,D.TARGET) AS TARGET,SUM(IF(E.REALISASI IS NULL, 0,E.REALISASI)) AS REALISASI,B.ID_APP,D.ID_TRX');
        $this->db->from('SETTING_APP_CARD A');
        $this->db->join('MASTER_APP B','A.ID_APP = B.ID_APP','LEFT');
        $this->db->join('MASTER_APP_DELIV C','B.ID_APP = C.ID_APP','LEFT');
        $this->db->join('TRX_SERV_DELIV1 D','C.ID_APP_DELIV = D.ID_APP_DELIV','LEFT');
        $this->db->join('TRX_SERV_DELIV1_DETIL E','D.ID_TRX = E.ID_TRX','LEFT');
        $this->db->where('B.IS_RKAP',1);
        $this->db->where('C.ID_LEVEL2',$ID_LEVEL2);
        $this->db->group_by('B.ID_APP');
        $this->db->order_by('A.CARD','ASC');
        $return = $this->db->get();
        return $return->result_array();
    }

    public function get_data_detail($id)
    {
        $date = date('Y');
        $query = "SELECT * FROM TRX_SERV_DELIV1_DETIL WHERE ID_TRX = '$id'";
        return $this->db->query($query)->result_array();
    }

    public function get_target_cop($tahun) {

        $this->db->select('TARGET_COP');
        $this->db->from('MASTER_TARGET_COP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->TARGET_COP)) {
            return 0;
        } else {
            return $return->TARGET_COP;
        }
    }

    public function get_target_realisasi($tahun) {

        $this->db->select('TARGET_REALISASI');
        $this->db->from('MASTER_TARGET_REALISASI');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->TARGET_REALISASI)) {
            return 0;
        } else {
            return $return->TARGET_REALISASI;
        }
        
    }

    public function get_target_sap($tahun) {

        $this->db->select('TARGET_SAP');
        $this->db->from('MASTER_TARGET_SAP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->TARGET_SAP)) {
            return 0;
        } else {
            return $return->TARGET_SAP;
        }
        
    }

    public function get_target_sinergiap($tahun) {

        $this->db->select('TARGET_AP');
        $this->db->from('MASTER_TARGET_SINERGIAP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->TARGET_AP)) {
            return 0;
        } else {
            return $return->TARGET_AP;
        }
    }

    public function get_target_prognosa($tahun) {

        $this->db->select('TARGET_PROGNOSA');
        $this->db->from('MASTER_TARGET_PROGNOSA');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->TARGET_PROGNOSA)) {
            return 0;
        } else {
            return $return->TARGET_PROGNOSA;
        }
    }

    public function get_realisasi_sap($tahun) {

        $this->db->select('SUM(REAL_REVSAP) AS REAL_REVSAP');
        $this->db->from('TRX_SAP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->REAL_REVSAP)) {
            return 0;
        } else {
            return $return->REAL_REVSAP;
        }
    }

    public function get_realisasi_prognosa($tahun) {

        $this->db->select('SUM(A.REALISASI) AS REALISASI');
        $this->db->from('TRX_PROGNOSA_DETIL A');
        $this->db->join('TRX_PROGNOSA B','A.ID_TRX = B.ID_TRX');
        $this->db->where('B.TAHUN',$tahun);
        $this->db->where('B.ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->REALISASI)) {
            return 0;
        } else {
            return $return->REALISASI;
        }
    }

    public function get_realisasi($tahun) {

        $this->db->select('SUM(A.REALISASI) AS REALISASI');
        $this->db->from('TRX_REALISASI_DETIL A');
        $this->db->join('TRX_REALISASI B','A.ID_TRX = B.ID_TRX');
        $this->db->where('B.TAHUN',$tahun);
        $this->db->where('B.ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->REALISASI)) {
            return 0;
        } else {
            return $return->REALISASI;
        }
    }

    public function get_realisasi_prognosa_detil($tahun) {

        $this->db->select('A.*');
        $this->db->from('TRX_PROGNOSA_DETIL A');
        $this->db->join('TRX_PROGNOSA B','A.ID_TRX = B.ID_TRX');
        $this->db->where('B.TAHUN',$tahun);
        $this->db->where('B.ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->result_array();

        return $return;
    }

    public function get_realisasi_detil($tahun) {

        $this->db->select('A.*');
        $this->db->from('TRX_REALISASI_DETIL A');
        $this->db->join('TRX_REALISASI B','A.ID_TRX = B.ID_TRX');
        $this->db->where('B.TAHUN',$tahun);
        $this->db->where('B.ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->result_array();

        return $return;
    }

    public function get_realisasi_sinergiap($tahun) {

        $this->db->select('SUM(REAL_SINERGIAP) AS REAL_SINERGIAP');
        $this->db->from('TRX_SINERGIAP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->row();

        if(empty($return->REAL_SINERGIAP)) {
            return 0;
        } else {
            return $return->REAL_SINERGIAP;
        }
    }

    public function get_detail_sap($tahun) {

        $this->db->select('*');
        $this->db->from('TRX_SAP');
        $this->db->where('TAHUN',$tahun);
        $this->db->where('ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->result_array();

        return $return;        
    }

    public function get_sinergiap_detail($tahun) {
        $this->db->select('A.*,B.NAMA_CUST AS CUSTOMER');
        $this->db->from('TRX_SINERGIAP A');
        $this->db->join('MASTER_CUST B','A.ID_CUST = B.ID_CUST');
        $this->db->where('A.TAHUN',$tahun);
        $this->db->where('A.ID_LEVEL2',$this->session->userdata('level_unit'));
        $return = $this->db->get()->result_array();

        return $return;
    }

    public function get_aktivasi() {
        $date = date('Y');
        $query = "
            SELECT SUM(C.TARGET) AS TARGET,SUM(C.REALISASI) AS REALISASI FROM (
            SELECT A.TARGET AS TARGET,SUM(IF(B.REALISASI IS NULL, 0,B.REALISASI)) AS REALISASI,DATE_FORMAT(A.TARGET_SELESAI,'%Y-%m-%d') AS TARGET_SELESAI FROM TRX_AKTIVASI A
            LEFT JOIN TRX_AKTIVASI_DETIL B ON A.ID_TRX_AKT = B.ID_TRX_AKT
            GROUP BY A.ID_TRX_AKT
            ORDER BY A.ID_TRX_AKT
            ) C
            WHERE YEAR(C.TARGET_SELESAI) = $date;";
        $sql = $this->db->query($query)->row();
        return $sql;
    }

    public function get_target_aktivasi($id) {
        $date = date('Y');
        $query = "
                SELECT B.NAMA_PEKERJAAN,C.LOKASI, SUM(A.TARGET) FROM TRX_AKTIVASI A
                LEFT JOIN MASTER_AKTIVASI B ON A.ID_AKT = B.ID_AKT
                LEFT JOIN MASTER_LOKASIAKT C ON A.ID_LOKASI = C.ID_LOKASI
                WHERE YEAR(A.TGL_TRX_AKT) = $date AND A.ID_AKT = $id
                ORDER BY A.TARGET DESC;";
        $sql = $this->db->query($query)->result_array();
        return $sql;
    }

    public function get_aktivasi_detail() {
        $date = date('Y');
        $ID_LEVEL2 = $this->session->userdata('level_unit');
        $query = "
                SELECT K.ID_AKT, K.ID_TRX_AKT, MA.NAMA_PEKERJAAN, SUM( K.TARGET ) AS TARGET, SUM(L.REALISASI) AS REALISASI
                FROM TRX_AKTIVASI K
                LEFT JOIN (
                        SELECT A.ID_TRX_AKT, SUM( D.REALISASI ) AS REALISASI 
                        FROM TRX_AKTIVASI A
                        LEFT JOIN TRX_AKTIVASI_DETIL D ON A.ID_TRX_AKT = D.ID_TRX_AKT
                        LEFT JOIN MASTER_AKTIVASI B ON A.ID_AKT = B.ID_AKT
                        LEFT JOIN MASTER_LOKASIAKT C ON A.ID_LOKASI = C.ID_LOKASI 
                        WHERE YEAR ( A.TARGET_SELESAI ) = $date 
                        GROUP BY A.ID_AKT 
                        ORDER BY A.ID_AKT 
                    ) L ON K.ID_TRX_AKT = L.ID_TRX_AKT
                LEFT JOIN MASTER_AKTIVASI MA ON K.ID_AKT = MA.ID_AKT 
                WHERE YEAR ( K.TARGET_SELESAI ) = $date AND K.ID_LEVEL2 = $ID_LEVEL2
                GROUP BY K.ID_AKT";
        $sql = $this->db->query($query)->result_array();
        return $sql;
    }

    public function get_target_detail($id) {
        $date = date('Y');
        $query = "
                    SELECT A.ID_TRX_AKT,A.ID_AKT,C.NAMA_PEKERJAAN,D.LOKASI,A.TARGET AS TARGET,SUM(IF(B.REALISASI IS NULL, 0,B.REALISASI)) AS REALISASI, DATE_FORMAT(A.TARGET_SELESAI,'%d-%m-%Y') AS TARGET_SELESAI FROM TRX_AKTIVASI A
                    LEFT JOIN TRX_AKTIVASI_DETIL B ON A.ID_TRX_AKT = B.ID_TRX_AKT
                    LEFT JOIN MASTER_AKTIVASI C ON A.ID_AKT = C.ID_AKT
                    LEFT JOIN MASTER_LOKASIAKT D ON A.ID_LOKASI = D.ID_LOKASI
                    WHERE YEAR(A.TARGET_SELESAI) = $date AND A.ID_AKT = $id
                    GROUP BY C.ID_AKT,A.ID_TRX_AKT
                    ORDER BY A.ID_TRX_AKT;";
        $sql = $this->db->query($query)->result_array();
        return $sql;
    }

    public function get_target_detail2($id) {
        $query = "
                SELECT DATE_FORMAT(A.TGL_TRX_AKT,'%d-%m-%Y') AS TGL_TRX_AKT,A.REALISASI FROM TRX_AKTIVASI_DETIL A
                WHERE A.ID_TRX_AKT = $id
                ORDER BY A.ID_TRX_AKT;";
        $sql = $this->db->query($query)->result_array();
        return $sql;
    }

    function get_target_service() {
        $query = "SELECT COUNT(ID_APP) AS TOTAL FROM MASTER_APP WHERE IS_RKAP = 1";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }
    function get_real_delivery() {
        $query =  "SELECT COUNT(A.ID_APP_DELIV) AS TOTAL FROM TRX_SERV_DELIV1 A 
                   LEFT JOIN MASTER_APP_DELIV B ON A.ID_APP_DELIV = B.ID_APP_DELIV
                   LEFT JOIN MASTER_APP C ON B.ID_APP = C.ID_APP
                   WHERE C.IS_RKAP = 1 AND ((A.REALISASI / A.TARGET) * 100) >= 100";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }

    function get_collection_period($tahun,$bulan) {
        $query = "CALL collection_period('$tahun','$bulan')";
        $sql = $this->db->query($query);
        $this->db->close();
        return $sql->row_array();
    }
}
