<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
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
        $start = date("Y-m-d");
        $end = date("Y-m-d");
        $sts = 0;
        $cr = '';

		$data = array();
		$cari = 0;
        $data['end_date'] = $end;
        $data['start_date'] = $start;
        // $data['start_date'] = date('Y-m-01', strtotime($end_date));
        $data['sts'] = $sts;

        $data['json_arr'] = json_decode($decrypt, true);
        $data['notif'] = $this->transaction_model->shownotiflt($cari,$start,$end,$sts,$cr);
        $data['scr'] = 0;
        $data['cr'] = '';

		$this->load->view("admin/notifikasi",$data);
	}
	public function search()
	{
		$cari = $this->input->post('txt_search');
		$search = $this->input->post('txt_cari');
		$start = $this->input->post('start_date');
		$end = $this->input->post('end_date');
		$sts = $this->input->post('txt_status');

		$data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

		$data = array();

		$data['end_date'] = $end;
        $data['start_date'] = $start;
        $data['json_arr'] = json_decode($decrypt, true);
        $data['notif'] = $this->transaction_model->shownotiflt($cari,$start,$end,$sts,$search);
        $data['scr'] = $cari;
        $data['sts'] = $sts;
        $data['cr'] = $search;

		$this->load->view("admin/notifikasi",$data);
	}
}