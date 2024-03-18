<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by Captjinx.
 * User: captjinx
 * Date: 2/9/2019
 * Time: 4:46 PM
 */

class IO_Controller extends CI_Controller
{
    var $data;

    public function __construct(){
        parent::__construct();
        $this->global_model->is_logged_in();
        $this->data['cabang'] = $this->_get_cabang();
    }

    protected function _get_cabang() {
        $this->db->select('cat_gud_no, kode, nama');
        $this->db->where('is_delete', 0);
        $rs = $this->db->get('tcat_gudang');
        if( $rs->num_rows() ) {
            return $rs->result_array();
        }
        return null;
    }

}
/* Location: ./application/core/IO_Controller.php */