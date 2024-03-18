<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class Mastergudang extends IO_Controller
{
    public function getdata() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());

        $where = " is_delete = '0'";

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $where .= " AND a.cat_gud_no = '{$this->session->userdata('cat_gudang_no')}'";
        }

        if( $q = $this->input->post('q') ) {
            $q = $this->db->escape_str($q);
            $where .= " AND (a.gud_code LIKE '%{$q}%' OR a.gud_name LIKE '%{$q}%')";
        }

        $rs = $this->db->query("SELECT a.gud_no as id, a.gud_code, a.gud_name 
                FROM tgudang a
                WHERE {$where}
                ORDER BY a.gud_name ASC");

        if( $return['total_count'] = $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $return['items'][] = $row;
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }
}