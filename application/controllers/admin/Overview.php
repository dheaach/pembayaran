<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('transaction_model');
	}

	public function index()
	{
		$data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);
		$tdm = ltrim(date('m'),0);
		$tdy = date('y');
        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);

        $data['BlmLunas'] = $this->transaction_model->countBlmLunas();
        $data['SdhLunas'] = $this->transaction_model->countSdhLunas();
        $data['FakturPajak'] = $this->transaction_model->countFakturPajak();
        $data['Faktur'] = $this->transaction_model->countTandaTerima();

        $data['chart'] = $this->transaction_model->pembelianDayFilter($tdm,$tdy);
        $data['range']='1';
        $data['sub_range']= $tdm;
        $data['cdb'] = $this->transaction_model->usercdb();
        $this->load->view("admin/overview",$data);
	}
	public function download()
	{
			$filepath1 = FCPATH.'/assets/img/user/ktp.jpg';
	        $filepath2 = FCPATH.'/assets/img/user/npwp.png';

	        // Add file
	        $this->zip->read_file($filepath1);
	        $this->zip->read_file($filepath2);

	        // Download
	        $filename = "user_data.zip";
	        $this->zip->download($filename);
	        
	    $data['BlmLunas'] = $this->transaction_model->countBlmLunas();
	    $data['SdhLunas'] = $this->transaction_model->countSdhLunas();
        $data['FakturPajak'] = $this->transaction_model->countFakturPajak();
        $data['Faktur'] = $this->transaction_model->countTandaTerima();
        $data['tampil'] = $this->transaction_model->showBlmLunas();
        $this->load->view("admin/overview",$data);
	}
	public function chart()
	{
		$data = array();

		$data['BlmLunas'] = $this->transaction_model->countBlmLunas();
		$data['SdhLunas'] = $this->transaction_model->countSdhLunas();
        $data['FakturPajak'] = $this->transaction_model->countFakturPajak();
        $data['Faktur'] = $this->transaction_model->countTandaTerima();

		if (!empty($_POST['day'])) {
			$tdm = ltrim(date('m'),0);
			$tdy = date('y');
			$data['chart'] = $this->transaction_model->pembelianDayFilter($tdm,$tdy);
			$data['range']='1';
			$data['sub_range']= $tdm;
		}else if (!empty($_POST['month'])) {
			$data['chart'] = $this->transaction_model->pembelianMonth();
			$data['range']='2';

		}else if (!empty($_POST['year'])) {
			$data['chart'] = $this->transaction_model->pembelianYear();
			$data['range']='3';
		}

		$this->load->view("admin/overview",$data);
	}
	public function sub_chart()
	{
		$data = array();

		$data['BlmLunas'] = $this->transaction_model->countBlmLunas();
		$data['SdhLunas'] = $this->transaction_model->countSdhLunas();
        $data['FakturPajak'] = $this->transaction_model->countFakturPajak();
        $data['Faktur'] = $this->transaction_model->countTandaTerima();

		if (!empty($_POST['smonth'])) {
			$filter = $this->input->post('smonth');
			$data['chart'] = $this->transaction_model->pembelianDayFilter($filter);
			$data['range']='1';
			$data['sub_range']= $filter;
		}else if (!empty($_POST['syear'])) {
			$filter = $this->input->post('syear');
			$data['chart'] = $this->transaction_model->pembelianMonthFilter($filter);
			$data['range']='2';
		}

		$this->load->view("admin/overview",$data);
	}
	public function write_config()
	{
		$btn = $this->input->post('btn-md');

		$database = $this->input->post('database');
		$hostname = $this->input->post('hostname');
		$port = $this->input->post('port');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($btn == 'send'){
			$test = $this->transaction_model->testCon($database,$hostname,$port,$username,$password);
			if($test == FALSE){
				echo "<script>
				alert('Koneksi Database Gagal!Pastikan data yang di inputkan benar!');
				</script>";
			}else{
				$data_json = file_get_contents('./database.json');
				$decrypt  = $this->secure->decrypt_url($data_json);

		        $json_arr = json_decode($decrypt, true);

		        foreach ($json_arr['database'] as $key=>$value) {
		        	if ($value['db'] == $database) {
		        		foreach ($value['setting'] as $val) {
		        			if ($val['host'] == $hostname) {
		        				$db_exist = TRUE;
		        			}
		        			$db_exist = TRUE;
		        		}
		        	}else{
		        		$db_exist = FALSE;
		        	}
		        }

		        if($db_exist == TRUE){
		        	echo "<script>
					alert('Database sudah terdaftar sebelumnya!');
					</script>";
		        }else{
				    $response = array();
				    $posts = array();
				    $post = array();
				    $dsn = array();

				    $fp = file_get_contents('./database.json');
				    $decrypt  = $this->secure->decrypt_url($fp);
				    $posts = json_decode($decrypt, true);

				    $dsn[] = array(
				    			"dsn" => "mysql:host=".$hostname.":".$port."; dbname=".$database."; charset=utf8;",
					        	"host" => $hostname,
						        "port"     => $port,
						        "username" => $username,
						        "password" => $password,
						        "default" => '0'
				    );

				    $post = array(
				    	"db"    => $database,
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

				        echo "<script>
								alert('Test koneksi berhasil! Database berhasil ditambahkan!');
							</script>";
				    }   
		        }
		    }
		}
		redirect('overview', 'refresh');
	}
}