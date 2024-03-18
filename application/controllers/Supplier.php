<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends IO_Controller {

	function __construct()
	{
		parent::__construct();
    }

	public function index()
	{
        $this->data['title'] = 'FHSoftware Dashboard';
        $this->data['content'] = "dashboard_supplier";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/dashboard_supplier.js" type="text/javascript"></script>';
		$this->load->view('template_supplier', $this->data);
    }

    public function invoice() {

        $this->data['detail_invoice'] = $this->getInvoicePurchase($this->uri->rsegment(3));
        $this->data['detail_payment'] = $this->getPaymentByPurNo($this->uri->rsegment(3));
        $this->data['title'] = 'Detail Invoice : '. (isset( $this->data['detail_invoice']['pur_inv']) ?  $this->data['detail_invoice']['pur_inv'] : "");
        $this->data['content'] = "detail_invoice";
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/dashboard_supplier.js" type="text/javascript"></script>'
            . '<script>'
            . 'jQuery(document).ready(function() {'
            . 'Dashboard_supplier.initInvoice();'
            . '});'
            . '</script>';
		$this->load->view('template_supplier', $this->data);
    }
    
    public function notainvoice() {

        $this->data['detail_invoice'] = $this->getPaymentByPayNo($this->uri->rsegment(3));
        $this->data['detail_payment'] = $this->getDetailPembayaran($this->uri->rsegment(3));
        $this->data['detail_checkout'] = $this->getCekOutByPayNo($this->uri->rsegment(3));
        $this->data['title'] = 'Nota Invoice : '. $this->uri->rsegment(3);
        $this->data['content'] = "nota_invoice";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/demo/base/detail_print.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.printarea.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/dashboard_supplier.js" type="text/javascript"></script>'
            . '<script>'
            . 'jQuery(document).ready(function() {'
            . 'Dashboard_supplier.initNotaInvoice();'
            . '});'
            . '</script>';
		$this->load->view('template_supplier', $this->data);
    }

    public function datatable_list_hutang() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtersaldo',
            'filterfp'
        );

        foreach ($field as $v) {
            $$v = $this->input->get_post( $v );
        }

        $return = array(
            'iTotalRecords' => 0,
            'iTotalDisplayRecords' => 0,
            'sEcho' => $this->input->post( 'draw' ),
            'aaData' => array()
        );

        $length = ($length) ? $length : 20;

        $data = array();

        $sd = date('Y-m-d', strtotime($startdate))." 00:00:00";
        $ed = date('Y-m-d', strtotime($enddate))." 23:59:59";

        $this->db->start_cache();

        $this->db->where('a.pur_type <', 3);
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.person_no', $this->session->userdata('person_no'));
        $this->db->where("a.pur_date BETWEEN '{$sd}' AND '{$ed}'");

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( a.pur_inv LIKE '%{$q}%' OR a.pur_no LIKE '%{$q}%' OR b.person_name LIKE '%{$q}%')");
        }

        if( $filterfp > -1 ) {
            $this->db->where('a.is_fp', $filterfp);
        }

        switch($filtersaldo) {
            case 1:
                $this->db->where("round(c.total_hutang - c.total_retur - c.total_potongan - c.total_bayar) <> 0");
                break;
            case 2:
                $this->db->where("round(c.total_hutang - c.total_retur - c.total_potongan - c.total_bayar) = 0");
                break;
        }

        $this->db->where('a.ndays <>', 0);

        $this->db->join('tperson b', 'a.person_no = b.person_no', 'left');
        $this->db->join('thutang c', 'a.pur_no = c.in_no', 'left');
        $this->db->join('tcat_gudang d', 'a.cab_no = d.cat_gud_no', 'left');
        $this->db->stop_cache();

        $total = $this->db->count_all_results('tpurchase a');

        // $return['db'] = $this->db->last_query();
        
        if( $total ) {

            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;

            $this->db->select("a.person_no,
                a.pur_date, 
                a.pur_no, 
                a.pur_inv, 
                a.pur_ket,
                a.is_fp,
                a.dpp_fp,
                a.ppn_fp,
                a.is_faktur,
                a.no_faktur_pajak,
                concat(a.ndays, ' ', 'Hari') as TopName, 
                a.pur_total,
                adddate(a.pur_date,a.ndays) as jatuh_tempo, 
                (c.total_bayar - c.total_potongan - c.total_retur) as saldo_bayar,
                c.total_potongan,
                c.total_retur,
                b.person_name, 
                b.person_alamat,
                a.cab_no,
                d.nama AS nama_gudang");
            $this->db->order_by('a.pur_date', 'DESC');
            $this->db->limit($length, $start);
            $rs = $this->db->get('tpurchase a');

            if( $rs->num_rows() ) {
                foreach($rs->result_array() as $row) {

                    $fp = $row['no_faktur_pajak'];
                    $row['no_faktur_pajak'] = "";

                    if( $row['dpp_fp'] != 0 or $row['ppn_fp'] != 0) {
                        $row['no_faktur_pajak'] = $fp;
                    } 


                    $row['pur_date'] = date('d-m-Y H:i:s', strtotime($row['pur_date']));

                    // $row['terima_fp'] = !$row['is_fp'] ? '<span class="m-badge  m-badge--danger m-badge--wide">Tidak</span>' : '<span class="m-badge  m-badge--success m-badge--wide">Ya</span>';
                    // $row['terima_faktur'] = !$row['is_faktur'] ? '<span class="m-badge  m-badge--danger m-badge--wide">Tidak</span>' : '<span class="m-badge  m-badge--success m-badge--wide">Ya</span>';

                    $row['pur_inv'] = $row['pur_inv'] ? $row['pur_inv'] : $row['pur_no'];
                    $row['aksi'] = '<a href="javascript:;" data-purno="'.$row['pur_no'].'" class="btn m-btn--icon m-btn--icon-only m-btn--pill btn-outline-info btn-sm btn-small-view" alt="View Detail" title="View Detail"><i class="la la-paste"></i></a>';

                    $total_retur = 0;
                    $saldo_bayar = $row['saldo_bayar'];
                    $this->db->flush_cache();
                    $retur = $this->getReturDataByPo($row['pur_no']);
                    if( !is_null($return) ) {
                        $total_retur = isset($retur['pur_total']) ? $retur['pur_total'] : 0;
                        $saldo_bayar += isset($retur['total_bayar']) ? $retur['total_bayar'] : 0;
                    }

                    $sisa = $row['pur_total'] - $total_retur - $saldo_bayar;

                    $row['total_retur'] = number_format($total_retur, 2);
                    $row['saldo_bayar'] = number_format(round($saldo_bayar),2);
                    
                    $row['sisa'] = number_format(round($sisa), 2);

                    $row['pur_total'] = number_format(round($row['pur_total'] - $row['total_potongan']), 2);

                    $keterangan = '<span class="m-badge  m-badge--danger m-badge--wide">Blm Lunas</span>';
                    if( $row['sisa'] <= 0 ) {
                        $keterangan = '<span class="m-badge  m-badge--success m-badge--wide">Lunas</span>';
                    }
                    $row['pur_ket'] = $keterangan." ".$row['pur_ket'];

                    $data[] = $row;
                }
            }
        
        }

        $return['aaData'] = $data;

        $this->db->flush_cache();

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    protected function getReturDataByPo($pur_no) {
        $this->db->select('a.pur_total, (b.total_bayar + b.total_potongan + total_retur) as total_bayar');
        $this->db->where('a.pur_ord', $pur_no);
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.pur_type', 2);
        $this->db->join('thutang b', 'a.pur_no = b.in_no', 'left');
        $rs = $this->db->get('tpurchase a');
        if( $rs->num_rows() ) {
            return $rs->row_array();
        }
        return null;
    }
    
    protected function getInvoicePurchase($pur_no) {
        $this->db->select('a.*, 
            b.person_name,
            (c.total_retur + c.total_potongan + c.total_bayar) as total_bayar');
        $this->db->where('a.pur_no', $pur_no);
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.person_no', $this->session->userdata('person_no'));
        $this->db->join('tperson b', 'a.person_no = b.person_no', 'left');
        $this->db->join('thutang c', 'a.pur_no = c.in_no', 'left');
        $rs = $this->db->get('tpurchase a');
        if( $rs->num_rows() ) {
            $row = $rs->row_array();

            switch($row['is_ppn']) {
                case 1:
                    $row['ppn_name'] = "Exc.";
                    break;
                case 2:
                    $row['ppn_name'] = "Inc.";
                    break;
                default:
                    $row['ppn_name'] = "None";
                    break;
            }

            $row['sisa_bayar'] = $row['pur_total'] - $row['total_bayar'];

            return $row;
        }
        return null;
    }

    protected function getPaymentByPurNo($pur_no) {
        $data = array();
        $this->db->select('b.pay_no,
            c.pay_ket,
            c.pay_date,
            d.cek_type,
            d.tgl_terbit,
            d.nominal,
            e.rek_nama,
            SUM(IF(a.pur_type = 1, (b.pay_bayar + b.pay_pot), 0)) AS total_bayar,
            SUM(IF(a.pur_type = 2, (b.pay_bayar + b.pay_pot), 0)) AS total_retur');
        $this->db->where('a.pur_no', $pur_no);
        $this->db->or_where('a.pur_ord', $pur_no);
        $this->db->join('tdpay b', 'a.pur_no = b.in_no', 'left');
        $this->db->join('tpay c', 'b.pay_no = c.pay_no', 'left');
        $this->db->join('tcek_out d', 'b.pay_no = d.pay_no', 'left');
        $this->db->join('trek e', 'd.rek_no = e.rek_no', 'left');
        $this->db->group_by('1, 2, 3, 5, 6, 7');
        $rs = $this->db->get('tpurchase a');
        if( $rs->num_rows() ) {
            foreach($rs->result_array() as $row) {
                if( empty($row['pay_no']) ) continue;

                switch($row['cek_type']) {
                    case 1:
                        $jenis_transaksi = "TRANSFER";
                        break;
                    case 2:
                        $jenis_transaksi = "BG";
                        break;
                    default:
                        $jenis_transaksi = "TUNAI";
                        break;
                }

                $row['pay_ket'] = $jenis_transaksi." ".$row['rek_nama']." TGL. ".date('d-m-Y', strtotime($row['tgl_terbit']))." Rp. ".number_format($row['nominal'], 2)." ".$row['pay_ket'];

                $row['total_bayar'] = round($row['total_bayar']);
                $row['total_retur'] = round($row['total_retur']);
                $row['bayar'] = $row['total_bayar'] + $row['total_retur'];
                $data[] = $row;
            }
        }

        // echo $this->db->last_query();
        // die();

        // $this->db->select('a.*, 
        //     c.pay_ket,
        //     c.pay_date,
        //     b.rek_hutang, 
        //     b.pur_date, 
        //     b.kurs_cur,  
        //     b.pur_no,
        //     b.pur_inv, 
        //     b.ndays');
        // $this->db->where('a.in_no', $pur_no);
        // $this->db->join('tpurchase b', 'a.in_no = b.pur_no', 'left');
        // $this->db->join('tpay c', 'a.pay_no = c.pay_no', 'left');
        // $rs = $this->db->get('tdpay a');
        // if( $rs->num_rows() ) {
        //     foreach($rs->result_array() as $row) {
        //         $data[] = $row;
        //     }
        // }
        // $data['sql'] = $this->db->last_query();
        return $data;
    }

    protected function getPaymentByPayNo($pay_no) {
        $this->db->where('a.pay_no', $pay_no);
        $this->db->where('a.person_no', $this->session->userdata('person_no'));
        $this->db->where('a.is_delete', 0);
        $this->db->join('tperson b', 'a.person_no = b.person_no', 'left');
        $rs = $this->db->get('tpay a', 1);
        if( $rs->num_rows() ) {
            return $rs->row_array();
        }
        return null;
    }

    protected function getDetailPembayaran($pay_no) {
        $data = array();
        $tmp_data = array();
        $this->db->select('a.pay_no,
        a.pay_det_no,
        a.in_no,
        (a.pay_bayar + a.pay_pot) as total_bayar,
        b.pur_type,
        b.pur_ord,
        b.pur_date,
        c.pay_date');
        $this->db->where('a.pay_no', $pay_no);
        $this->db->join('tpurchase b', 'a.in_no = b.pur_no', 'left');
        $this->db->join('tpay c', 'a.pay_no = c.pay_no', 'left');
        $this->db->order_by('b.pur_type', 'ASC');
        $rs = $this->db->get('tdpay a');
        if( $rs->num_rows() ) {
            foreach($rs->result_array() as $row) {
                $row['total_bayar'] = round($row['total_bayar']);
                if( $row['pur_type'] == 2 ) {
                    if( !array_key_exists($row['pur_ord'], $tmp_data) ) {
                        $row['saldo_awal'] = $this->getSaldoAwalPerFaktur($row['in_no'], $row['pay_date']);
                        // $row['total_retur'] = $row['total_bayar'];
                        $row['total_retur'] = 0;
                        // $row['total_bayar'] = 0;
                        // $row['total_bayar'] = abs($row['total_bayar']);
                        $tmp_data[$row['in_no']] = $row;
                    }
                    else {
                        $tmp_data[$row['pur_ord']]['total_bayar'] += $row['total_bayar'];
                        $tmp_data[$row['pur_ord']]['total_retur'] += $row['total_bayar'];
                    }
                }
                else {
                    $row['saldo_awal'] = $this->getSaldoAwalPerFaktur($row['in_no'], $row['pay_date']);
                    $row['total_retur'] = 0;
                    $tmp_data[$row['in_no']] = $row;
                }
            }
        }

        if( count($tmp_data) > 0 ) {
            foreach($tmp_data as $row) {
                $data[] = $row;
            }
        }

        // $this->db->select('a.*, b.pay_date, c.pur_date, c.pur_inv');
        // $this->db->where('a.pay_no', $pay_no);
        // $this->db->join('tpay b', 'a.pay_no = b.pay_no', 'left');
        // $this->db->join('tpurchase c', 'a.in_no = c.pur_no', 'left');
        // $rs = $this->db->get('tdpay a');
        // if( $rs->num_rows() ) {
        //     foreach($rs->result_array() as $row) {
        //         $row['saldo_awal'] = $this->getSaldoAwalPerFaktur($row['in_no'], $row['pay_date']);
        //         $row['pay_bayar'] = $row['pay_bayar'] - $row['pay_pot'];
        //         $row['pay_retur'] = 0;
        //         $row['no_nota'] = $row['pur_inv'] ? $row['pur_inv'] : $row['in_no'];
        //         $data[] = $row;
        //     }
        // }
        return $data;
    }

    protected function getSaldoAwalPerFaktur( $no_faktur, $tgl_transaksi ) {
        $this->db->select_sum("(a.debet - a.kredit)", "saldo_awal");
        $this->db->where('a.in_no', $no_faktur);
        $this->db->where('a.tgl <', $tgl_transaksi);
        $rs = $this->db->get('trans_hutang a');
        if( $rs->num_rows() ) {
            return round($rs->row()->saldo_awal);
        }
        return 0;
    }

    protected function getCekOutByPayNo($pay_no) {
        $data = array();
        $this->db->select('a.*, b.rek_nama');
        $this->db->where('a.pay_no', $pay_no);
        $this->db->join('trek b', 'a.rek_no = b.rek_no', 'left');
        $rs = $this->db->get('tcek_out a');
        if( $rs->num_rows() ) {
            foreach($rs->result_array() as $row) {
                switch($row['cek_type']) {
                    case 1:
                        $row['jenis_transaksi'] = "TRANSFER";
                        break;
                    case 2:
                        $row['jenis_transaksi'] = "BG";
                        break;
                    default:
                        $row['jenis_transaksi'] = "TUNAI";
                        break;
                }
                $data[] = $row;
            }
        }
        return $data;
    }

    public function update_password() {
        $return = array('success' => false);

        if($params = $this->input->post('params')) {
            parse_str($params, $values);
            $this->db->where('user_pass', $values['old_password']);
            $this->db->where('user_name', $this->_user()->username);
            $rs = $this->db->get('tusers_supplier');
            if( $rs->num_rows() ) {
                if( $values['password_baru'] == $values['password_ulang'] ) {
                    
                    $this->db->set('user_pass', $values['password_baru']);
                    $this->db->where('id', $this->_user()->user_id);
                    $rs = $this->db->get('tusers_supplier');
                    $return['success'] = true;
                    
                } else {
                    $return['text'] = "Password baru dan ulang password anda tidak sesuai";
                }
            }
            else {
                $return['text'] = "Password lama anda salah";
            }
        }

        header('Content-Type: application/json');
        echo json_encode($return);        
    }

    public function downloadfile() {
        $this->load->helper('download');
        $filepath = FCPATH."uploads/npwp-suksesjaya.pdf";
        force_download($filepath, NULL);
    }
}
