<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class MasterPerkiraan extends IO_Controller
{
    public function getdata() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());

        $where = " is_delete = '0'";

        if( $q = $this->input->post('q') ) {
            $q = $this->db->escape_str($q);
            $where .= " AND (a.rek_kode LIKE '%{$q}%' OR a.rek_nama LIKE '%{$q}%')";
        }

        $rs = $this->db->query("SELECT a.rek_no as id, a.rek_kode, a.rek_nama 
                FROM trek a
                WHERE {$where}
                ORDER BY a.rek_nama ASC");

        if( $return['total_count'] = $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $return['items'][] = $row;
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }
}