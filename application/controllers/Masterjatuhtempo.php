<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class Masterjatuhtempo extends IO_Controller
{
    public function getdata() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());

        $where = "";

        if( $q = $this->input->post('q') ) {
            $q = $this->db->escape_str($q);
            $where .= " AND (a.kode LIKE '%{$q}%' OR a.ndays LIKE '%{$q}%')";
        }

        $rs = $this->db->query("SELECT a.top_id as id, a.kode, a.ndays 
                FROM ttop a
                WHERE a.is_delete = 0 {$where}
                ORDER BY a.ndays ASC");

        if( $return['total_count'] = $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $return['items'][] = $row;
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }
}