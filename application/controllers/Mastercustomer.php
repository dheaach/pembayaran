<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class Mastercustomer extends IO_Controller
{
    public function getdata() {
        $return = array('total_count' => 0, 'incomplete_results' => false, 'items' => array());

        $where = " AND person_type = '0'";

        if( $q = $this->input->post('q') ) {
            $q = $this->db->escape_str($q);
            $where .= " AND (a.person_code LIKE '%{$q}%' OR a.person_name LIKE '%{$q}%')";
        }

        $rs = $this->db->query("SELECT a.person_no as id, a.person_code, a.person_name 
                FROM tperson a
                WHERE a.is_delete = 0 {$where}
                ORDER BY a.person_name ASC");

        if( $return['total_count'] = $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $return['items'][] = $row;
            }
        }

        header('Content_Type:application/json');
        echo json_encode($return);
    }
}