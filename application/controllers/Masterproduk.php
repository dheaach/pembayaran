<?php

class Masterproduk extends IO_Controller
{
    public function getdata() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());

        $where = " AND is_delete = '0'";

        if( $q = $this->input->post('q') ) {
            $q = $this->db->escape_str($q);
            $where .= " AND (a.prod_code0 LIKE '%{$q}%' OR a.prod_name0 LIKE '%{$q}%' OR a.prod_name1 LIKE '%{$q}%')";
        }

        $rs = $this->db->query("SELECT a.prod_no as id, a.prod_code0, a.prod_name0 
                FROM tproduct a
                WHERE a.is_delete = 0 {$where}
                ORDER BY a.prod_code0 ASC");

        if( $return['total_count'] = $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $return['items'][] = $row;
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }

    public function getdatasubitem() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());
        $table = "";

        switch ($this->input->post('item')) {
            case 1:
                $this->db->select('cat_id as id, kode, nama');
                $table = "tcat";
            break;
            case 2:
                $this->db->select('group_id as id, kode, nama');
                $table = "tgroup";
                break;
            case 3:
                $this->db->select('varian_id as id, kode, nama');
                $table = "tvarian";
                break;
            case 4:
                $this->db->select('merk_id as id, kode, nama');
                $table = "tm_merk";
                break;
            case 5:
                $this->db->select('rak_id as id, kode, nama');
                $table = "tm_rak";
                break;
            case 6:
                $this->db->select('rak_gudang as id, kode, nama');
                $table = "tm_rak_gudang";
                break;
        }

        if( $table ) {
            $this->db->where('is_delete', 0);

            if( $q = $this->input->post('q') ) {
                $q = $this->db->escape_str($q);
                $this->db->where("(kode LIKE '%{$q}%' OR nama LIKE '%{$q}%')");
            }

            $this->db->order_by('nama', 'ASC');
            $rs = $this->db->get($table);

            if( $return['total_count'] = $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $return['items'][] = $row;
                }
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }

}