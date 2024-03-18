<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dynm_model extends CI_Model {
 function __construct(){
  parent::__construct();
 }

 public function returnQuery($query) {
  if ($query->num_rows() > 0) {
   return $query->result();
  } else {
   return array();
  }
 }

 public function select($dynamicDB) {
  $dynamicDB = $this->load->database($dynamicDB, TRUE);

  $dynamicDB->select('*');
  $dynamicDB->from('tpurchase');
  $dynamicDB->order_by('pur_date', 'DESC');
  $dynamicDB->limit('100');
  $query = $dynamicDB->get();
  return $this->returnQuery($query);
 }
}