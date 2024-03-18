<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mongo extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('transaction_model');
        $this->load->library('upload');
        $this->load->library('MY_Loader');
        $this->load->library('Mongo_db');
	}

	public function index()
	{
        // load view admin/overview.php
        $end_date = date("Y-m-d");
		$start_date = date('Y-m-01', strtotime($end_date));
        $search = '';
        $status = 0;
        $pajak = 0;
        $supplier = '';
        
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
    public function test()
    {
        $this->load->view("admin/test");
    }

    public function read_rf($file_path)
    {
             // validate $file here, very important!
            // $path = '/home/admin/tmp/receive_faktur/'.$file;
            // $mime = mime_content_type($file); //<-- detect file type
            // header("Content-Type: ".$mime); //<-- send mime-type header
            // // $img = $this->my_loader->image('/home/admin/tmp/receive_faktur/RF_MJ23.2022024978_ID-110621-141547-4.jpg', TRUE);
            // readfile($path);

        $this->helper('file');

        $image_content = read_file($file_path);

        header('Content-Length: '.strlen($image_content)); // sends filesize header
        header('Content-Type: '.$mime_type_or_return); // send mime-type header
        header('Content-Disposition: inline; filename="'.basename($file_path).'";'); // sends filename header
        return $image_content;
    }
    public function read_py($file)
    {
             $path = '/home/admin/tmp/payment/' . $file;
             $mime = mime_content_type($file);
             header("Content-Type: $mime");
             readfile($path);
    }
    public function read_pt($file)
    {
             $path = '/home/admin/tmp/nota_putih/' . $file;
             $mime = mime_content_type($file);
             header("Content-Type: $mime");
             readfile($path);
    }
    public function read_pj($file)
    {
             $path = '/home/admin/tmp/nota_pajak/' . $file;
             $mime = mime_content_type($file);
             header("Content-Type: $mime");
             readfile($path);
    }
    public function uploadSup()
    {
        $pur_no = $this->input->post('pur_noku');
        $person_no = $this->input->post('person_no');
        
        if (isset($_POST['putih'])) {
           if($_FILES['img-putih']['size'] >= 5097152){
                echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
            }else{
                $temp = explode(".", $_FILES["img-putih"]["name"]);
                $newfilename = 'PT_' . $pur_no . '_' . $person_no . '.' . end($temp);
                move_uploaded_file($_FILES["img-putih"]["tmp_name"], "/home/admin/tmp/nota_putih/" . $newfilename);
            }
        }elseif (isset($_POST['pajak'])) {
            if($_FILES['img-pajak']['size'] >= 5097152){
                echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
            }else{
               $temp = explode(".", $_FILES["img-pajak"]["name"]);
                $newfilename = 'PJ_' . $pur_no . '_' . $person_no . '.' . end($temp);
                move_uploaded_file($_FILES["img-pajak"]["tmp_name"], "/home/admin/tmp/nota_pajak/" . $newfilename); 
            }   
        }
        $id =  base64_encode($pur_no);
        redirect(base_url()."transaction-detail/".$id);

    }
    public function uploadCus()
    {
       
        $pur_no = $this->input->post('pur_noku');
        $person_no = $this->input->post('person_no');
        
        if (isset($_POST['receive'])) {
            if($_FILES['img-receive']['size'] >= 5097152){
                echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
            }else{
                $temp = explode(".", $_FILES["img-receive"]["name"]);
                $newfilename = 'RF_' . $pur_no . '_' . $person_no . '.' . end($temp);
                move_uploaded_file($_FILES["img-receive"]["tmp_name"], "/home/admin/tmp/receive_faktur/" . $newfilename);

            }
            
        }elseif (isset($_POST['payment'])) {
            if($_FILES['img-pay']['size'] >= 5097152){
                echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
            }else{
               $temp = explode(".", $_FILES["img-pay"]["name"]);
                $newfilename = 'PY_' . $pur_no . '_' . $person_no . '.' . end($temp);
                move_uploaded_file($_FILES["img-pay"]["tmp_name"], "/home/admin/tmp/payment" . $newfilename); 

            }   
        }

        // $error = error_get_last();
        
        //     echo "<script>
        //         alert(".$error.");
        //         </script>";
        $id =  base64_encode($pur_no);
        redirect(base_url()."transaction-detail/".$id);
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
    public function upload($ids)
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
        $this->load->view("admin/upload_image",$data);
    }
    public function testConn()
    {

    }
}