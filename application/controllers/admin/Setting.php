<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->library('BreadcrumsComp'); 
		$this->load->model('setting_model');
		$this->load->model('transaction_model');
	}

	public function index()
	{
		$data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

		$data = array();
		// $this->breadcrumscomp->add('Setting', base_url().'setting');
		// $data['breadcrumb'] = $this->breadcrumscomp->output();
		$breadcrumb         = array(
            "Setting" => ''
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['json_arr'] = json_decode($decrypt, true);
        
		$this->load->view("admin/setting",$data);
	}
	public function database()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();
        $data['json_arr'] = json_decode($decrypt, true);

		// $this->breadcrumscomp->add('Setting', base_url().'setting');
		// $this->breadcrumscomp->add('Database', base_url().'setting/database');

		// $data['breadcrumb'] = $this->breadcrumscomp->output();
		$breadcrumb         = array(
            "Setting" => 'setting',
            "Database" => '',
        );
        $data['breadcrumb'] = $breadcrumb;

		$this->load->view("admin/setting_db",$data);
	}
	public function db_update()
	{
		$database = $this->input->post('database');
		$hostname = $this->input->post('hostname');
		$port = $this->input->post('port');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// read file
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);
		
		$test = $this->transaction_model->testCon($database,$hostname,$port,$username,$password);
			if($test == FALSE){
				echo "<script>
				alert('Koneksi Database Gagal!Pastikan data yang di inputkan benar!');
				</script>";
			}else{
		// encode array to json and save to file
				foreach ($json_arr['database'] as &$key) {
				    if ($key['db'] == $database) {
				    	foreach ($key['setting'] as &$val) {
				    		$val['dsn'] = "mysql:host=".$hostname.":".$port."; dbname=".$database."; charset=utf8;";
					    	$val['host'] = $hostname;
					    	$val['port'] = $port;
					    	$val['username'] = $username;
					    	$val['password'] = $password;
					    	$val['default'] = '0';
					    }
				    }
				}
				$json_body = json_encode($json_arr);
				$content = $this->secure->encrypt_url($json_body);
				file_put_contents('./database.json', $content);

				redirect('setting/database', 'refresh');
			}
	}
	public function db_delete()
	{
		$name = $this->input->post('database');
		// get array index to delete
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

		// get array index to delete
		foreach($json_arr['database'] as $subKey => $subArray){
          if($subArray['db'] == $name){
               unset($json_arr['database'][$subKey]);
          }
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		$content = $this->secure->encrypt_url($json_body);
		file_put_contents('./database.json', $content);

		redirect('setting/database', 'refresh');
	}
}