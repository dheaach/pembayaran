<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('profile_model');
	}

	public function index()
	{
        
        $person_id = $this->session->userdata("person_id");
        $role = $this->session->userdata("role");

        $data_json = file_get_contents('./database.json');
		$decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);
        $data['profile'] =  $this->profile_model->getData($person_id,$role)->result();
        
		$this->load->library('form_validation');
		if ($this->input->method() === 'post') {
			// Lakukan validasi sebelum menyimpan ke model
			$rules = $this->profile_model->rules();
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run() === FALSE){
				return $this->load->view('admin/profile',$data);
			}

			$person_id = $this->input->post('person_id');
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$konf = $this->input->post('konfirmasi');

			if ($role == 2) {
				$column = 'id';
				$table = 'tusers_supplier';
			}else{
				$column = 'user_id';
				$table = 'tusers';
			}

			$update = $this->profile_model->updateProfile($user,$pass,$person_id,$column, $table);

			if ($update) {
				echo "<script>
				alert('Data berhasil diubah. Silahkan login ulang!');
				window.location.href='./login/logout';
				</script>";
			}
		}

		$this->load->view("admin/profile",$data);
	}
	// public function download()
	// {
	// 		$filepath1 = FCPATH.'/assets/img/user/ktp.jpg';
	//         $filepath2 = FCPATH.'/assets/img/user/npwp.png';

	//         // Add file
	//         $this->zip->read_file($filepath1);
	//         $this->zip->read_file($filepath2);

	//         // Download
	//         $filename = "user_data.zip";
	//         $this->zip->download($filename);
	        
	//     $data['profile'] =  $this->profile_model->getData($person_id,$role)->result();
 //        $this->load->view("admin/profile",$data);
	// }
	public function download()
	{
        $this->load->helper('download');
        $filepath = FCPATH."../uploads/npwp-suksesjaya.pdf";
        force_download($filepath, NULL);
	}
	
}