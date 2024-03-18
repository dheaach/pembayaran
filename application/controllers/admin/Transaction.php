<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('transaction_model');
        $this->load->library('upload');
        $this->load->library('MY_Loader');
        $this->load->library('firebase');
	}

	public function index()
	{
        // load view admin/overview.php

        $cari = $this->session->userdata('search_tr');
        $tm = $this->session->userdata('sd_tr');
        $tb = $this->session->userdata('ed_tr');
        $st = $this->session->userdata('status_tr');
        $pj = $this->session->userdata('pajak_tr');
        $sp = $this->session->userdata('supp_tr');

        if($cari <> ''){
            $search = $cari;
        }else{
            $this->session->unset_userdata('search_tr');
            $search = '';
        }

        if($tb <> ''){
            $end_date = date('Y-m-d', strtotime($tb));
        }else{
             $this->session->unset_userdata('ed_tr');
            $end_date = date("Y-m-d");
        }

        if($tm <> ''){
            $start_date = date('Y-m-d', strtotime($tm));
        }else{
            $this->session->unset_userdata('sd_tr');
            $start_date = date('Y-m-01', strtotime($end_date));
        }
        if($st <> ''){
             $status = $st;
        }else{
            $this->session->unset_userdata('status_tr');
            $status = 0;
        }

        if($pj <> ''){
            $pajak = $pj;
        }else{
            $this->session->unset_userdata('pajak_tr');
            $pajak = 0;
        }

        if($sp <> ''){
            $supplier = $sp;
        }else{
            $this->session->unset_userdata('supp_tr');
            $supplier = '';
        }
        
        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);
        $data['transaction'] = $this->transaction_model->tampil($search,$start_date,$end_date,$status,$pajak,$supplier);
        $data['result'] = $this->transaction_model->result($search,$start_date,$end_date,$status,$pajak,$supplier);
        $data['total'] = $this->transaction_model->jumlahTotal($search,$start_date,$end_date,$status,$pajak,$supplier);
        $data['supp'] = $this->transaction_model->getSupplier();
        $data['start_date'] = $start_date;
        $data['end_date'] =  $end_date;
        $data['status'] = $status;
        $data['pajak'] =  $pajak;
        $data['search'] =  $search;
        $data['supplier'] =  $supplier;
        $this->load->view("admin/transaction",$data);
	}
    public function clear()
    {
        $this->session->unset_userdata('search_tr');
        $this->session->unset_userdata('sd_tr');
        $this->session->unset_userdata('ed_tr');
        $this->session->unset_userdata('status_tr');
        $this->session->unset_userdata('pajak_tr');
        $this->session->unset_userdata('supp_tr');

        $this->index();
    }
	public function search()
	{
		$search = $this->input->post('txt_search');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$status = $this->input->post('slc_status');
		$pajak = $this->input->post('slc_pajak');
        $supplier =$this->input->post('slc_supplier');

        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

        $this->session->unset_userdata('search_tr');
        $this->session->unset_userdata('sd_tr');
        $this->session->unset_userdata('ed_tr');
        $this->session->unset_userdata('status_tr');
        $this->session->unset_userdata('pajak_tr');
        $this->session->unset_userdata('supp_tr');

        $sess = array(
          'search_tr' => $search,
          'sd_tr' => $start_date,
          'ed_tr' => $end_date,
          'status_tr' => $status,
          'pajak_tr' => $pajak,
          'supp_tr' => $supplier
        );

        $this->session->set_userdata($sess);

        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);
		$data['transaction'] = $this->transaction_model->tampil($search,$start_date,$end_date,$status,$pajak,$supplier);
        $data['result'] = $this->transaction_model->result($search,$start_date,$end_date,$status,$pajak,$supplier);
		$data['total'] = $this->transaction_model->jumlahTotal($search,$start_date,$end_date,$status,$pajak,$supplier);
        $data['supp'] = $this->transaction_model->getSupplier();
		$data['start_date'] = $start_date;
        $data['end_date'] =  $end_date;
        $data['status'] = $status;
        $data['pajak'] =  $pajak;
        $data['search'] =  $search;
        $data['supplier'] =  $supplier;
        $this->load->view("admin/transaction",$data);
	}
	public function detail($ids)
	{
        $id = base64_decode($ids );
        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);
        $data['transaction_detail'] = $this->transaction_model->detail_trx($id);
        $data['transaction_payment'] = $this->transaction_model->list_pembayaran($id);
        $data['id_inv']=$id;
        // $data['img'] = $this->my_loader->image('/home/admin/tmp/receive_faktur/RF_MJ23.2022024978_ID-110621-141547-4.jpg');
        $this->load->view("admin/transaction_detail",$data);
	}
	public function detail_invoice()
	{
		$id =  base64_decode($this->uri->segment(2));
  		$id_pay =  base64_decode($this->uri->segment(3));
        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();
        $data['json_arr'] = json_decode($decrypt, true);
        $data['detail'] = $this->transaction_model->detail_list_pembayaran($id,$id_pay);
        $data['pembayaran'] = $this->transaction_model->detail_list_pembayaran_nota($id,$id_pay);
        $data['akun'] = $this->transaction_model->detail_list_pembayaran_akun($id,$id_pay);
        $data['byr_ttl'] = $this->transaction_model->nota_sub_total($id,$id_pay);
        $data['akun_ttl'] = $this->transaction_model->akun_sub_total($id,$id_pay);
        $data['id_faktur'] = $id;
        $data['id_pembayaran'] = $id_pay;
        
        $this->load->view("admin/detail_invoice",$data);
	}
    
    public function uploadImage()
    {
        $post = $this->input->post();
        
        $this->transaction_model->insertImage($post);
        $this->transaction_model->insertNotif($post);
    }
    public function deleteImage()
    {
        $post = $this->input->post();
        
        $this->transaction_model->deleteImage($post);
    }
    public function image()
    {
        $ids = '';
        $id = base64_decode($ids );
        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);

        $data = array();

        $data['json_arr'] = json_decode($decrypt, true);

        $data['transaction_detail'] = $this->transaction_model->detail_trx($id);
        $data['transaction_payment'] = $this->transaction_model->list_pembayaran($id);
        $data['id_inv']=$id;

        // $data['img'] = $this->my_loader->image('/home/admin/tmp/receive_faktur/RF_MJ23.2022024978_ID-110621-141547-4.jpg');
        $this->load->view("admin/upload_image",$data);
    }
    public function upload($ids,$person)
    {
        $id = base64_decode($ids );
        $person_dc = base64_decode($person);
        $data_json = file_get_contents('./database.json');
        $decrypt  = $this->secure->decrypt_url($data_json);
        $prn = '';
        $data = array();
        $getid = $this->transaction_model->getidpr($id);
        $data['json_arr'] = json_decode($decrypt, true);
        $data['transaction_detail'] = $this->transaction_model->detail_trx($id);
        foreach($getid as $a){
            $prn = $a->pur_no;
            $prnk = $a->pur_noku;
        }
        
        $data['rec_img'] = $this->transaction_model->get_image(strval($prn),strval($prnk),strval($person_dc),'RF');
        $data['pay_img'] = $this->transaction_model->get_image(strval($prn),strval($prnk),strval($person_dc),'PY');
        $data['pth_img'] = $this->transaction_model->get_image(strval($prn),strval($prnk),strval($person_dc),'NP');
        $data['pjk_img'] = $this->transaction_model->get_image(strval($prn),strval($prnk),strval($person_dc),'PJ');

        $data['id_inv']=$id;

        // print_r($data);
        // $data['img'] = $this->my_loader->image('/home/admin/tmp/receive_faktur/RF_MJ23.2022024978_ID-110621-141547-4.jpg');
        $this->load->view("admin/upload_image",$data);
    }
    public function fetch()
    {
        $role = $this->session->userdata("role");
        $post = $this->input->post(); 
        $notif = $this->transaction_model->shownotif();

        if(!empty($notif) ) {
            foreach ($notif as $abc) {
                $supp = '';
                if($role == 1){
                    $supp = '<span class="font-weight-light">'.$abc->person_name.'</span><br/>';
                }
                $dt = new DateTime($abc->notif_date);
                $date = $dt->format('d/m/Y');
                if($abc->notif_type == 1){
                    $jns = 'Tanda Terima';
                }elseif ($abc->notif_type == 2) {
                    $jns = 'Bukti Pembayaran';
                }elseif ($abc->notif_type == 3) {
                    $jns = 'Nota Putih';
                }elseif($abc->notif_type == 4){
                    $jns = 'Nota Pajak';
                }
                if($abc->is_read == 0){
                    $clr = 'bg-danger';
                }else{
                    $clr = 'bg-primary';
                }
                $id_str = base64_encode(str_replace("&",".",str_replace("@","/",strval($abc->pur_no))));
                $url =  base_url('notifikasi/detail/'.$id_str.'/'.$abc->id);
                $output[] = '
                <a class="dropdown-item d-flex align-items-center" href=" '.$url.'">
                  <div class="mr-3">
                    <div class="icon-circle '.$clr.'">
                      <i class="fas fa-image text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">'.$date.'</div>
                    <span class="font-weight-bold">'.$jns.'</span><br/>
                    '.$supp.'
                    <span class="font-weight-light">Bukti No. Inv '.str_replace("&",".",str_replace("@","/",strval($abc->pur_no))).' sudah diupload!</span>
                  </div>
                </a>';
            }
        }else{
            $output[] = '
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div>
                    <span class="font-weight-bold text-italic">Tidak ada notifikasi </span>
                  </div>
                </a>';
        }
        $jml = $this->transaction_model->showunreadnotif();
        $head = '<h6 class="dropdown-header">
                  Notifikasi
                </h6>';
        $all = base_url('notifikasi');
        $foot = '<a class="dropdown-item text-center small text-gray-500" href="'.$all.'">Lihat semua notifikasi</a>';

        $new_output = $head.' '.implode(" ",$output).' '.$foot;
        if(!empty($jml) ) {
            foreach ($jml as $a) {
               $data = array(
                    'notification' => $new_output,
                    'unseen_notification'  => $a->jml_notif
                ); 
            }
        }

        echo json_encode($data);
    }
    public function sendPajak()
    {
        $post = $this->input->post(); 
        $this->transaction_model->sendDataPajak($post);
    }
    public function notif_detail($ids,$idg)
    {
        $prn = '';
        $this->transaction_model->updatenotif($idg);
        $idc = base64_decode($ids);
        $getid = $this->transaction_model->getidnv($idc);
        if(is_array($getid)){
            foreach($getid as $a){
                $prn = $a->pur_no;
            }
        }
        $this->detail(base64_encode($prn));
    }
}
