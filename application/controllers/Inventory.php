<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class Inventory extends IO_Controller
{
    public function index() {
        show_error('Halaman tidak ditemukan silakan kembali ke dashboard', 404, '404 - Page Not Found');
    }

    public function saldostok()
    {
        
        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->data['title'] = 'Laporan Inventory - Saldo Stok per Cabang';
            $this->data['content'] = "inventory/saldostok_gudang";
        }
        else {
            $this->data['title'] = 'Laporan Inventory - Saldo Stok Global';
            $this->data['content'] = "inventory/saldostok";
        }
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/inventory.js" type="text/javascript"></script>'
            . '<script>'
            . 'Inventory.initSaldoStok();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function kartustok()
    {
        
        if( $this->session->userdata('cat_gudang_no') != "all" ) {
            $this->data['title'] = 'Laporan Inventory - Kartu Stok per Cabang';
            $this->data['content'] = "inventory/kartustok_gudang";
        }
        else {
            $this->data['title'] = 'Laporan Inventory - Kartu Stok Global';
            $this->data['content'] = "inventory/kartustok";
        }
        $this->data['additional_css'] = '<link href="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/inventory.js" type="text/javascript"></script>'
            . '<script>'
            . 'Inventory.initKartuStok();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function datatable_saldo_stok() {
        $field = array(
            'search',
            'start',
            'length',
            'enddate',
            'filterproduk',
            'filterstok',
            'filtergudang'
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

        $enddate = $enddate ? $enddate : date('Y-m-d');

        $ed = date('Y-m-d', strtotime($enddate))." 23:59:59";

        $data = array();
        $where = "a.is_delete = '0'";
        $where_tdgproduct = "1=1";
        $where_ttrans = "x.tgl > '{$ed}'";

        $return['gudang'] = $this->session->userdata('cat_gudang_no');

        if( $this->session->userdata('cat_gudang_no') != "" ) {
            if( !$filtergudang ) {
                $this->db->select('gud_no');
                $this->db->where('cat_gud_no', $this->session->userdata('cat_gudang_no'));
                $this->db->where('is_delete', 0);
                $rs = $this->db->get('tgudang');
                if( $rs->num_rows() ) {
                    $gud = array();
                    foreach($rs->result_array() as $row) {
                        $gud[] = $row['gud_no'];
                    }
                    $gudang = implode('\',\'', $gud);
                    $where_tdgproduct .= " AND x.gud_no IN ('{$gudang}')";
                    $where_ttrans .= " AND x.gud_no IN ('{$gudang}')";
                }
            }
            else {
                $where_tdgproduct .= " AND x.gud_no = '{$filtergudang}'";
                $where_ttrans .= " AND x.gud_no = '{$filtergudang}'";
            }
        } if( $filtergudang ) {
            $where_tdgproduct .= " AND x.gud_no = '{$filtergudang}'";
            $where_ttrans .= " AND x.gud_no = '{$filtergudang}'";
        }

        if($filterproduk) {
            $where_tdgproduct .= " AND x.prod_no = '{$filterproduk}'";
            $where_ttrans .= " AND x.prod_no = '{$filterproduk}'";
        }

        if($search['value']) {
            $search = $this->db->escape_str($search['value']);
            $where .= " AND (a.prod_code0 like '%{$search}%' or  a.prod_name0 LIKE '%{$search}%')";
        }

        if( $filterstok > -1 ) {
            if($filterstok == 0) {
                $where .= " AND IFNULL(qtot, 0) - IFNULL(qtrx, 0) = 0";
            }
            else {
                $where .= " AND IFNULL(qtot, 0) - IFNULL(qtrx, 0) != 0";
            }
        }

        $sql = "SELECT 
            count(*) as total
        FROM tproduct a  
        LEFT JOIN (
            SELECT 
                x.prod_no, 
                sum(x.prod_on_hand) as qtot 
            FROM tdgproduct x             
            WHERE {$where_tdgproduct}
            GROUP BY x.prod_no) b ON a.prod_no = b.prod_no  
        LEFT JOIN (
            SELECT 
                x.prod_no,  
                sum(x.debet - x.kredit) as qtrx 
            FROM ttrans x             
            WHERE {$where_ttrans}  
            GROUP BY x.prod_no) c ON a.prod_no = c.prod_no  
        WHERE {$where}";

        $rs = $this->db->query($sql);

        $return['iTotalRecords'] = $rs->row()->total;
        $return['iTotalDisplayRecords'] = $return['iTotalRecords'];

        if( $return['iTotalRecords'] ) {
            $sql = "SELECT 
                a.prod_no, 
                a.prod_code0, 
                a.prod_name0,
                prod_uom,
                SUM(IFNULL(qtot, 0) - IFNULL(qtrx, 0)) AS qty
            FROM tproduct a  
            LEFT JOIN (
                SELECT 
                    x.prod_no, 
                    sum(x.prod_on_hand) as qtot 
                FROM tdgproduct x             
                WHERE {$where_tdgproduct}
                GROUP BY x.prod_no) b ON a.prod_no = b.prod_no  
            LEFT JOIN (
                SELECT 
                    x.prod_no,  
                    sum(x.debet - x.kredit) as qtrx 
                FROM ttrans x             
                WHERE {$where_ttrans}  
                GROUP BY x.prod_no) c ON a.prod_no = c.prod_no  
            WHERE {$where}
            GROUP BY a.prod_no, a.prod_code0, a.prod_name0, prod_uom  
            ORDER BY a.prod_code0
            LIMIT {$start}, {$length}";

            $rs = $this->db->query($sql);
            if( $rs->num_rows() ) {
                foreach($rs->result_array() as $row) {
                    $row['qty'] = number_format($row['qty'],2);
                    $return['aaData'][] = $row;
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_saldo_stok_global() {
        $field = array(
            'search',
            'start',
            'length',
            'enddate',
            'filterproduk',
            'filterstok',
            'filtergudang'
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

        $enddate = $enddate ? $enddate : date('Y-m-d');

        $ed = date('Y-m-d', strtotime($enddate))." 23:59:59";

        $data = array();
        $where = "a.is_delete = '0'";
        $where_tdgproduct = "1=1";
        $where_ttrans = "x.tgl > '{$ed}'";

        $return['gudang'] = $this->session->userdata('cat_gudang_no');

        if( $this->session->userdata('cat_gudang_no') != "" ) {
            if( !$filtergudang ) {
                $this->db->select('gud_no');
                $this->db->where('cat_gud_no', $this->session->userdata('cat_gudang_no'));
                $this->db->where('is_delete', 0);
                $rs = $this->db->get('tgudang');
                if( $rs->num_rows() ) {
                    $gud = array();
                    foreach($rs->result_array() as $row) {
                        $gud[] = $row['gud_no'];
                    }
                    $gudang = implode('\',\'', $gud);
                    $where_tdgproduct .= " AND x.gud_no IN ('{$gudang}')";
                    $where_ttrans .= " AND x.gud_no IN ('{$gudang}')";
                }
            }
            else {
                $where_tdgproduct .= " AND x.gud_no = '{$filtergudang}'";
                $where_ttrans .= " AND x.gud_no = '{$filtergudang}'";
            }
        } if( $filtergudang ) {
            $where_tdgproduct .= " AND x.gud_no = '{$filtergudang}'";
            $where_ttrans .= " AND x.gud_no = '{$filtergudang}'";
        }

        if($filterproduk) {
            $where_tdgproduct .= " AND x.prod_no = '{$filterproduk}'";
            $where_ttrans .= " AND x.prod_no = '{$filterproduk}'";
        }

        if($search['value']) {
            $search = $this->db->escape_str($search['value']);
            $where .= " AND (a.prod_code0 like '%{$search}%' or  a.prod_name0 LIKE '%{$search}%')";
        }

        if( $filterstok > -1 ) {
            if($filterstok == 0) {
                $where .= " AND IFNULL(qtot, 0) - IFNULL(qtrx, 0) = 0";
            }
            else {
                $where .= " AND IFNULL(qtot, 0) - IFNULL(qtrx, 0) != 0";
            }
        }

        $sql = "SELECT 
            count(*) as total
        FROM tproduct a  
        LEFT JOIN (
            SELECT  
                x.prod_no, 
                sum(x.prod_on_hand) as qtot 
            FROM tdgproduct x             
            WHERE {$where_tdgproduct}
            GROUP BY x.prod_no) b ON a.prod_no = b.prod_no  
        LEFT JOIN (
            SELECT 
                x.prod_no,  
                sum(x.debet - x.kredit) as qtrx 
            FROM ttrans x             
            WHERE {$where_ttrans}  
            GROUP BY x.prod_no) c ON a.prod_no = c.prod_no  
        WHERE {$where}";

        $rs = $this->db->query($sql);

        $return['iTotalRecords'] = $rs->row()->total;
        $return['iTotalDisplayRecords'] = $return['iTotalRecords'];

        if( $return['iTotalRecords'] ) {
            $sql = "SELECT 
                a.prod_no, 
                a.prod_code0, 
                a.prod_name0,
                prod_uom,
                SUM(IFNULL(qtot, 0) - IFNULL(qtrx, 0)) AS qty
            FROM tproduct a  
            LEFT JOIN (
                SELECT 
                    x.prod_no, 
                    sum(x.prod_on_hand) as qtot 
                FROM tdgproduct x             
                WHERE {$where_tdgproduct}
                GROUP BY x.prod_no) b ON a.prod_no = b.prod_no  
            LEFT JOIN (
                SELECT 
                    x.prod_no,  
                    sum(x.debet - x.kredit) as qtrx 
                FROM ttrans x             
                WHERE {$where_ttrans}  
                GROUP BY x.prod_no) c ON a.prod_no = c.prod_no  
            WHERE {$where}
            GROUP BY a.prod_no, a.prod_code0, a.prod_name0, prod_uom  
            ORDER BY a.prod_code0
            LIMIT {$start}, {$length}";

            $rs = $this->db->query($sql);
            if( $rs->num_rows() ) {
                foreach($rs->result_array() as $row) {
                    $row['qty'] = number_format($row['qty'],2);
    
                    $row['last_prod_rata_price'] = 0;
    
                    $this->db->select('last_prod_rata_price');
                    $this->db->where('tgl <=', $ed);
                    $this->db->where('prod_no', $row['prod_no']);
                    $this->db->order_by('tgl', 'DESC');
                    $rs = $this->db->get('ttrans_hpp', 1);
                    if( $rs->num_rows() ) {
                        $hpp = $rs->row()->last_prod_rata_price;
                        $row['last_prod_rata_price'] = number_format($hpp, 2);
                    }
    
                    $return['aaData'][] = $row;
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_kartu_stok() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filterproduk',
            'filtergudang'
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

        if( $start == 0 ) {
            $length = $length - 1;
        }
        else {
            $start = $start - 1;
        }

        if( $filterproduk ) {

            $sd = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $ed = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $cabang = $this->session->userdata('cat_gudang_no');

            $gud = array();
            if( !$filtergudang ) {
                $this->db->select('gud_no');
                $this->db->where('cat_gud_no', $cabang);
                $this->db->where('is_delete', 0);
                $rs = $this->db->get('tgudang');
                if( $rs->num_rows() ) {
                    foreach($rs->result_array() as $row) {
                        $gud[] = $row['gud_no'];
                    }
                }
            }

            /** SALDO AWAL */
            $saldo_awal = 0;
            if( $filtergudang ) {
                $this->db->where('gud_no', $filtergudang);
            }
            else {
                $this->db->where_in('gud_no', $gud);
            }
            $this->db->select('(prod_on_hand + prod_on_sell) as saldo_awal');
            $this->db->where('prod_no', $filterproduk);
            $rs = $this->db->get('tdgproduct');
            if( $rs->num_rows() ) {
                $saldo_awal = $rs->row()->saldo_awal;
            }
            /** SALDO AWAL: END */

            /** LAST TRANS */
            if( $filtergudang ) {
                $this->db->where('gud_no', $filtergudang);
            }
            else {
                $this->db->where_in('gud_no', $gud);
            }

            $this->db->select('sum(debet - kredit) as total');
            // $this->db->where('cab_no', $cabang);
            $this->db->where('tgl >=', $sd);
            $this->db->where('prod_no', $filterproduk);
            $rs = $this->db->get('ttrans');
            if($rs->num_rows()) {
                $saldo_awal -= $rs->row()->total;
            }
            /** LAST TRANS: END */

            $return['aaData'][] = array(
                'tgl' => '',
                'transaksi' => '<strong>Saldo Awal</strong>',
                'qty_in' => number_format(0, 2),
                'qty_out' => number_format(0, 2),
                'saldo' => number_format($saldo_awal,2)
            );

            /** TRANSAKSI TTRANS */
            if( $filtergudang ) {
                $this->db->where('a.gud_no', $filtergudang);
            }
            else {
                $this->db->where_in('a.gud_no', $gud);
            }

            $this->db->select("a.tgl, a.tran_type, a.prod_netto_price, a.debet, a.kredit, a.in_deT_no, a.out_det_no, b.out_no, c.in_no, bb.jual_no, cc.pur_no, IF(IFNULL(bb.person_no,'') != '', bb.person_no, cc.person_no) AS person_no, IF(IFNULL(bb.user_id,'') != '', bb.user_id, cc.user_id) AS user_id");
            // $this->db->where('a.cab_no', $cabang);
            $this->db->where('a.tgl >=', $sd);
            $this->db->where('a.tgl <=', $ed);
            $this->db->where('a.prod_no', $filterproduk);
            $this->db->join('tdetail_out b', 'a.out_det_no = b.out_det_no', 'left');
            $this->db->join('tout bb', 'b.out_no = bb.out_no', 'left');
            $this->db->join('tdetail_in c', 'a.in_det_no = c.in_det_no', 'left');
            $this->db->join('tin cc', 'c.in_no = cc.in_no', 'left');
            $this->db->order_by('a.tgl ASC');
            $rs = $this->db->get('ttrans a');

            // echo $this->db->last_query();
            // die();

            if($rs->num_rows()) {
                foreach($rs->result_array() as $row) {
                    
                    $transaksi = "";

                    switch($row['tran_type']) {
                        case 1:
                            $transaksi .= "[<em>Pembelian</em>]";
                            break;
                        case 2:
                            $transaksi .= "[<em>Retur Pembelian</em>]";
                            break;
                        case 3:
                            $transaksi .= "[<em>Penjualan</em>]";
                            break;
                        case 4:
                            $transaksi .= "[<em>Retur Penjualan</em>]";
                            break;
                        case 7:
                            $transaksi .= "[<em>Produksi</em>]";
                            break;
                        case 13:
                            $transaksi .= "[<em>Mutasi Stok</em>]";
                            break;
                        case 17:
                            $transaksi .= "[<em>Adjustment</em>]";
                            break;
                        case 31:
                        case 41:
                            $transaksi .= "[<em>Ganti Satuan</em>]";
                            break;
                        default:
                            $transaksi .= "[<em>Saldo Awal</em>]";
                            break;
                    }

                    if( $row['jual_no'] ) {
                        $transaksi .= " ".$row['jual_no'];
                    }
                    else if( $row['pur_no'] ){
                        $transaksi .= " ".$row['pur_no'];
                    }
                    else {
                        $transaksi .= " ".($row['in_no'] ? $row['in_no'] : $row['out_no']);
                    }

                    // $transaksi .= " ".($row['in_deT_no'] ? $row['in_deT_no'] : $row['out_det_no']);

                    if( $row['person_no'] ) {
                        $this->db->select('person_name');
                        $this->db->where('person_no', $row['person_no']);
                        $ps = $this->db->get('tperson');
                        if( $ps->num_rows() ) {
                            $transaksi .= " - ".$ps->row()->person_name;
                        }
                    }

                    if( $row['kredit'] < 0 ) {
                        $row['debet'] = $row['kredit'] * -1;
                        $row['kredit'] = 0;
                    }

                    if( $row['debet'] < 0 ) {
                        $row['kredit'] = $row['debet'] * -1;
                        $row['debet'] = 0;
                    }

                    $saldo_awal = $saldo_awal + ( $row['debet'] - $row['kredit'] );

                    $return['aaData'][] = array(
                        'tgl' => date('d-m-Y H:i:s', strtotime($row['tgl'])),
                        'transaksi' => $transaksi,
                        'qty_in' => number_format($row['debet'],2),
                        'qty_out' => number_format($row['kredit'],2),
                        'saldo' => number_format($saldo_awal,2)
                    );
                }
            }
            /** TRANSAKSI TTRANS: END */

        }
        else {
            $return['aaData'][] = array(
                'tgl' => '',
                'transaksi' => '<strong>Saldo Awal</strong>',
                'qty_in' => 0,
                'qty_out' => 0,
                'saldo' => 0
            );
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    public function datatable_kartu_stok_global() {
        $field = array(
            'search',
            'start',
            'length',
            'startdate',
            'enddate',
            'filterproduk',
            'filtergudang'
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

        if( $start == 0 ) {
            $length = $length - 1;
        }
        else {
            $start = $start - 1;
        }

        if( $filterproduk ) {

            $sd = date('Y-m-d', strtotime($startdate))." 00:00:00";
            $ed = date('Y-m-d', strtotime($enddate))." 23:59:59";
            $cabang = $this->session->userdata('cat_gudang_no');

            $gud = array();
            if( !$filtergudang ) {
                $this->db->select('gud_no');
                $this->db->where('cat_gud_no', $cabang);
                $this->db->where('is_delete', 0);
                $rs = $this->db->get('tgudang');
                if( $rs->num_rows() ) {
                    foreach($rs->result_array() as $row) {
                        $gud[] = $row['gud_no'];
                    }
                }
            }

            /** SALDO AWAL */
            $saldo_awal = 0;
            if( $filtergudang ) {
                $this->db->where('gud_no', $filtergudang);
            }

            $this->db->select('(prod_on_hand + prod_on_sell) as saldo_awal');
            $this->db->where('prod_no', $filterproduk);
            $rs = $this->db->get('tdgproduct');
            if( $rs->num_rows() ) {
                $saldo_awal = $rs->row()->saldo_awal;
            }
            /** SALDO AWAL: END */

            /** LAST TRANS */
            if( $filtergudang ) {
                $this->db->where('gud_no', $filtergudang);
            }


            $this->db->select('sum(debet - kredit) as total');
            // $this->db->where('cab_no', $cabang);
            $this->db->where('tgl >=', $sd);
            $this->db->where('prod_no', $filterproduk);
            $rs = $this->db->get('ttrans');
            if($rs->num_rows()) {
                $saldo_awal -= $rs->row()->total;
            }
            /** LAST TRANS: END */

            $return['aaData'][] = array(
                'tgl' => '',
                'transaksi' => '<strong>Saldo Awal</strong>',
                'prod_netto_price' => number_format(0, 2),
                'qty_in' => number_format(0, 2),
                'qty_out' => number_format(0, 2),
                'saldo' => number_format($saldo_awal,2),
                'total' => number_format(0, 2),
                'hpp' => number_format(0, 2),
                'total_saldo' => number_format(0, 2),
                'harga_jual' => number_format(0, 2),
                'total_lr' => number_format(0, 2)
            );

            /** TRANSAKSI TTRANS */
            if( $filtergudang ) {
                $this->db->where('a.gud_no', $filtergudang);
            }

            $this->db->select("a.tgl, 
                a.tran_type, 
                a.prod_netto_price,  
                a.debet, 
                a.kredit,  
                a.in_det_no, 
                a.out_det_no,
                IFNULL(last_prod_rata_price, 0) as last_prod_rata_price,
                b.out_no,
                c.in_no, 
                bb.jual_no, 
                cc.pur_no, 
                IF(IFNULL(bb.person_no,'') != '', bb.person_no, cc.person_no) AS person_no, 
                IF(IFNULL(bb.user_id,'') != '', bb.user_id, cc.user_id) AS user_id,
                IFNULL(d.harga_satuan, 0) AS harga_jual");
            // $this->db->where('a.cab_no', $cabang);
            $this->db->where('a.tran_type <>', 13);
            $this->db->where('a.tgl >=', $sd);
            $this->db->where('a.tgl <=', $ed);
            $this->db->where('a.prod_no', $filterproduk);
            $this->db->join('tdetail_out b', 'a.out_det_no = b.out_det_no', 'left');
            $this->db->join('tout bb', 'b.out_no = bb.out_no', 'left');
            $this->db->join('tdetail_in c', 'a.in_det_no = c.in_det_no', 'left');
            $this->db->join('tin cc', 'c.in_no = cc.in_no', 'left');
            $this->db->join('td_sales d', 'a.out_det_no = d.out_det_no', 'left');
            $this->db->order_by('a.tgl ASC');
            $rs = $this->db->get('ttrans_hpp a');

            // echo $this->db->last_query();
            // die();

            if($rs->num_rows()) {
                foreach($rs->result_array() as $row) {

                    $transaksi = "";

                    switch($row['tran_type']) {
                        case 1:
                            $transaksi .= "[<em>Pembelian</em>]";
                            break;
                        case 2:
                            $transaksi .= "[<em>Retur Pembelian</em>]";
                            break;
                        case 3:
                            $transaksi .= "[<em>Penjualan</em>]";
                            break;
                        case 4:
                            $transaksi .= "[<em>Retur Penjualan</em>]";
                            break;
                        case 7:
                            $transaksi .= "[<em>Produksi</em>]";
                            break;
                        case 13:
                            $transaksi .= "[<em>Mutasi Stok</em>]";
                            break;
                        case 17:
                            $transaksi .= "[<em>Adjustment</em>]";
                            break;
                        case 31:
                        case 41:
                            $transaksi .= "[<em>Ganti Satuan</em>]";
                            break;
                        default:
                            $transaksi .= "[<em>Saldo Awal</em>]";
                            break;
                    }

                    if( $row['jual_no'] ) {
                        $transaksi .= " ".$row['jual_no'];
                    }
                    else if( $row['pur_no'] ){
                        $transaksi .= " ".$row['pur_no'];
                    }
                    else {
                        $transaksi .= " ".($row['in_no'] ? $row['in_no'] : $row['out_no']);
                    }

                    if( $row['person_no'] ) {
                        $this->db->select('person_name');
                        $this->db->where('person_no', $row['person_no']);
                        $ps = $this->db->get('tperson');
                        if( $ps->num_rows() ) {
                            $transaksi .= " - ".$ps->row()->person_name;
                        }
                    }

                    if( $row['kredit'] < 0 ) {
                        $row['debet'] = $row['kredit'] * -1;
                        $row['kredit'] = 0;
                    }

                    if( $row['debet'] < 0 ) {
                        $row['kredit'] = $row['debet'] * -1;
                        $row['debet'] = 0;
                    }

                    $total = abs( $row['debet'] - $row['kredit'] ) * $row['prod_netto_price'];

                    $saldo_awal = $saldo_awal + ( $row['debet'] - $row['kredit'] );

                    $total_saldo = abs( $row['debet'] - $row['kredit'] ) * $row['last_prod_rata_price'];

                    $total_lr = (abs( $row['debet'] - $row['kredit'] ) * $row['harga_jual']) - $total;
                    $total_lr = ( $row['harga_jual'] > 0 ) ? $total_lr : 0;

                    $return['aaData'][] = array(
                        'tgl' => date('d-m-Y H:i:s', strtotime($row['tgl'])),
                        'transaksi' => $transaksi,
                        'prod_netto_price' => $row['prod_netto_price'],
                        'qty_in' => number_format($row['debet'],2),
                        'qty_out' => number_format($row['kredit'],2),
                        'saldo' => number_format($saldo_awal,2),
                        'total' => number_format($total,2),
                        'hpp' => number_format($row['last_prod_rata_price'],2),
                        'total_saldo' => number_format($total_saldo,2),
                        'harga_jual' => number_format($row['harga_jual'],2),
                        'total_lr' => number_format($total_lr,2)
                    );
                }
            }
            /** TRANSAKSI TTRANS: END */

        }
        else {
            $return['aaData'][] = array(
                'tgl' => '',
                'transaksi' => '<strong>Saldo Awal</strong>',
                'prod_netto_price' => 0,
                'qty_in' => 0,
                'qty_out' => 0,
                'saldo' => 0,
                'total' => 0,
                'hpp' => 0,
                'total_saldo' => 0,
                'harga_jual' => 0,
                'total_lr' => 0
            );
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }
    
}