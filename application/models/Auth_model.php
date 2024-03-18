<?php

class Auth_model extends CI_Model
{
	private $_table1 = "tusers_supplier";
	private $_table2 = "tusers";
	const SESSION_KEY = 'user_id';
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
				'label' => 'Username or Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password, $role)
	{
		if($role == 1){
			$this->db->where('username', $username);
			$query = $this->db->get($this->_table2);
		}elseif ($role == 2) {
			$this->db->where('user_name', $username);
			$query = $this->db->get($this->_table1);
		}
		
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah passwordnya benar?
		if (!password_verify($password, $user->user_pass)) {
			return FALSE;
		}

		// bikin session
		if($role == 1){
			$this->session->set_userdata([self::SESSION_KEY => $user->User_id]);
			$this->_update_last_login($user->User_id,$role);
		}elseif ($role == 2) {
			$this->session->set_userdata([self::SESSION_KEY => $user->id]);
			$this->_update_last_login($user->id,$role);
		}
		
		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);

		
			$query = $this->db->get_where($this->_table1, ['id' => $user_id]);
	
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id,$role)
	{
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		if($role == 1){
			return $this->db->update($this->_table2, $data, ['User_id' => $id]);
		}elseif ($role == 2) {
			return $this->db->update($this->_table1, $data, ['id' => $id]);
		}
		
	}
	
}