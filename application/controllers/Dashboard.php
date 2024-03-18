<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends IO_Controller {

	function __construct()
	{
		parent::__construct();
    }

	public function index()
	{

		$supplier = $this->checkRoleSupplier();
		if( empty($supplier) ) {
			$this->data['title'] = 'FHSoftware Dashboard';
			$this->data['content'] = "dashboard";
			$this->data['additional_js'] = '<script src="'.base_url().'assets/app/js/dashboard.js" type="text/javascript"></script>';
			$this->load->view('template', $this->data);
		}
		else {
			$this->data['title'] = 'FHSoftware Dashboard';
			$this->data['content'] = "dashboard_supplier";
			$this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
			$this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
				. '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
				. '<script src="'.base_url().'assets/app/js/dashboard_supplier.js" type="text/javascript"></script>'
				. '<script>'
				. 'jQuery(document).ready(function() {'
				. 'Dashboard_supplier.init();'
				. '});'
            	. '</script>';
			$this->load->view('template_supplier', $this->data);
		}
        
	}

	protected function checkRoleSupplier() {
		return $this->session->userdata('login_role');
	}

	public function changecabang() {
	    $return = array('success' => false);
	    if( $cabang = $this->input->post('params') ) {
            $this->session->set_userdata('cat_gudang_no', $cabang);
            $return['success'] = true;
        }
        header('Content-Type:application/json');
	    echo json_encode($return);
	}
	
	public function getdatadashboard() {
		$return = array('success' => false);
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		if( $startdate && $enddate ) {

			$sd = date('Y-m-d', strtotime($startdate))." 00:00:00";
			$ed = date('Y-m-d', strtotime($enddate))." 23:59:59";

			$this->db->start_cache();
			
			if( $this->session->userdata('cat_gudang_no') != "all" ) {
				$this->db->where('cab_no', $this->session->userdata('cat_gudang_no'));
			}
			
			$this->db->where('is_delete', 0);
			$this->db->where('jual_type', 1);
			$this->db->where("jual_date BETWEEN '{$sd}' AND '{$ed}'");

			$this->db->stop_cache();

			
			$rs = $this->db->count_all_results('tsales');
			$return['transaksi_penjualan'] = $rs;
			$return['transaksi_penjualan_format'] = number_format($rs,0);

			$this->db->select_sum('jual_total_kurs', 'total_jual');
			$rs = $this->db->get('tsales');

			$return['total_omset'] = $rs->row()->total_jual;
			$return['total_omset_format'] = number_format($rs->row()->total_jual, 2);
			
			$return['avg_penjualan'] = $return['total_omset'] / $return['transaksi_penjualan'];
			$return['avg_penjualan_format'] = number_format($return['avg_penjualan'],2);

			$diff  = date_diff(date_create($startdate), date_create($enddate));
			
			// $return['sd'] = $startdate;
			// $return['ed'] = $enddate;
			// $return['datediff'] = $diff;
			
			$datediff = ($diff->days + 1);

			if( $datediff == 1 ) {
				for($i = 1; $i < 25; $i++ ) {
					$return['label1'][] = substr("0".$i, -2).":00";
					$return['data1'][] = 0;
				}
				
				$this->db->select("DATE_FORMAT(jual_date, '%H') as tgl, count(*) AS total, sum(jual_total_kurs) as penjualan");
				$this->db->group_by('1');
				$rs = $this->db->get('tsales');
				if( $rs->num_rows() ) {
					foreach($rs->result_array() as $row) {
						$return['data1'][$row['tgl'] - 1] = $row['total'];
					}
				}

			}
			else {

				$label1 = array();
				$data1 = array();
				
				for($i = 0; $i < $datediff; $i++) {
					$date = date('Y-m-d', strtotime($startdate."+".$i." days"));
					$label1[] = $date;
					$data1[$date] = 0;
				}

				$this->db->select("DATE_FORMAT(jual_date, '%Y-%m-%d') as tgl, count(*) AS total");
				$this->db->group_by('1');
				$rs = $this->db->get('tsales');
				if( $rs->num_rows() ) {
					foreach($rs->result_array() as $row) {
						$data1[$row['tgl']] = $row['total'];
					}
				}

				$return['label1'] = $label1;
				foreach($data1 as $row) {
					$return['data1'][] = $row;
				}

			}
			
			$this->db->flush_cache();
			$return['success'] = true;
		}

		header('Content-Type:application/json');
		echo json_encode($return);
	}
}
