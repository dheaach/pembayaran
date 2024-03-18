<?php 
 
class Profile_model extends CI_Model{	
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
		return [
			[
				'field' => 'username', 
				'label' => 'Username', 
				'rules' => 'required'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'required'
			],
			[

				'field' => 'konfirmasi', 
				'label' => 'Konfirmasi Password', 
				'rules' => 'required'
			]
		];
	}

	public function getData($person_id,$role)
	{
		if($role == 2) {
			$where = array('tusers_supplier.id' => $person_id);

			$this->db->select('tusers_supplier.id AS person_id,
							   tusers_supplier.user_name,
							   tusers_supplier.user_pass');
			$this->db->from('tusers_supplier');

	  		$this->db->where($where);
		}elseif ($role == 1) {
			$where = array('tusers.user_id' => $person_id);

			$this->db->select('tusers.User_id AS person_id,
							   tusers.user_name,
							   tusers.user_pass');
			$this->db->from('tusers');
	  		$this->db->where($where);
		}

	  	$query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        
	        return $query;
	    }
	}

	public function updateProfile($user,$new_pass, $person_id,$column, $table)
	{
	    $data = array(
	           'user_pass' => $new_pass,
	           'user_name' => $user
	        );
	    $this->db->where($column, $person_id);
	    $this->db->update($table, $data);

	    return true;
	}
}