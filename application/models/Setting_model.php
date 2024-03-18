<?php 
 
class Setting_model extends CI_Model{	
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
	public function rules()
	{

	}
}