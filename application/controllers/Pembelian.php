<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 10:57 AM
 */

class Pembelian extends IO_Controller
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
        $this->data['title'] = 'Laporan Pembelian - Rangkuman';
        $this->data['content'] = "pembelian/rangkuman";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.pembelianRangkuman();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function rincian()
    {
        $this->data['title'] = 'Laporan Pembelian - Rincian';
        $this->data['content'] = "pembelian/rincian";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.pembelianRincian();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function rangkumansupplier()
    {
        $this->data['title'] = 'Laporan Pembelian - Rangkuman Supplier';
        $this->data['content'] = "pembelian/supplier";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.pembelianSupplier();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function saldohutang()
    {
        $this->data['title'] = 'Laporan Saldo Hutang';
        $this->data['content'] = "pembelian/saldohutang";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.saldoHutang();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function kartuhutang()
    {
        $this->data['title'] = 'Laporan Kartu Hutang';
        $this->data['content'] = "pembelian/kartuhutang";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.saldoKartuHutang();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function jatuhtempo()
    {
        $this->data['title'] = 'Laporan Jatuh Tempo Hutang';
        $this->data['content'] = "pembelian/jatuhtempo";
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/laporanpembelian.js" type="text/javascript"></script>'
            . '<script>'
            . 'LaporanPembelian.jatuhTempo();'
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
            $this->db->where("( a.pur_no LIKE '%{$q}%' OR a.pur_inv LIKE '%{$q}%' OR b.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("a.pur_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('a.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('a.pur_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('a.is_delete', 0);
        $this->db->join('tperson b', 'a.person_no = b.person_no AND a.is_delete = b.is_delete', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('tpurchase a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("a.pur_date, a.pur_no, a.pur_inv, a.cab_no, b.person_code, b.person_name, a.pur_sub_total_kurs, a.pur_pot_rp_kurs, pur_ongkir AS ongkir,   a.pur_ppn_rp_kurs, a.pur_total_kurs, if(is_ppn=2, 'Inc', if(is_ppn=1, 'Exc', '')) AS ket_pjk, a.is_delete, a.pur_type");
            $this->db->limit($length, $start);
            $this->db->order_by('b.person_code', 'ASC');
            $this->db->order_by('a.pur_date', 'ASC');
            $this->db->order_by('a.pur_no', 'ASC');
            $rs = $this->db->get('tpurchase a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['pur_date'] = date('d-m-Y H:i:s', strtotime($row['pur_date']));
                    $row['pur_sub_total_kurs'] = number_format($row['pur_sub_total_kurs'], 2);
                    $row['pur_pot_rp_kurs'] = number_format($row['pur_pot_rp_kurs'], 2);
                    $row['ongkir'] = number_format($row['ongkir'], 2);
                    $row['pur_ppn_rp_kurs'] = number_format($row['pur_ppn_rp_kurs'], 2);
                    $row['pur_total_kurs'] = number_format($row['pur_total_kurs'], 2);
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
            $this->db->where("( b.pur_no LIKE '%{$q}%' OR b.pur_inv LIKE '%{$q}%' OR d.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("b.pur_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('b.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('b.pur_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('b.is_delete', 0);
        $this->db->join('tpurchase b', 'a.pur_no = b.pur_no', 'left');
        $this->db->join('tproduct c', 'a.prod_no = c.prod_no', 'left');
        $this->db->join('tperson d', 'b.person_no = d.person_no', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('td_purchase a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("d.person_name, b.pur_no, b.pur_date, b.pur_ord, b.pur_ket, c.prod_code0 as kodebrg,c.prod_name0 as nmbrg, a.qty_satuan as qty,if(a.satuan=1,c.prod_uom,if(a.satuan=2,c.prod_uom2,if(a.satuan=3, c.prod_uom3, c.prod_uom))) as nm_satuan,a.pur_det_price as hgjual, IFNULL(a.disc1_persen,0) as disc1_persen, IFNULL(a.disc1_rp,0) as disc1_rp, IFNULL(a.disc2_persen,0) as disc2_persen, IFNULL(a.disc2_rp,0) as disc2_rp, IFNULL(a.disc3_persen,0) as disc3_persen, IFNULL(a.disc3_rp,0) as disc3_rp,a.pur_det_sub_total as det_total, b.is_ppn,(a.price_netto * a.konversi) as netto, b.pur_sub_total_kurs, b.pur_pot_persen, b.pur_pot_rp_kurs, 0 AS ongkir,b.pur_ppn_rp_kurs, b.pur_total_kurs");
            $this->db->limit($length, $start);
            $this->db->order_by('d.person_code', 'ASC');
            $this->db->order_by('b.pur_date', 'ASC');
            $this->db->order_by('b.pur_no', 'ASC');
            $rs = $this->db->get('td_purchase a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['pur_date'] = date('d-m-Y H:i:s', strtotime($row['pur_date']));
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
                    $row['pur_total_kurs'] = number_format($row['pur_total_kurs'], 2);
                    $row['det_total'] = number_format($row['det_total'], 2);
                    $row['total_ppn'] = number_format($row['total_ppn'], 2);
                    $row['gt'] = number_format(($row['netto'] * $row['qty']), 2);
                    $row['pur_sub_total_kurs'] = number_format($row['pur_sub_total_kurs'], 2);
                    $row['row_title'] = $row['pur_no']." ( ".$row['person_name']." )";
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
            $this->db->where("( b.pur_no LIKE '%{$q}%' OR b.pur_inv LIKE '%{$q}%' OR c.person_name LIKE '%{$q}%' )");
        }

        if( $startdate && $enddate ) {
            $startdate = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $this->db->where("b.pur_date BETWEEN '{$startdate}' AND '{$enddate}'");
        }

        if( $filtercustomer ) {
            $this->db->where('b.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('b.pur_type', $filterjenis);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->where('b.is_delete', 0);
        $this->db->join('tpurchase b', 'a.in_no = b.pur_no', 'left');
        $this->db->join('tperson c', 'b.person_no = c.person_no', 'left');
        $this->db->stop_cache();
        $total = $this->db->count_all_results('thutang a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("c.person_name, b.pur_date, a.in_no as pur_no, b.pur_inv, b.pur_sub_total_kurs,  b.pur_pot_rp_kurs, b.biaya_ekspedisi as beli_ongkir,b.pur_ppn_rp_kurs, a.total_hutang, (a.total_potongan + a.total_bayar + a.total_retur) as byr, a.total_hutang - (a.total_potongan + a.total_bayar + a.total_retur) as saldo, if(b.is_ppn=2, 'Inc', if(is_ppn=1, 'Exc', '')) as ket_pjk");
            $this->db->limit($length, $start);
            $this->db->order_by('c.person_code', 'ASC');
            $this->db->order_by('b.pur_date', 'ASC');
            $rs = $this->db->get('thutang a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['pur_date'] = date('d-m-Y H:i:s', strtotime($row['pur_date']));
                    $row['pur_sub_total_kurs'] = number_format($row['pur_sub_total_kurs'],2);
                    $row['pur_pot_rp_kurs'] = number_format($row['pur_pot_rp_kurs'],2);
                    $row['beli_ongkir'] = number_format($row['beli_ongkir'],2);
                    $row['pur_ppn_rp_kurs'] = number_format($row['pur_ppn_rp_kurs'],2);
                    $row['total_hutang'] = number_format($row['total_hutang'],2);
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

    public function datatable_kartu_hutang() {
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

            $this->db->select('a.person_no, SUM(CASE WHEN a.pur_type = 2 THEN (a.pur_total_kurs * -1) ELSE a.pur_total_kurs END) as saldo_awal');
            $this->db->where('a.is_delete', 0);
            $this->db->where('a.person_no', $filtercustomer);
            $this->db->group_by('a.person_no');
            $rs = $this->db->get('tpurchase a', 1);

            if($rs->num_rows()) {
                $row = $rs->row_array();
                $saldo_awal = $row['saldo_awal'];
            }

            /** PENGURANG SALDO AWAL **/

            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
            }

            $this->db->select('a.person_no, SUM(CASE WHEN a.pur_type = 2 THEN (a.pur_total_kurs * -1) ELSE a.pur_total_kurs END) as saldo_sisa');
            $this->db->where('a.is_delete', 0);
            $this->db->where('a.pur_date >=', $startdate);
            $this->db->where('a.person_no', $filtercustomer);
            $this->db->group_by('a.person_no');
            $rs = $this->db->get('tpurchase a');
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
                'pur_no' => "SALDO AWAL",
                'pur_date' => $startdate,
                'pur_type' => 0,
                'tipe_trans' => 'SALDO AWAL',
                'tambah' => number_format($saldo_awal,2),
                'kurang' => 0,
                'saldo_akhir' => number_format($saldo_awal,2),
                'sal_no' => ''
            );

            $this->db->select('b.pur_no, b.pur_date, b.pur_type, a.pay_no, debet_kurs as tambah, kredit_kurs as kurang');
            $this->db->join('tpurchase b', 'a.in_no = b.pur_no');
            $this->db->where("a.tgl BETWEEN '{$startdate}' AND '{$enddate}'");
            $this->db->where('a.person_no', $filtercustomer);
            $rs = $this->db->get('trans_hutang a');

            if( $rs->num_rows() ) {

                $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $rs->num_rows() + 1;

                foreach ($rs->result_array() as $row) {
                    $saldo_awal = $saldo_awal + ($row['tambah'] - $row['kurang']);

                    $d = array(
                        'pur_no' => $row['pur_no'],
                        'pur_date' => $row['pur_date'],
                        'pur_type' => $row['pur_type'],
                        'tipe_trans' => '',
                        'tambah' => $row['tambah'],
                        'kurang' => $row['kurang'],
                        'saldo_akhir' => $saldo_awal,
                        'sal_no' => ""
                    );

                    switch ($row['pur_type']) {
                        case 1:
                            $d['tipe_trans'] = "Pembelian";
                            break;
                        case 2:
                            $d['tipe_trans'] = "Return Pembelian";
                            break;
                        default:
                            $d['tipe_trans'] = "Hutang Awal";
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

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_saldo_hutang() {
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

        $this->db->where('a.person_type', 1);
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

        $this->db->select('a.person_no, SUM(CASE WHEN a.pur_type = 2 THEN (a.pur_total_kurs * -1) ELSE a.pur_total_kurs END) as saldo_awal');
        $this->db->where('a.is_delete', 0);
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tpurchase a');

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

        $this->db->select('a.person_no, SUM(CASE WHEN a.pur_type = 2 THEN (a.pur_total_kurs * -1) ELSE a.pur_total_kurs END) as saldo_sisa');
        $this->db->where('a.is_delete', 0);
        $this->db->where('a.pur_date >=', $startdate);
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no');
        $rs = $this->db->get('tpurchase a');
        if($rs->num_rows()) {
            foreach ($rs->result_array() as $row) {
                $person[$row['person_no']]['saldo_awal'] -= $row['saldo_sisa'];
            }
        }

        /** TRANSAKSI PIUTANG **/

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        $this->db->select('a.person_no, b.pur_type, sum(debet_kurs) as tambah, sum(kredit_kurs) as kurang');
        $this->db->join('tpurchase b', 'a.in_no = b.pur_no');
        $this->db->where("a.tgl BETWEEN '{$startdate}' AND '{$enddate}'");
        $this->db->where_in('a.person_no', array_keys($person));
        $this->db->group_by('a.person_no, b.pur_type');
        $rs = $this->db->get('trans_hutang a');
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
            $this->db->where("( a.pur_no LIKE '%{$q}%' OR b.person_name LIKE '%{$q}%' OR b.person_code LIKE '%{$q}%' OR b.person_alamat LIKE '%{$q}%' )");
        }

        $enddate = date('Y-m-d', strtotime($enddate))." 23:59:59";
        if( $enddate ) {
            $this->db->where("a.pur_date <=", $enddate);
        }

        if( $filtercustomer ) {
            $this->db->where('a.person_no', $filtercustomer);
        }

        if( $filterjenis > -1 ) {
            $this->db->where('a.pur_type', $filterjenis);
        }
        else {
            $this->db->where('a.pur_type < ', 10);
        }

        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->db->where('a.cab_no', $this->session->userdata('cat_gudang_no'));
        }

        if( $filtertop ) {
            $this->db->where('a.top_id', $filtertop);
        }

        $this->db->where('a.is_delete', 0);
        $this->db->where('(e.total_hutang - e.total_retur - e.total_potongan - e.total_bayar) <>', 0, FALSE);
        $this->db->where("abs(datediff('2019-04-06 23:59:59', a.pur_date)) >= a.ndays", NULL, FALSE);
//        $this->db->where('a.user_id', $this->session->userdata('id_user'));

        $this->db->join('tperson b', 'a.person_no = b.person_no', 'left');
        $this->db->join('thutang e', 'a.pur_no = e.in_no', 'left');

        $this->db->stop_cache();

        $total = $this->db->count_all_results('tpurchase a');
        if( $total > 0 ) {
            $return['iTotalRecords'] = $return['iTotalDisplayRecords'] = $total;
            $this->db->select("a.pur_no,
                a.pur_date,
                a.person_no,
                a.top_id,
                a.pur_total_kurs, 
                b.person_name, 
                b.person_alamat,   
                concat(a.ndays, ' ', 'Hari') AS topname, 
                datediff('".$enddate."', a.pur_date) selisih_ndays,   
                adddate(a.pur_date,a.ndays) as duedate,
                e.total_hutang,
                e.total_retur,
                e.total_potongan,
                e.total_bayar,  
                (e.total_hutang - e.total_retur - e.total_potongan - e.total_bayar) as sisa");
            $this->db->limit($length, $start);
//            $this->db->order_by("datediff('2019-04-06 23:59:59', a.pur_date) ASC");
            $this->db->order_by("adddate(a.pur_date,a.ndays) ASC");
            $rs = $this->db->get('tpurchase a');
            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $row) {
                    $row['tgl'] = date('d-m-Y H:i:s', strtotime($row['pur_date']));
                    $row['tgl_duedate'] = date('d-m-Y H:i:s', strtotime($row['duedate']));
                    $row['pur_total_kurs_format'] = number_format($row['pur_total_kurs'], 2);
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

}