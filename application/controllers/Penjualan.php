<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 10:57 AM
 */

class Penjualan extends IO_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        show_error('Halaman tidak ditemukan silakan kembali ke dashboard', 404, '404 - Page Not Found');
    }

    public function rangkuman()
    {
        $this->data['title'] = 'Laporan Penjualan - Rangkuman';
        $this->data['content'] = "penjualan/rangkuman";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.penjualanRangkuman();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function rincian()
    {
        $this->data['title'] = 'Laporan Penjualan - Rincian';
        $this->data['content'] = "penjualan/rincian";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.penjualanRincian();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function rangkumancustomer()
    {
        $this->data['title'] = 'Laporan Penjualan - Rangkuman Customer';
        $this->data['content'] = "penjualan/customer";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.penjualanCustomer();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function saldopiutang()
    {
        $this->data['title'] = 'Laporan Saldo Piutang';
        $this->data['content'] = "penjualan/saldopiutang";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.saldoPiutang();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function kartupiutang()
    {
        $this->data['title'] = 'Laporan Kartu Piutang';
        $this->data['content'] = "penjualan/kartupiutang";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.saldoKartuPiutang();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function jatuhtempo()
    {
        $this->data['title'] = 'Laporan Jatuh Tempo Piutang';
        $this->data['content'] = "penjualan/jatuhtempo";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.jatuhTempo();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function subitem()
    {
        $this->data['title'] = 'Laporan Penjualan - Sub Item';
        $this->data['content'] = "penjualan/subitem";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpenjualan.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPenjualan.penjualanSubItem();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function datatable_rangkuman() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtercustomer',
            'filterjenis'
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

        $this->db->start_cache();

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( a.jual_no LIKE '%{$q}%' OR a.jual_reff LIKE '%{$q}%' OR b.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("a.jual_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('a.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('a.jual_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('a.is_delete', 0);
        $this->db->join('tperson b', 'a.person_no = b.person_no AND a.is_delete = b.is_delete', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('tsales a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("a.jual_date, a.jual_no, a.jual_reff, a.cab_no, b.person_code, b.person_name, a.jual_sub_total_kurs, a.jual_disc0_rp_kurs, 0 AS ongkir,   a.jual_tax_rp, a.jual_total_kurs, if(is_ppn=2, 'Inc', if(is_ppn=1, 'Exc', '')) AS ket_pjk, a.is_delete, a.jual_type");
            $this->db->limit($length, $start);
            $this->db->order_by('b.person_code', 'ASC');
            $this->db->order_by('a.jual_date', 'ASC');
            $this->db->order_by('a.jual_no', 'ASC');
            $rs = $this->db->get('tsales a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['jual_date'] = date('d-m-Y H:i:s', strtotime($row['jual_date']));
                    $row['jual_sub_total_kurs'] = number_format($row['jual_sub_total_kurs'], 2);
                    $row['jual_disc0_rp_kurs'] = number_format($row['jual_disc0_rp_kurs'], 2);
                    $row['ongkir'] = number_format($row['ongkir'], 2);
                    $row['jual_tax_rp'] = number_format($row['jual_tax_rp'], 2);
                    $row['jual_total_kurs'] = number_format($row['jual_total_kurs'], 2);
                    $return['aaData'][] = $row;
                }
            }
        }

        $this->db->flush_cache();
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_rincian() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtercustomer',
            'filterjenis'
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

        $this->db->start_cache();

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( b.jual_no LIKE '%{$q}%' OR b.jual_reff LIKE '%{$q}%' OR d.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("b.jual_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('b.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('b.jual_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('b.is_delete', 0);
        $this->db->join('tsales b', 'a.jual_no = b.jual_no', 'left');
        $this->db->join('tproduct c', 'a.prod_no = c.prod_no', 'left');
        $this->db->join('tperson d', 'b.person_no = d.person_no', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('td_sales a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("d.person_name, b.jual_no, b.jual_date, b.sal_ord, b.jual_desc, c.prod_code0 as kodebrg,c.prod_name0 as nmbrg, a.qty_satuan as qty,if(a.satuan=1,c.prod_uom,if(a.satuan=2,c.prod_uom2,if(a.satuan=3, c.prod_uom3, c.prod_uom))) as nm_satuan,a.harga_satuan as hgjual, IFNULL(a.disc1_persen,0) as disc1_persen, IFNULL(a.disc1_rp,0) as disc1_rp, IFNULL(a.disc2_persen,0) as disc2_persen, IFNULL(a.disc2_rp,0) as disc2_rp, IFNULL(a.disc3_persen,0) as disc3_persen, IFNULL(a.disc3_rp,0) as disc3_rp,a.det_total, a.is_tax, b.is_ppn,(a.price_netto * a.konversi) as netto, b.jual_sub_total_kurs, b.jual_disc0_persen, b.jual_disc0_rp_kurs, 0 AS ongkir,b.jual_tax_rp, b.jual_total_kurs");
            $this->db->limit($length, $start);
            $this->db->order_by('d.person_code', 'ASC');
            $this->db->order_by('b.jual_date', 'ASC');
            $this->db->order_by('b.jual_no', 'ASC');
            $rs = $this->db->get('td_sales a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['jual_date'] = date('d-m-Y H:i:s', strtotime($row['jual_date']));
                    $row['ppn'] = 0;
                    switch ($row['is_ppn']) {
                        case 1:
                            $row['total_ppn'] = $row['det_total'] * (10/100);
                            $row['ppn_type'] = "EXC";
                            break;
                        case 2:
                            $row['total_ppn'] = $row['det_total'] - ( $row['det_total'] / 1.1 );
                            $row['ppn_type'] = "INC";
                            break;
                        default:
                            $row['total_ppn'] = 0;
                            $row['ppn_type'] = "NONE";
                            break;
                    }
                    $row['qty'] = number_format($row['qty'], 2);
                    $row['hgjual'] = number_format($row['hgjual'], 2);
                    $row['disc1_persen'] = number_format($row['disc1_persen'], 2);
                    $row['disc1_rp'] = number_format($row['disc1_rp'], 2);
                    $row['disc2_persen'] = number_format($row['disc2_persen'], 2);
                    $row['disc2_rp'] = number_format($row['disc2_rp'], 2);
                    $row['disc3_persen'] = number_format($row['disc3_persen'], 2);
                    $row['disc3_rp'] = number_format($row['disc3_rp'], 2);
                    $row['jual_total_kurs'] = number_format($row['jual_total_kurs'], 2);
                    $row['det_total'] = number_format($row['det_total'], 2);
                    $row['total_ppn'] = number_format($row['total_ppn'], 2);
                    $row['gt'] = number_format(($row['netto'] * $row['qty']), 2);
                    $row['jual_sub_total_kurs'] = number_format($row['jual_sub_total_kurs'], 2);
                    $row['row_title'] = $row['jual_no']." ( ".$row['person_name']." )";
                    $return['aaData'][] = $row;
                }
            }
        }

        $this->db->flush_cache();
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_customer() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtercustomer',
            'filterjenis'
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

        $this->db->start_cache();

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( b.jual_no LIKE '%{$q}%' OR b.jual_reff LIKE '%{$q}%' OR c.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("b.jual_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('b.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('b.jual_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('b.is_delete', 0);
        $this->db->join('tsales b', 'a.out_no = b.jual_no', 'left');
        $this->db->join('tperson c', 'b.person_no = c.person_no', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('tpiutang a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("c.person_name, b.jual_date, a.out_no as jual_no, b.jual_reff, b.jual_sub_total_kurs,  b.jual_disc0_rp_kurs, '0' as jual_ongkir,b.jual_tax_rp, a.total_piutang, (a.total_potongan + a.total_bayar + a.total_retur) as byr, a.total_piutang - (a.total_potongan + a.total_bayar + a.total_retur) as saldo, if(b.is_ppn=2, 'Inc', if(is_ppn=1, 'Exc', '')) as ket_pjk");
            $this->db->limit($length, $start);
            $this->db->order_by('c.person_code', 'ASC');
            $this->db->order_by('b.jual_date', 'ASC');
            $rs = $this->db->get('tpiutang a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['jual_date'] = date('d-m-Y H:i:s', strtotime($row['jual_date']));
                    $row['jual_sub_total_kurs'] = number_format($row['jual_sub_total_kurs'],2);
                    $row['jual_disc0_rp_kurs'] = number_format($row['jual_disc0_rp_kurs'],2);
                    $row['jual_ongkir'] = number_format($row['jual_ongkir'],2);
                    $row['jual_tax_rp'] = number_format($row['jual_tax_rp'],2);
                    $row['total_piutang'] = number_format($row['total_piutang'],2);
                    $row['byr'] = number_format($row['byr'],2);
                    $row['saldo'] = number_format($row['saldo'],2);
                    $return['aaData'][] = $row;
                }
            }
        }

        $this->db->flush_cache();
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_saldo_piutang() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtercustomer'
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

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->like("a.person_name", $q, 'both');
        }

        if( $filtercustomer ) {
            $this->db->where('a.person_no', $filtercustomer);
        }

        $this->db->where('a.person_type', 0);
        $this->db->where('a.is_delete', 0);

        $person = array();
        $this->db->select('a.person_no, a.person_code, a.person_name');
        $this->db->order_by('a.person_name', 'asc');
        $rs = $this->db->get('tperson a');

        $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $rs->num_rows();

        foreach ($rs->result_array() as $row) {
            $row['saldo_awal'] = 0;
            $row['tambah'] = 0;
            $row['kurang'] = 0;
            $row['saldo_akhir'] = 0;
            $person[$row['person_no']] = $row;
        }

        /** SALDO AWAL **/

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_awal');
        $this->db->where('a.is_delete', 0);
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tsales a');

//        $return['db'] = $this->db->last_query();

        if($rs->num_rows()) {
            foreach ($rs->result_array() as $row) {
                if( array_key_exists($row['person_no'], $person) ) {
                    $person[$row['person_no']]['saldo_awal'] = $row['saldo_awal'];
                    $person[$row['person_no']]['saldo_akhir'] = $row['saldo_awal'];
                }
            }
        }

        $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
        $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";


        /** PENGURANG SALDO AWAL **/

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_sisa');
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.jual_date >=', $startdate);
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tsales a');
        if($rs->num_rows()) {
            foreach ($rs->result_array() as $row) {
                $person[$row['person_no']]['saldo_awal'] -= $row['saldo_sisa'];
            }
        }

        /** TRANSAKSI PIUTANG **/

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->select('a.person_no, b.jual_type, sum(debet_kurs) as tambah, sum(kredit_kurs) as kurang');
        $this->db->join('tsales b', 'a.out_no = b.jual_no');
        $this->db->where("a.tgl BETWEEN '{$startdate}' AND '{$enddate}'");
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no, b.jual_type');
        $rs = $this->db->get('trans_piutang a');
        if( $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                if(  array_key_exists($row['person_no'], $person) ) {
                    $person[$row['person_no']]['tambah'] += $row['tambah'];
                    $person[$row['person_no']]['kurang'] += $row['kurang'];
//                        $person[$row['person_no']]['saldo_akhir'] += $person[$row['person_no']]['saldo_awal'] + ($row['tambah'] - $row['kurang']);
                }
            }
        }

        foreach ($person as $row) {

            $row['saldo_akhir'] = $row['saldo_awal'] + ( $row['tambah'] - $row['kurang'] );

            $row['saldo_awal'] = number_format($row['saldo_awal'], 2);
            $row['tambah'] = number_format($row['tambah'], 2);
            $row['kurang'] = number_format($row['kurang'], 2);
            $row['saldo_akhir'] = number_format($row['saldo_akhir'], 2);
            $return['aaData'][] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_kartu_piutang() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filtercustomer'
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

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->like("a.person_name", $q, 'both');
        }

        if( $filtercustomer ) {

            $data = array();
            /** SALDO AWAL **/

            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";

            $saldo_awal = 0;

            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
            }

            $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_awal');
            $this->db->where('a.is_delete', 0);
            $this->db->where('a.person_no', $filtercustomer);
            $this->db->group_by('a.person_no');
            $rs = $this->db->get('tsales a', 1);

            if($rs->num_rows()) {
                $row = $rs->row_array();
                $saldo_awal = $row['saldo_awal'];
            }

            /** PENGURANG SALDO AWAL **/

            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
            }

            $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_sisa');
            $this->db->where('a.is_delete', 0);
            $this->db->where('a.jual_date >=', $startdate);
            $this->db->where('a.person_no', $filtercustomer);
            $this->db->group_by('a.person_no');
            $rs = $this->db->get('tsales a');
            if($rs->num_rows()) {
                foreach ($rs->result_array() as $row) {
                    $saldo_awal -= $row['saldo_sisa'];
                }
            }

            /** TRANSAKSI DETAIL PIUTANG **/

            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
            }

            $data[] = array(
                'jual_no' => "SALDO AWAL",
                'jual_date' => $startdate,
                'jual_type' => 0,
                'tipe_trans' => 'SALDO AWAL',
                'tambah' => number_format($saldo_awal,2),
                'kurang' => 0,
                'saldo_akhir' => number_format($saldo_awal,2),
                'sal_no' => ''
            );

            $this->db->select('b.jual_no, b.jual_date, b.jual_type, a.ter_no, debet_kurs as tambah, kredit_kurs as kurang');
            $this->db->join('tsales b', 'a.out_no = b.jual_no');
            $this->db->where("a.tgl BETWEEN '{$startdate}' AND '{$enddate}'");
            $this->db->where('a.person_no', $filtercustomer);
            $rs = $this->db->get('trans_piutang a');

            if( $rs->num_rows() ) {

                $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $rs->num_rows() + 1;

                foreach ($rs->result_array() as $row) {
                    $saldo_awal = $saldo_awal + ($row['tambah'] - $row['kurang']);

                    $d = array(
                        'jual_no' => $row['jual_no'],
                        'jual_date' => $row['jual_date'],
                        'jual_type' => $row['jual_type'],
                        'tipe_trans' => '',
                        'tambah' => $row['tambah'],
                        'kurang' => $row['kurang'],
                        'saldo_akhir' => $saldo_awal,
                        'sal_no' => ""
                    );

                    switch ($row['jual_type']) {
                        case 1:
                            $d['tipe_trans'] = "Penjualan";
                            break;
                        case 2:
                            $d['tipe_trans'] = "Return Penjualan";
                            break;
                        default:
                            $d['tipe_trans'] = "Piutang Awal";
                            break;
                    }

                    if( !empty($row['ter_no']) ) {
                        $d['tipe_trans'] = "Pembayaran";
                        $d['sal_no'] = $d['jual_no'];
                        $d['jual_no'] = $row['ter_no'];
                    }

                    $d['tambah'] = number_format($d['tambah'],2);
                    $d['kurang'] = number_format($d['kurang'],2);
                    $d['saldo_akhir'] = number_format($d['saldo_akhir'],2);

                    $data[] = $d;
                }
            }

            $return['aaData'] = $data;

        }

//        echo "<pre>";
//        print_r($return);
//        echo "</pre>";
//        die();

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_jatuhtempo() {
        $field = array(
            'search',
            'start',
            'length',
            'enddate',
            'filtercustomer',
            'filterjenis',
            'filtertop'
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

        $this->db->start_cache();

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( a.jual_no LIKE '%{$q}%' OR d.nama LIKE '%{$q}%' OR b.person_name LIKE '%{$q}%' OR b.person_code LIKE '%{$q}%' )");
        }

        if( $enddate ) {
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("a.jual_date <=", $enddate);
        }

        if( $filtercustomer ) {
            $this->db->where('a.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('a.jual_type', $filterjenis);
        }
        else {
            $this->db->where('a.jual_type < ', 10);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        if( $filtertop ) {
            $this->db->where('a.top_id', $filtertop);
        }

//        $this->db->where('a.jual_type <', 10);
        $this->db->where('a.is_delete', 0);
        $this->db->where('(e.total_piutang - e.total_retur - e.total_potongan - e.total_bayar) <>', 0, FALSE);
        $this->db->where("abs(datediff('2019-04-06 23:59:59', a.jual_date)) >= a.ndays", NULL, FALSE);
//        $this->db->where('a.user_id', $this->session->userdata('id_user'));

        $this->db->join('tperson b', 'a.person_no = b.person_no', 'left');
        $this->db->join('tsal c', 'a.sal_no = c.sal_no', 'left');
        $this->db->join('toutlet d', 'a.let_no = d.let_no', 'left');
        $this->db->join('tpiutang e', 'a.jual_no = e.out_no', 'left');

        $this->db->stop_cache();

        $total = $this->db->count_all_results('tsales a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("a.jual_no,
                a.jual_date,
                a.person_no,
                a.top_id,
                a.jual_total_kurs, 
                b.person_name, 
                b.person_alamat,   
                concat(a.ndays, ' ', 'Hari') AS topname, 
                datediff('".$enddate."', a.jual_date) selisih_ndays,
                c.sal_name, 
                d.nama as nm_outlet,  
                adddate(a.jual_date,a.ndays) as duedate,
                e.total_piutang,
                e.total_retur,
                e.total_potongan,
                e.total_bayar,  
                (e.total_piutang - e.total_retur - e.total_potongan - e.total_bayar) as sisa");
            $this->db->limit($length, $start);
//            $this->db->order_by("datediff('".$enddate."', a.jual_date) ASC");
            $this->db->order_by("adddate(a.jual_date,a.ndays) ASC");
            $rs = $this->db->get('tsales a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['tgl'] = date('d-m-Y H:i:s', strtotime($row['jual_date']));
                    $row['tgl_duedate'] = date('d-m-Y H:i:s', strtotime($row['duedate']));
                    $row['jual_total_kurs_format'] = number_format($row['jual_total_kurs'], 2);
                    $row['sisa_format'] = number_format($row['sisa'], 2);

                    $return['aaData'][] = $row;
                }
            }
        }

//        $return['db'] = $this->db->last_query();

        $this->db->flush_cache();
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_subitem() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filteritem',
            'filtersubitem',
            'filtertipe'
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

        $this->db->start_cache();

        if( !empty($search['value']) ) {
            $q = $this->db->escape_str(trim($search['value']));
            $this->db->where("( a.jual_no LIKE '%{$q}%' OR c.prod_code0 LIKE '%{$q}%' OR c.prod_name0 LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("a.jual_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtertipe > -1 ) {
            $this->db->where('a.is_pos', $filtertipe);
        }

        $table = "";
        $table_field = "";
        $desc = "";

        if( $filteritem ) {
            switch ($filteritem) {
                case 1:
                    $table = "tcat";
                    $table_field = "cat_id";
                    $desc = "KATEGORI";
                    break;
                case 2:
                    $table = "tgroup";
                    $table_field = "group_id";
                    $desc = "VARIAN";
                    break;
                case 3:
                    $table = "tvarian";
                    $table_field = "varian_id";
                    $desc = "SUB VARIAN";
                    break;
                case 4:
                    $table = "tm_merk";
                    $table_field = "merk_id";
                    $desc = "MERK";
                    break;
                case 5:
                    $table = "tm_rak";
                    $table_field = "rak_id";
                    $desc = "RAK";
                    break;
                case 6:
                    $table = "tm_rak_gudang";
                    $table_field = "rak_gudang";
                    $desc = "WAREHOUSE";
                    break;
            }
//            $this->db->order_by('c.prod_name0', 'ASC');
        }

        if( $filtersubitem ) {
            switch ($filteritem) {
                case 1:
                    $this->db->where('c.cat_id', $filtersubitem);
                    break;
                case 2:
                    $this->db->where('c.group_id', $filtersubitem);
                    break;
                case 3:
                    $this->db->where('c.varian_id', $filtersubitem);
                    break;
                case 4:
                    $this->db->where('c.merk_id', $filtersubitem);
                    break;
                case 5:
                    $this->db->where('c.rak_id', $filtersubitem);
                    break;
                case 6:
                    $this->db->where('c.rak_gudang', $filtersubitem);
                    break;
            }
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('a.is_delete', 0);
        $this->db->where('a.jual_type', 1);
        $this->db->where('b.prod_no IS NOT NULL', '', FALSE);
        $this->db->join('td_sales b', 'a.jual_no = b.jual_no', 'left');
        $this->db->join('tproduct c', 'b.prod_no = c.prod_no', 'left');
        $this->db->join('ttrans_hpp d', 'b.out_det_no = d.out_det_no', 'left');

        $this->db->select("a.is_pos, 
                    b.prod_no,   
                    b.satuan, 
                    c.prod_code0, 
                    c.prod_name0, 
                    c.prod_uom, 
                    c.prod_uom2, 
                    c.prod_uom3, 
                    IF(c.cat_id > 0, c.cat_id, 0) as cat_id, 
                    IF(c.group_id > 0, c.group_id, 0) as group_id , 
                    IF(c.varian_id > 0, c.varian_id, 0) as varian_id, 
                    IF(c.merk_id > 0, c.merk_id, 0) as merk_id, 
                    IF(c.rak_id > 0, c.rak_id, 0) as rak_id, 
                    IF(c.rak_gudang > 0, c.rak_gudang, 0) as rak_gudang, 
                    d.prod_netto_price, 
                    SUM(b.qty_satuan) AS qty_satuan,
                    SUM(b.det_total_kurs) AS det_total_kurs,
                    SUM(b.det_sales_qty) AS sal_det_qty");

        $this->db->group_by('1,2,3,4,5,6,7,8,9,10,11,12,13,14,15');

        $this->db->stop_cache();
        $rs = $this->db->get('tsales a');
        $total = $rs->num_rows();
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->limit($length, $start);


            if( $filteritem ) {
                $this->db->order_by('IF(c.'.$table_field.' > 0, c.'.$table_field.', 0) ASC');
            }

            $this->db->order_by('c.prod_name0', 'ASC');


            $rs = $this->db->get('tsales a');

//            echo $this->db->last_query();
//            die();

            $this->db->flush_cache();
            if( $rs->num_rows() ) {
                $arr_group = array();

                if( $table ) {
                    $arr_gr = array();
                    foreach ($rs->result_array() as $row) {
                        if( !in_array($row[$table_field], $arr_gr) ) {
                            $arr_gr[] = $row[$table_field];
                        }
                    }

                    $this->db->where('is_delete', 0);
                    $this->db->where_in($table_field, $arr_gr);
                    $gr = $this->db->get($table);
                    if( $gr->num_rows() ) {
                        foreach ($gr->result_array() as $grr) {
                            $arr_group[$grr[$table_field]] = $grr['nama'];
                        }
                    }
                }

                foreach ($rs->result_array() as $row) {
                    $total_hpp = $row['qty_satuan'] * $row['prod_netto_price'];
                    $data = array(
                        'prod_no' => $row['prod_no'],
                        'prod_code0' => $row['prod_code0'],
                        'prod_name0' => $row['prod_name0'],
                        'qty_satuan' => number_format($row['qty_satuan'], 2),
                        'total_jual' => number_format($row['det_total_kurs'], 2),
                        'price_netto' => number_format($total_hpp, 2),
                        'laba' => number_format($row['det_total_kurs'] - $total_hpp, 2),
                        'group_data' => ""
                    );

                    if( $table != "" ) {
                        $data['group_data_id'] = $row[$table_field];
                        $data['group_data'] = $desc." ".(isset($arr_group[$row[$table_field]]) ? strtoupper($arr_group[$row[$table_field]]) : "");
                    }

                    switch ($row['satuan']) {
                        case 2:
                            $data['prod_uom'] = $row['prod_uom2'];
                            break;
                        case 3:
                            $data['prod_uom'] = $row['prod_uom3'];
                            break;
                        default:
                            $data['prod_uom'] = $row['prod_uom'];
                            break;
                    }



                    $return['aaData'][] = $data;
                }
            }
        }

        $this->db->flush_cache();
        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function testquery() {
        $data = array();

        $sd = '2017-01-01 00:00:00';
        $ed = '2019-03-04 23:59:59';

        $this->db->select('a.person_no, a.person_code, a.person_name');
        $this->db->where('a.person_type', 0);
        $this->db->where('a.is_delete', 0);
        $rs = $this->db->get('tperson a');
        if( $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                $row['saldo_awal'] = 0;
                $row['tambah'] = 0;
                $row['kurang'] = 0;
                $row['saldo_akhir'] = 0;
                $data[$row['person_no']] = $row;
            }
        }

        /*SALDO AWAL*/
        $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_awal');
        $this->db->where('a.is_delete', 0);
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tsales a');
        if($rs->num_rows()) {
            foreach ($rs->result_array() as $row) {
                $data[$row['person_no']]['saldo_awal'] = $row['saldo_awal'];
            }
        }

        /* PENGURANG SALDO AWAL */
        $this->db->select('a.person_no, SUM(CASE WHEN a.jual_type = 2 THEN (a.jual_total_kurs * -1) ELSE a.jual_total_kurs END) as saldo_sisa');
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.jual_date >=', $sd);
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tsales a');
        if($rs->num_rows()) {
            foreach ($rs->result_array() as $row) {
                $data[$row['person_no']]['saldo_awal'] -= $row['saldo_sisa'];
            }
        }

        /* AMBIL TRANSAKSI */
        $this->db->select('a.person_no, b.jual_type, sum(debet_kurs) as tambah, sum(kredit_kurs) as kurang');
        $this->db->join('tsales b', 'a.out_no = b.jual_no');
        $this->db->where("a.tgl BETWEEN '{$sd}' AND '{$ed}'");
        $this->db->group_by('a.person_no, b.jual_type');
        $rs = $this->db->get('trans_piutang a');
        if( $rs->num_rows() ) {
            foreach ($rs->result_array() as $row) {
                if(  array_key_exists($row['person_no'], $data) ) {
                    $data[$row['person_no']]['tambah'] += $row['tambah'];
                    $data[$row['person_no']]['kurang'] += $row['kurang'];
                    $data[$row['person_no']]['saldo_akhir'] += $data[$row['person_no']]['saldo_awal'] + ($row['tambah'] - $row['kurang']);
                }
            }
        }


        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}