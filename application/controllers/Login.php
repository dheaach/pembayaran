<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	var $current_db;
	var $db_selected;
    public function __construct()
    {
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('transaction_model');
	}

	public function index()
	{  
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);

		$data = array();

		$data['json_arr'] = json_decode($decrypt, true);
		$data['pg_st'] = 'login';
		$this->load->view("login_new",$data);
	}
	public function aksi_login(){
		$person_no = '';
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		$role = $this->input->post('role');
		$cek = 0;

		$where = array(
			'user_name' => $username,
			'user_pass' => $password
			);

		if($username <> '' AND $password <> '' AND $role <> ''){
			if ($role == 1) {
				$cek = $this->login_model->cek_login("tusers",$where)->num_rows();
				$data['user'] = $this->login_model->getID("tusers",$where);
			}elseif ($role == 2) {
				$cek = $this->login_model->cek_login("tusers_supplier",$where)->num_rows();
				$data['user'] = $this->login_model->getID("tusers_supplier",$where);
				$data['sups'] = $this->login_model->getSup("tusers_supplier",$where);
				$person_no = $data['sups']['person_no'];
				$this->session->set_userdata('person_no',$person_no);
			}

			if($cek > 0){
	 			$person_id = $data['user']['person_id'];

				$data_session = array(
					'nama' => $username,
					'role' => $role,
					'status' => "login",
					'person_id' => $person_id
					);

				$this->session->set_userdata($data_session);
				redirect('overview', 'refresh');
				
			}else{
				echo "<script>
					alert('Username atau Password anda salah! Silahkan coba kembali!');
					window.location.href='login';
					</script>";
			}
		}else{
			echo "<script>
					alert('Gagal! Harap lengkapi data!');
					window.location.href='login';
					</script>";
		}
		
	}
 
	public function logout(){
		if($this->session->userdata('status') != "login"){
			echo "<script>
				alert('Anda harus melakukan login dahulu!');
				window.location.href='login';
				</script>";
		}else{
			$this->session->sess_destroy();
			$this->login_model->close();
			redirect(base_url('login'));
		}
		
	}

	public function database()
	{
		$data['pg_st'] = 'db_login';
		$this->load->view("login_new",$data);
	}
	public function db_config()
	{
		// $username = $this->input->post('username');
		// $password = $this->input->post('pass');

		// if($username <> '' AND $password <>''){
		// 	if($username == 'adm_config' AND $password == 'dbconfigmadura'){
				
				$data_json = file_get_contents('./database.json');
		        $decrypt  = $this->secure->decrypt_url($data_json);

		        $data = array();

		        $data['pg_st'] = 'db_config';
		        $data['conn'] = FALSE;
		        $data['json_arr'] = json_decode($decrypt, true);
				$this->load->view("login_new",$data);
		// 	}else{
		// 		echo "<script>
		// 		alert('Username atau Password salah! Harap login kembali');
		// 		</script>";
		// 		redirect('database', 'refresh');
		// 	}
		// }else{
		// 	echo "<script>
		// 		alert('Gagal! Harap isi data dengan benar!');
		// 		</script>";
		// 	redirect('database', 'refresh');
		// }
	}
	public function db_select()
	{
		$db = $this->input->post('dblist');

		if(!empty($db)) {    
	        foreach($db as $value){
	        	$cl = $this->clear_activedb();
	            $js = $this->setactive($value);
	            if($js == TRUE){
	            	$this->db->reconnect();
	            	$data_json = file_get_contents('./database.json');
			        $decrypt  = $this->secure->decrypt_url($data_json);

			        $data = array();

			        $data['pg_st'] = 'db_config';
			        $data['conn'] = TRUE;
			        $data['json_arr'] = json_decode($decrypt, true);
					$this->load->view("login_new",$data);
	            }else{
	            	echo "<script>
						alert('Gagal aktivasi database!');
					</script>";
					redirect('config', 'refresh');
	            }
	        }
    	}else{
    		echo "<script>
				alert('Silahkan pilih database dahulu!');
				</script>";
			redirect('config', 'refresh');
    	}
	}
	public function readjson()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);
		$json_body = json_encode($json_arr);
		print_r($json_body);
	}
	public function write_setting()
	{
		$hostname = '202.58.200.164';
		$port = '3306';
		$username = 'web_access';
		$password = 'fhsoftware2019';
		$db = 'madura';

		// $hostname = '192.168.100.76';
		// $port = '3306';
		// $username = 'adm_fhs';
		// $password = 'fhsoftware2018';
		// $db = 'madura';

		$all = array();
		$response = array();
	    $posts = array();

	    $dsn[] = array(
		        	"dsn" => "mysql:host=".$hostname.":".$port."; dbname=".$db."; charset=utf8;",
		        	"host" => $hostname,
		        	"port" => $port,
			        "username" => $username,
			        "password" => $password,
			        "default" => '1'
	        );
	    $posts[] = array(
	    	"db"    =>  $db,
	        "setting"   => $dsn
	    );

	    $all[] = array(
	    	"active_db"    =>  $db
	    );
	    //If the json is correct, you can then write the file and load the view
	    $response['database'] = $posts;
	    $response['select'] = $all;
	    $fp = fopen('./database.json', 'w');
	    $json_body = json_encode($response);
	    $content = $this->secure->encrypt_url($json_body);
	    fwrite($fp, $content);

	    if (! write_file('./database.json', $content)){
		        echo "<script>
							alert('Gagal menambahkan database!');
							window.location.href='login';
				</script>";
		}else{
			$data_json = file_get_contents('./database.json');
			$decrypt  = $this->secure->decrypt_url($data_json);
			// decode json to associative array
			$json_arr = json_decode($decrypt, true);
			$json_body = json_encode($json_arr);
			print_r($json_body);
		}   
	}
	public function newdb($dbsel)
	{
		$hostname = '202.58.200.164';
		$port = '3306';
		$username = 'root';
		$password = 'fhsoftware2018';

		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./database.json');
	    $decrypt  = $this->secure->decrypt_url($fp);
	    $posts = json_decode($decrypt, true);

	    $dsn[] = array(
		        	"dsn" => "mysql:host=".$hostname.":".$port."; dbname=".$dbsel."; charset=utf8;",
		        	"host" => $hostname,
		        	"port" => $port,
			        "username" => $username,
			        "password" => $password,
			        "default" => '0'
	    );

	    $post = array(
	    	"db"    => $dbsel,
	        "setting"   => $dsn
	    );

	    array_push($posts['database'],$post);
	 
	    $json_body = json_encode($posts);
	    $content = $this->secure->encrypt_url($json_body);

	    file_put_contents('./database.json', $content);

	    if ( ! write_file('./database.json', $content)){
	        echo "<script>
						alert('Gagal menambahkan database!');
					</script>";
	    }else{

	        $data_json = file_get_contents('./database.json');
			$decrypt  = $this->secure->decrypt_url($data_json);
			// decode json to associative array
			$json_arr = json_decode($decrypt, true);
			$json_body = json_encode($json_arr);
			print_r($json_body);
	    }   
	}
	public function db_delete($name)
	{
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
	public function clear_activedb()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

		// get array index to delete
		foreach($json_arr['select'] as $subKey => $subArray){
            unset($json_arr['select'][$subKey]);
     	}

		// encode array to json and save to file
		$json_body = json_encode($json_arr);
		$content = $this->secure->encrypt_url($json_body);
		file_put_contents('./database.json', $content);

		// print_r($json_body);
	}
	public function setactive($db)
	{
		$posts = array();
	    $post = array();
	    $dsn = array();

	    $fp = file_get_contents('./database.json');
	    $decrypt  = $this->secure->decrypt_url($fp);
	    $posts = json_decode($decrypt, true);

	    $post = array(
	    	"active_db"  => $db
	    );

	    array_push($posts['select'],$post);
	 
	    $json_body = json_encode($posts);
	    $content = $this->secure->encrypt_url($json_body);

	    file_put_contents('./database.json', $content);

	    if ( ! write_file('./database.json', $content)){
	    //     echo "<script>
					// 	alert('Gagal menambahkan database!');
					// </script>";
	    	return false;
	    }else{

	  //       $data_json = file_get_contents('./database.json');
			// $decrypt  = $this->secure->decrypt_url($data_json);
			// // decode json to associative array
			// $json_arr = json_decode($decrypt, true);
			// $json_body = json_encode($json_arr);
			// print_r($json_body);
			return TRUE;
	    }   
	}
	public function default_db()
	{
		$db_selected = '';
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		// decode json to associative array
		$json_arr = json_decode($decrypt, true);

	  	foreach ($json_arr['database'] as $key=>$value) {
	  		$dbs = $value['db'] ;
			foreach ($value['setting'] as $val) {
				if($val['dsn'] == '1'){
					$db_selected = $dbs;
				}
			}
		}
		$this->setactive($db_selected);
		$this->db->reconnect();


	}
	public function configure_database() {
		//read JSON file for active db
		$data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);
        $json_arr = json_decode($decrypt, true);

        foreach($json_arr['select'] as $key=>$value) {
        	$dbact = $value['active_db'];
        }
        foreach ($json_arr['database'] as $key=>$value) {
		    if ($value['db'] == $dbact) {
		        foreach ($value['dsn'] as $val) {
		        	$this->session->set_userdata('hostname',$val['hostname']);
					$this->session->set_userdata('port',$val['port']);
					$this->session->set_userdata('username',$val['username']);
					$this->session->set_userdata('password',$val['password']);
		        }
		    }
		}

		$hostname = $this->session->userdata("hostname");
		$port = $this->session->userdata("port");
		$username = $this->session->userdata("username");
		$password = $this->session->userdata("password");

		$test = $this->transaction_model->testCon($dbact,$hostname,$port,$username,$password);

		if($test == TRUE){
			// write database.php
		    $data_db = file_get_contents('./application/config/database.php');
		    // session_start();
		    $temporary = str_replace("%DBACTIVE%", $dbact, $data_db);
		    // Write the new database.php file
		    $output_path = './application/config/database.php';
		    $handle = fopen($output_path,'w+');
		    // Chmod the file, in case the user forgot
		    @chmod($output_path,0777);
		    // Verify file permissions
		    if(is_writable($output_path)) {
		        // Write the file
		        if(fwrite($handle,$temporary)) {
		        	
		            return true;
		        } else {
		    //     	echo "<script>
						// alert('cannot write');
						// </script>"; 
		            return false;
		        }
		    } else {
		  //   	echo "<script>
				// alert('no permission');
				// </script>"; 
		        return false;
		    }
		}else{
		  //  echo "<script>
				// alert('Koneksi Database Gagal!Harap hubungi administrator!');
				// </script>"; 
			return false;
		}				
	}
}