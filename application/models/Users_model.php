<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Users_model extends CI_Model
{
	function validate()
	{
	   	$this->db->where('user_name', $this->input->post('username'));
	   	$this->db->where('user_pass', $this->input->post('password'));
	   	$this->db->where('is_Super', 1);
	   	$this->db->where('is_delete', 0);

	   	$query = $this->db->get('tusers', 1);
           
	   	if($query->num_rows() != 0)
	   	{          
	   		$row = $query->row_array();
	   		unset($row['password']);
	     	return $row;
	   	}
	   	return false;
	}
}
?>
