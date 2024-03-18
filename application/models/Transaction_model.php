<?php 
 
class Transaction_model extends CI_Model{
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
	
	public function getSupplier()
	{
		$array = array( 'tperson.person_type' => '1');

		$this->db->select('tperson.person_no,
						   tperson.person_code, 
						   tperson.person_name, 
						   tperson.person_alamat, 
						   tperson.person_telp, 
						   tperson.person_fax, 
						   tperson.person_hp, 
						   tperson.person_contact, 
						   tperson.person_contact2, 
						   tperson.kota, 
						   tperson.propinsi, 
						   tperson.person_desc')
				  ->from('tperson')
				  ->order_by('tperson.person_name', 'asc')
				  ->where($array);

		$query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function tampil($search,$start_date,$end_date,$status,$pajak,$supplier)
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$start_date_fr = date_create($start_date." 00:00:00");
		$end_date_fr = date_create($end_date." 23:59:59");

		$array = array( 'xb.is_delete' => '0',
					    'xb.pur_date >=' => date_format($start_date_fr,"Y-m-d H:i:s"), 
					    'xb.pur_date <=' => date_format($end_date_fr,"Y-m-d H:i:s"));

		$this->db->select('	if(xb.pur_inv<>"",xb.pur_inv, xb.pur_no) AS pur_no,
							xb.pur_no as pur_no_ril,
							xb.pur_date AS pur_date, 
							if(xb.is_fp = 1,xb.no_faktur_pajak, "") AS no_faktur_pajak,
							xb.is_fp AS is_fp,
							xb.is_faktur AS is_faktur, 
							xb.is_receive AS is_received,
							xb.pur_ket AS pur_ket, 
							xb.pur_total_tunai AS pur_total_tunai,
							xc.person_name, 
							xb.pur_no as purno, 
							xb.pur_ord as puror, 
							xb.pur_type,
							round(if(xb.pur_type < 2, xx.total_hutang, 0),2) AS pur_total,
							round(if(xb.pur_type = 2,  xx.total_hutang * (-1),0),2) AS ret_total,
							round(if(xb.pur_type < 2, (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1), (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs)),2) as Bayar,
							round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2) as Sisa,
							xb.person_no');
	  	$this->db->from('thutang as xx');
	  	$this->db->join('tpurchase as xb','xx.in_no = xb.pur_no','left');
		$this->db->join('tperson as xc', 'xb.person_no = xc.person_no','left');
		$this->db->where($array); 
		$this->db->where_in('xb.pur_type', array('1','2'));
		if($role == 2 ){
        	$this->db->where('xc.person_no =',$person_id);
        }
        	
        if ($supplier <> '') {
        	$this->db->where('xc.person_no =',$supplier);
        }

		if ($pajak == 1) {
			$this->db->where('xb.is_fp','1');
		}elseif ($pajak == 2) {
			$this->db->where('xb.is_fp','2');
		}

		if ($status == 1) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) = 0');
		}elseif ($status == 2) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) > 0');
		}

		$this->db->order_by('xb.pur_date', 'desc');
	    $query = $this->db->get();

	    if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }

	    if( !$query ){
		   $errNo   = $this->db->error();

		   print_r($errNo);
		   // Do something with the error message or just show_404();
		}
	}
	public function result($search,$start_date,$end_date,$status,$pajak,$supplier)
	{
		
        $person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$start_date_fr = date_create($start_date." 00:00:00");
		$end_date_fr = date_create($end_date." 23:59:59");

		$array = array( 'xb.is_delete' => '0',
					    'xb.pur_date >=' => date_format($start_date_fr,"Y-m-d H:i:s"), 
					    'xb.pur_date <=' => date_format($end_date_fr,"Y-m-d H:i:s"));

		$this->db->select('	if(xb.pur_inv<>"",xb.pur_inv, xb.pur_no) AS pur_no,
							xb.pur_no as pur_no_ril,
							xb.pur_date AS pur_date, 
							if(xb.is_fp = 1,xb.no_faktur_pajak, "") AS no_faktur_pajak,
							xb.is_fp AS is_fp,
							xb.is_faktur AS is_faktur, 
							xb.is_receive AS is_received,
							xb.pur_ket AS pur_ket, 
							xb.pur_total_tunai AS pur_total_tunai,
							xc.person_name, 
							xb.pur_no as purno, 
							xb.pur_ord as puror, 
							xb.pur_type,
							round(if(xb.pur_type < 2, xx.total_hutang, 0),2) AS pur_total,
							round(if(xb.pur_type = 2,  xx.total_hutang * (-1),0),2) AS ret_total,
							round(if(xb.pur_type < 2, (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1), (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs)),2) as Bayar,
							round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2) as Sisa,
							xb.person_no');
	  	$this->db->from('thutang as xx');
	  	$this->db->join('tpurchase as xb','xx.in_no = xb.pur_no','left');
		$this->db->join('tperson as xc', 'xb.person_no = xc.person_no','left');
		$this->db->where($array); 
		$this->db->where_in('xb.pur_type', array('1','2'));
		if($role == 2 ){
        	$this->db->where('xc.person_no =',$person_id);
        }
        	
        if ($supplier <> '') {
        	$this->db->where('xc.person_no =',$supplier);
        }

		if ($pajak == 1) {
			$this->db->where('xb.is_fp','1');
		}elseif ($pajak == 2) {
			$this->db->where('xb.is_fp','2');
		}

		if ($status == 1) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) = 0');
		}elseif ($status == 2) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) > 0');
		}

		$this->db->order_by('xb.pur_date', 'desc');
	    $query = $this->db->get();

	    return $query->num_rows();
	    
	}
	
	public function jumlahTotal($search,$start_date,$end_date,$status,$pajak,$supplier)
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

        $start_date_fr = date_create($start_date." 00:00:00");
		$end_date_fr = date_create($end_date." 23:59:59");

		$array = array( 'xb.is_delete' => '0',
					    'xb.pur_date >=' => date_format($start_date_fr,"Y-m-d H:i:s"), 
					    'xb.pur_date <=' => date_format($end_date_fr,"Y-m-d H:i:s"));

		$this->db->select('	SUM(round(if(xb.pur_type < 2, xx.total_hutang, 0),2)) AS sum_pur_total,
							SUM(round(if(xb.pur_type = 2,  xx.total_hutang * (-1),0),2)) AS sum_ret_total,
							SUM(round(if(xb.pur_type < 2, (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1), (xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs)),2)) AS sum_pur_total_tunai,
							SUM(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) AS sum_saldo_akhir');
	  	$this->db->from('thutang as xx');
	  	$this->db->join('tpurchase as xb','xx.in_no = xb.pur_no','left');
		$this->db->join('tperson as xc', 'xb.person_no = xc.person_no','left');
		$this->db->where($array); 
		$this->db->where_in('xb.pur_type', array('1','2'));
		if($role == 2 ){
        	$this->db->where('xc.person_no =',$person_id);
        }
        	
        if ($supplier <> '') {
        	$this->db->where('xc.person_no =',$supplier);
        }

		if ($pajak == 1) {
			$this->db->where('xb.is_fp','1');
		}elseif ($pajak == 2) {
			$this->db->where('xb.is_fp','2');
		}

		if ($status == 1) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) = 0');
		}elseif ($status == 2) {
			$this->db->group_by('xx.in_no');
			$this->db->having('sum(round(if(xb.pur_type < 2, (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs), (xx.total_hutang_kurs - xx.total_retur_kurs - xx.total_bayar_kurs - xx.total_potongan_kurs) * (-1)), 2)) > 0');
		}

		$this->db->order_by('xb.pur_date', 'desc');
	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function detail_trx($id)
	{
		$array = array('tpur.is_delete =' => '0', 
						'tpur.pur_no =' => $id);
		$this->db->select(" tpur.pur_no,
							tpur.pur_date,
							tpur.pur_inv,
							tpur.pur_inv_date,
							tpur.no_faktur_pajak,
							tpo.pur_ord,
							tpo.pur_ord_date,
							tpo.pur_ket AS pur_ord_ket,
							tpur.ndays,
							tpur.pur_sub_total_kurs AS pur_ord_subtotal,
							tpo.pur_ord_pot_persen,
							tpur.pur_pot_rp_kurs,
							tpo.pur_ord_ppn_persen,
							tpur.pur_ppn_rp_kurs,
							tpur.pur_total_kurs,
							tpo.is_ppn,
							tpur.is_fp AS is_fp,
							tpur.is_receive,
							tpur.pur_total,
							tpur.pur_ket,
							tret.pur_total AS ret_total,
							tpur.pur_total_tunai,
							tperson.person_name,
							tpur.person_no,
							if(tpur.pur_inv<>'',tpur.pur_inv, tpur.pur_no) as pur_noku,
							tpur.tax_amount,
							tpur.tgl_faktur_pajak ")
			->from('tpurchase as tpur')
			->join('tpurchase_order as tpo', 'tpo.pur_ord = tpur.pur_ord','left')
			->join('tpurchase as tret', 'tpur.pur_no = tret.pur_ord AND tret.pur_type = 2','left')
			->join('tperson', 'tpur.person_no = tperson.person_no','left')
	    	->where($array)
	    	->where_in('tpur.pur_type', array('1','2'));

	    $query = $this->db->get();

	    $row = $query->result();
	    return $row;
	}
	public function list_pembayaran($id)
	{
		$array = array('tpay.pay_tr_type <' => 5,
						'tpurchase.is_delete =' => 0,
						'tpurchase.pur_no =' => $id);
		
		$this->db->select("DISTINCT(tpay.pay_no) AS pay_no,
						   tpay.pay_date,
						   tpurchase.pur_total AS pay_total_kurs,
						   tpay.pay_ket,
						   tret.pur_total AS ret_total")
			->from('tpay')
			->join('tdpay', 'tdpay.pay_no = tpay.pay_no','left')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
			->join('tpurchase as tret', 'tpurchase.pur_no = tret.pur_ord AND tret.pur_type = 2','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function detail_list_pembayaran($id,$id_pay)
	{
		$array = array('tpay.pay_no =' => $id_pay,
						'tpurchase.pur_no =' => $id);
		$this->db->select('tpay.pay_no, 
						   tpay.pay_date, 
						   tpay.pay_voucher, 
						   tperson.person_code, 
						   tperson.person_name, 
						   tperson.person_alamat,
						   tpay.pay_ket, 
						   tpay.pay_total')
			->from('tpay')
			->join('tdpay', 'tdpay.pay_no = tpay.pay_no','left')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
			->join('tperson', 'tpay.person_no = tperson.person_no','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function detail_list_pembayaran_nota($id,$id_pay)
	{
		$array = array('tpurchase.is_delete =' => 0,
						'tdpay.pay_no =' => $id_pay,
						'tpurchase.pur_no =' => $id);
		$this->db->select("tdpay.pay_no, 
						   tdpay.pay_bayar, 
						   tdpay.pay_pot, 
						   tpurchase.pur_date, 
						   tpurchase.pur_inv,
						   tret.pur_total AS ret_total,
						   tpurchase.pur_total")
			->from('tdpay')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
			->join('tpurchase as tret', 'tpurchase.pur_no = tret.pur_ord AND tret.pur_type = 2','left')
			->join('thutang', 'tpurchase.pur_no = thutang.in_no','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function nota_sub_total($id,$id_pay)
	{
		$array = array('tpurchase.is_delete =' => 0,
						'tdpay.pay_no =' => $id_pay,
						'tpurchase.pur_no =' => $id);
		$this->db->select("SUM(tdpay.pay_bayar) AS bayar, 
						   SUM(tpurchase.pur_total) AS total,
						   SUM(tdpay.pay_bayar)-SUM(tpurchase.pur_total) AS sisa")
			->from('tdpay')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
			->join('tpurchase as tret', 'tpurchase.pur_no = tret.pur_ord AND tret.pur_type = 2','left')
			->join('thutang', 'tpurchase.pur_no = thutang.in_no','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function detail_list_pembayaran_akun($id,$id_pay)
	{
		$array = array('tcek_out.pay_no =' => $id_pay,
					    'tpurchase.pur_no =' => $id);
		$this->db->select("DISTINCT(tcek_out.pay_no),
						   tdpay.pay_bayar,
						   tcek_out.cek_type, 
						   tcek_out.noBG, 
						   tcek_out.tgl_terbit, 
						   tcek_out.due_date, 
						   tcek_out.bank, 
						   tcek_out.nominal,
						   trek.rek_kode,
						   trek.rek_nama,
						   trek.rek_no")
			->from('tcek_out')
			->join('trek', 'tcek_out.rek_no = trek.rek_no','left')
			->join('tdpay', 'tdpay.pay_no = tcek_out.pay_no','left')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function akun_sub_total($id,$id_pay)
	{
		$array = array('tcek_out.pay_no =' => $id_pay,
						'tpurchase.pur_no =' => $id);
		$this->db->select("DISTINCT(tcek_out.pay_no),
						   SUM(tdpay.pay_bayar) AS tot_nom")
			->from('tcek_out')
			->join('trek', 'tcek_out.rek_no = trek.rek_no','left')
			->join('tdpay', 'tdpay.pay_no = tcek_out.pay_no','left')
			->join('tpurchase', 'tdpay.in_no = tpurchase.pur_no','left')
	    	->where($array);

	    $query = $this->db->get();
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function countBlmLunas()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		/*$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0');*/

		if($role == 2 ){
			$sql = "select count(*) as jml_pur_no from(
					select xb.in_no
					from trans_hutang as xb
					left join tpurchase as tpur on xb.in_no = tpur.pur_no
					left join tperson on tperson.person_no = tpur.person_no
					where tpur.pur_type = 1 and tpur.is_delete = 0 and tpur.person_no=?
					group by xb.in_no
					having sum(xb.debet - xb.kredit) <> 0) as c";
			$query = $this->db->query($sql, $person_id);
		}else{
			$query = $this->db->query("select count(*) as jml_pur_no from(
										select xb.in_no
										from trans_hutang as xb
										left join tpurchase as tpur on xb.in_no = tpur.pur_no
										left join tperson on tperson.person_no = tpur.person_no
										where tpur.pur_type = 1 and tpur.is_delete = 0
										group by xb.in_no
										having sum(xb.debet - xb.kredit) <> 0) as c");
		}
		// $this->db->select('(xa.in_no) AS jml_pur');
		// $this->db->from('trans_hutang as xa');
	 //  	$this->db->join('tpurchase as tpur', 'xa.in_no = tpur.pur_no','left');
		// $this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		// $this->db->where($array); 

		// if($role == 2 ){
  //       	$this->db->where('tperson.person_no =',$person_id);
  //       }
  //       $this->db->group_by('xa.in_no');
  //       $this->db->having('sum(xa.debet - xa.kredit) <> 0');
	 //    $query = $this->db->get_compiled_select();

	 //    $this->db->select('COUNT(*) AS jml_pur_no');
	 //    $this->db->from("($query)"); 

	    
	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	    
	}
	public function countSdhLunas()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		// $array = array( 'tpur.pur_type' => '1', 
		// 			    'tpur.is_delete' => '0');

		// $this->db->select('COUNT(xa.in_no) AS jml_pur');
		// $this->db->from('trans_hutang as xa');
	 //  	$this->db->join('tpurchase as tpur', 'xa.in_no = tpur.pur_no','left');
		// $this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		// $this->db->where($array); 

		// if($role == 2 ){
  //       	$this->db->where('tperson.person_no =',$person_id);
  //       }
  //       $this->db->group_by('xa.in_no');
  //       $this->db->having('sum(xa.debet - xa.kredit) = 0');
	 //    $query = $this->db->get_compiled_select();

	 //    $this->db->select('COUNT(*) AS jml_pur_no');
	 //    $this->db->from("($query)"); 
        if($role == 2 ){
	        $sql = "select count(*) as jml_pur_no from(
select xb.in_no
from trans_hutang as xb
left join tpurchase as tpur on xb.in_no = tpur.pur_no
left join tperson on tperson.person_no = tpur.person_no
where tpur.pur_type = 1 and tpur.is_delete = 0 and tpur.person_no=?
group by xb.in_no
having sum(xb.debet - xb.kredit) = 0) as c";
			$query = $this->db->query($sql, $person_id);
	    }else{
	    	$query = $this->db->query("select count(*) as jml_pur_no from(
select xb.in_no
from trans_hutang as xb
left join tpurchase as tpur on xb.in_no = tpur.pur_no
left join tperson on tperson.person_no = tpur.person_no
where tpur.pur_type = 1 and tpur.is_delete = 0
group by xb.in_no
having sum(xb.debet - xb.kredit) = 0) as c");
	    }
	    

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function countFakturPajak()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0',
					    'tpur.is_fp' => '0',
						'tpur.is_ppn >' => '0');

		$this->db->select('COUNT(tpur.pur_no) AS jml_pur_no');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->where($array); 

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }

	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function countTandaTerima()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0',
					    'tpur.is_faktur' => '0');
		$this->db->select('COUNT(tpur.pur_no) AS jml_pur_no');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->where($array); 

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }

	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function pembelianDay()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0');
		$this->db->select('COUNT(tpur.pur_no) AS pur_no,
						   DATE(tpur.pur_date) AS tgl');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->group_by('DATE(tpur.pur_date)');
		$this->db->where($array);

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }
	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function pembelianDayFilter($filter,$year)
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0',
						'MONTH(tpur.pur_date)'=> $filter,
						'YEAR(tpur.pur_date)'=> $year);
		$this->db->select('COUNT(tpur.pur_no) AS pur_no,
						   DATE(tpur.pur_date) AS tgl');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->group_by('DATE(tpur.pur_date)');
		$this->db->where($array);

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }
	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function pembelianMonth()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0');
		$this->db->select('COUNT(tpur.pur_no) AS pur_no,
						  MONTH(tpur.pur_date) AS tgl');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->group_by('MONTH(tpur.pur_date)');
		$this->db->where($array);

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }

	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function pembelianMonthFilter($filter)
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0',
						'YEAR(tpur.pur_date)'=> $filter);
		$this->db->select('COUNT(tpur.pur_no) AS pur_no,
						  MONTH(tpur.pur_date) AS tgl');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->group_by('MONTH(tpur.pur_date)');
		$this->db->where($array);

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }

	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function pembelianYear()
	{
		$person_id = $this->session->userdata("person_no");
        $role = $this->session->userdata("role");

		$array = array( 'tpur.pur_type' => '1', 
					    'tpur.is_delete' => '0');
		$this->db->select('COUNT(tpur.pur_no) AS pur_no,
						  YEAR(tpur.pur_date) AS tgl');
	  	$this->db->from('tpurchase as tpur');
		$this->db->join('tperson', 'tpur.person_no = tperson.person_no','left');
		$this->db->group_by('YEAR(tpur.pur_date)');
		$this->db->where($array);

		if($role == 2 ){
        	$this->db->where('tperson.person_no =',$person_id);
        }

	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function testCon($db,$hostname,$port,$username,$password){
		$test = $this->db_manager->test_connection($db,$hostname,$port,$username,$password);
		return $test;
	}
	public function getCon($db,$hostname,$port,$username,$password){
		$test = $this->db_manager->get_connection($db,$hostname,$port,$username,$password);
		return $test;
	}

	public function insertImage($postData = array())
	{

		$filename = $postData['filename'];
		$url = $postData['url'];

		$name = explode(".",$filename);
		$multype = array(
			strtolower($name[0].'.jpg'),
			strtolower($name[0].'.png'),
			strtolower($name[0].'.jpeg'),
			strtolower($name[0].'.pdf')
		);
		
		if(isset($filename)){
          	$this->db->select('timg.id');
	  		$this->db->from('app_supplier as timg');
     		$this->db->where_in('timg.filename',$multype);
     		$query = $this->db->get();

		    if($query->num_rows() > 0 )
		    {
		    	$row = $query->result();
		        foreach ($row as $ab) {
		        	$data = array(
			           'filename' => $filename,
			           'url' => $url
			        );
				    $this->db->where('id', $ab->id);
				    $this->db->update('app_supplier', $data);
		        }
		    }else{
		    	$data = array(
			        'filename' => $filename,
			        'url' => $url
			     );
			    $this->db->insert('app_supplier',$data);

		    }
			    return true;
        }
        return false;
        
	}
	public function deleteImage($postData = array())
	{

		$url = $postData['url'];
		$np = $postData['pur_no'];
		$tp = $postData['tp'];

		if(isset($url)){
			$this->db-> where('url', $url);
    		$this->db-> delete('app_supplier');
        }

        if($tp == 'pj'){
			$data = array(
				'is_fp' => 0,
			    'no_faktur_pajak' => '',
			    'tgl_faktur_pajak' => ''
			 );
	    	$array = array( 'pur_no' => $np);
			$this->db->where($array);
			$this->db->update('tpurchase', $data);
        }
        
	}
	public function get_image($ids ="",$idk="", $person = "",$jns ="")
	{
		// print_r($person);
		$multype = array(
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($idk))).'_'.str_replace(".","&",strval($person)).'.png'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($idk))).'_'.str_replace(".","&",strval($person)).'.jpg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($idk))).'_'.str_replace(".","&",strval($person)).'.jpeg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($idk))).'_'.str_replace(".","&",strval($person)).'.pdf')			
		);
		// print_r($multype);
		$this->db->select("timg.id,
							timg.filename,
							timg.url");
		$this->db->from('app_supplier as timg');
	    $this->db->where_in('LOWER(timg.filename)', $multype);

	    $query = $this->db->get();

	    $error = $this->db->error();

	    // print_r($error);
		if($query->num_rows() > 0)
	    {
	        $row = $query->result();
	        return $row;
	    }else{
	    	$multype2 = array(
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.png'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.jpg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.jpeg'),
					strtolower($jns.'_'.str_replace(".","&",str_replace("/","@",strval($ids))).'_'.str_replace(".","&",strval($person)).'.pdf')			
			);
			$this->db->select("timg.id,
								timg.filename,
								timg.url");
			$this->db->from('app_supplier as timg');
		    $this->db->where_in('LOWER(timg.filename)', $multype2);

		    $query2 = $this->db->get();

		    // $error2 = $this->db->error();

		    if ($query2->num_rows() > 0)
		    {
		        $row2 = $query2->result();
		        return $row2;
		    }
	    }
	}
	public function usercdb()
	{
		$this->db->select("tus.id,
							tus.user_name,
							tus.user_pass");
		$this->db->from('tusers_supplier as tus');
	    $this->db->where('tus.id', 51);

	    $query = $this->db->get();
		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function insertNotif($postData = array())
	{

		$notif_date = date('Y-m-d H:i:s');

		$flnm = explode("_",$postData['filename']);
		$pur_no = $flnm[1];

		$sender_type = $this->session->userdata("role");
		
		if($sender_type == 1 ){
			$sender_id = $this->session->userdata("person_id");
			$prt = explode(".",$flnm[2]);
			$receiver_id = $prt[0];
        	$receiver_type = 2;
        }elseif ($sender_type == 2) {
        	$sender_id = $this->session->userdata("person_no");
        	$receiver_id = '';
        	$receiver_type = 1;
        }

        if($flnm[0] == "RF"){
        	$type_notif = 1;
        }elseif ($flnm[0] == "PY") {
        	$type_notif = 2;
        }elseif ($flnm[0] == "NP") {
        	$type_notif = 3;
        }elseif ($flnm[0] == "PJ") {
        	$type_notif = 4;
        }

    	$data = array(
	        'pur_no' 		=> $pur_no,
	        'notif_date'	=> $notif_date,
	        'sender_id' 	=> $sender_id,
	        'sender_type'	=> $sender_type,
	        'receiver_id'	=> $receiver_id,
	        'receiver_type'	=> $receiver_type,
	        'notif_type'	=> $type_notif
	     );
	    $this->db->insert('app_notification',$data);
	}
	public function updatenotif($idg)
	{
    	$data = array(
		    'is_read' => 1
		 );
    	$array = array( 'id' => $idg);
		$this->db->where($array);
		$this->db->update('app_notification', $data);
	}
	public function shownotif($sts = ' ')
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_no");

		if($role == '2'){
			$this->db->select('tf.*, tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tu.person_no',$person_id);
			$this->db->where('tf.receiver_id <>','');
			$this->db->where('tf.pur_no <>','');
		}else{
			$this->db->select('tf.*,tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.sender_id','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tf.receiver_type', '1');
			$this->db->where('tf.pur_no <>','');
		}
		
		$this->db->where('tf.is_read',0);
		$this->db->order_by('tf.id', 'desc');
		$this->db->limit(5);

		$query = $this->db->get();

		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }

	   
	}
	public function shownotiflt($sts = ' ', $start = '', $end ='', $ntf, $cr = '')
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_no");

        $start_date = date_create($start." 00:00:00");
		$end_date = date_create($end." 23:59:59");

		$array = array('tf.notif_date >=' => date_format($start_date,"Y-m-d H:i:s"), 
					    'tf.notif_date <=' => date_format($end_date,"Y-m-d H:i:s"));

		if($role == '2'){
			$this->db->select('tf.*, tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tu.person_no',$person_id);
			$this->db->where('tf.receiver_id <>','');
		}else{
			$this->db->select('tf.*,tp.person_name');
			$this->db->from('app_notification as tf');
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.sender_id','left');
			$this->db->join('tperson as tp', 'tp.person_no = tu.person_no','left');
			$this->db->where('tf.receiver_type', '1');
		}
		if ($sts <> '0') {
			$this->db->where('tf.notif_type', $sts);
		}
		if ($ntf == '1') {
			$this->db->where('tf.is_read', 1);
		}elseif($ntf == '2'){
			$this->db->where('tf.is_read', 0);
		}

		$this->db->where('tf.pur_no <>','');
		
		if($cr <> ''){
			$this->db->where("(tp.person_name LIKE '%".$cr."%' OR tf.pur_no LIKE '%".$cr."%')");
		}

		$this->db->where($array);
			
		$this->db->order_by('tf.id', 'desc');
		

		$query = $this->db->get();

		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }

	   
	}
	public function showunreadnotif()
	{
		$role = $this->session->userdata("role");
        $person_id = $this->session->userdata("person_no");

        $this->db->select('count(tf.id) as jml_notif');
		$this->db->from('app_notification as tf');
		if($role == '2'){
			$this->db->join('tusers_supplier as tu', 'tu.person_no = tf.receiver_id and tf.receiver_type = 2','left');
			$this->db->where('tu.person_no',$person_id);
		}else{
			$this->db->where('tf.receiver_type', '1');
		}

		$this->db->where('tf.is_read',0);
		$this->db->where('tf.pur_no <>','');

		$query = $this->db->get();
		
		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function sendDataPajak($postData = array())
	{

		$ifp = $postData['is_fp'];
		$nfp = $postData['no_fp'];
		$tfp = date_create($postData['tgl_fp']." 08:00:00");
		$np = $postData['no_pr'];

		$data = array(
			'is_fp' => $ifp,
		    'no_faktur_pajak' => $nfp,
		    'tgl_faktur_pajak' => date_format($tfp,"Y-m-d H:i:s")
		 );
    	$array = array( 'pur_no' => $np);
		$this->db->where($array);
		$this->db->update('tpurchase', $data);
	}
	public function getidpr($id)
	{
		$this->db->select('if(tpur.pur_inv <>"",tpur.pur_inv, tpur.pur_no) as pur_noku, tpur.pur_no');
		$this->db->from('tpurchase as tpur');
		$this->db->where('tpur.pur_no', $id);
		$this->db->where('tpur.is_delete', 0);
		$this->db->limit('1');

		$query = $this->db->get();

		if ($query->num_rows() > 0 )
	    {
	        $row = $query->result();
	        return $row;
	    }
	}
	public function getidnv($id)
	{
		$this->db->select('tpur.pur_no');
		$this->db->from('tpurchase as tpur');
		$this->db->where('tpur.pur_no', $id);
		$this->db->where('tpur.is_delete', 0);
		$this->db->limit('1');

		$query = $this->db->get();

		if($query !== false && $query->num_rows() > 0)
	    {
	        $row = $query->result();
	        return $row;
	    }else{
	    	$this->db->select('tpur.pur_no');
			$this->db->from('tpurchase as tpur');
			$this->db->where('tpur.pur_inv', $id);
			$this->db->where('tpur.is_delete', 0);
			$this->db->limit('1');

			$query2 = $this->db->get();

			if($query !== false && $query2->num_rows() > 0)
		    {
		        $row2 = $query2->result();
		        return $row2;
		    }
	    }

	}

}	