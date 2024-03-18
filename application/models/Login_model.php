<?php 
 
class Login_model extends CI_Model{	
	var $current_db;

	public function __construct(){
	    parent::__construct();
	    $this->load->library('Db_manager');
	    $db = $this->session->userdata('db_active');
	    if($this->session->userdata('status') == "login"){
			$hostname = $this->session->userdata('hostname');
			$port = $this->session->userdata('port');
			$username = $this->session->userdata('username');
			$password = $this->session->userdata('password');

		    $this->current_db = $this->db_manager->get_connection($db,$hostname,$port,$username,$password);
		}else{
			$this->db_manager->close_connection($db);
		} 
	    
	}
	public function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	public function getID($table,$where)
	{
		if($table == 'tusers_supplier') {
			$this->db->select('tusers_supplier.id AS person_id');
		}elseif ($table == 'tusers') {
			$this->db->select('tusers.User_id AS person_id');
		}

	  	$this->db->from($table);
	  	$this->db->where($where);

	  	$query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->row_array();
	        return $row;
	    }
	}
	
	public function getSup($table,$where)
	{
		if($table == 'tusers_supplier') {
			$this->db->select('tusers_supplier.person_no');
		}

	  	$this->db->from($table);
	  	$this->db->where($where);

	  	$query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->row_array();
	        return $row;
	    }
	}

	public function close()
	{
		$this->db->close();
	}
}