<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 2/17/2019
 * Time: 11:12 AM
 */

class Akuntansi extends IO_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        show_error('Halaman tidak ditemukan silakan kembali ke dashboard', 404, '404 - Page Not Found');
    }

    public function neraca()
    {
        $this->data['title'] = 'Laporan Neraca';
        $this->data['content'] = "akuntansi/neraca";
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/akuntansi.js" type="text/javascript"></script>'
            . '<script>'
            . 'Akuntansi.initNeraca();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function bukubesar()
    {
        $this->data['title'] = 'Laporan Buku Besar';
        $this->data['content'] = "akuntansi/bukubesar";
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/akuntansi.js" type="text/javascript"></script>'
            . '<script>'
            . 'Akuntansi.initBukuBesar();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function labarugi()
    {
        $this->data['title'] = 'Laporan Laba Rugi';
        $this->data['content'] = "akuntansi/labarugi";
        $this->data['additional_js'] = '<script src="'.base_url().'assets/vendors/custom/jquery.priceformat.min.js" type="text/javascript"></script>'
            . '<script src="'.base_url().'assets/app/js/akuntansi.js" type="text/javascript"></script>'
            . '<script>'
            . 'Akuntansi.initLabaRugi();'
            . '</script>';

        $this->load->view('template', $this->data);
    }

    public function query_neraca() {

        $return = array('success' => false);

        if( $startdate = $this->input->get_post('startdate') ) {
            $def_laba_bulan_no = "000145";
            $def_laba_tahun_no = "00075";

            /** ambil semua rekening untuk neraca */
            $sql = "SELECT
                    rek_kode as kode,
                    rek_nama,
                    rek_type,
                    if(rek_gol=1,1,2) as posisi,
                    rek_gol,
                    rek_no,
                    rek_kode
                FROM trek
                WHERE is_delete = 0 AND rek_gol <=3
                ORDER BY rek_kode";
            $rs = $this->db->query($sql);

//            $today = date('Y-m', strtotime($startdate));
            $this_month = date('Y-m', strtotime($startdate));
            $next_month = date('Y-m', strtotime($startdate." +1 month"));
            $data = array();

            $rek_type = 0;
            $rek_gol = 0;
            $total_saldo = 0;
            $last_name = "";

            if( $rs->num_rows() ) {
                foreach ($rs->result_array() as $k => $row) {
                    $row['saldo'] = 0;
                    $row['debet'] = 0;
                    $row['kredit'] = 0;

                    if( $row['rek_type'] == 1 ) {
                        $row['rek_nama'] = strtoupper($row['rek_nama']);
                    }

                    if( $row['rek_type'] == 3 ) {
                        if( $row['rek_no'] == $def_laba_bulan_no || $row['rek_no'] == $def_laba_tahun_no  ) {

                            if( $row['rek_no'] == $def_laba_bulan_no ) {
                                if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                    $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
                                }
                                $this->db->select("IFNULL(sum(a.debet),0) as jdebet, IFNULL(sum(a.kredit),0) as jkredit");
                                $this->db->join('tjurnal b', 'a.jur_no = b.jur_no', 'left');
                                $this->db->join('trek c', 'a.rek_no = c.rek_no', 'left');
                                $this->db->where('b.is_batal', 0);
                                $this->db->where('c.rek_gol >', 3);
                                $this->db->where('c.rek_type', 3);
                                $this->db->where("DATE_FORMAT(b.jur_tgl, '%Y-%m') =", $this_month);
                                $rs3 = $this->db->get('tdjurnal a');
                                if( $rs3->num_rows() ) {
                                    $row['debet'] = $rs3->row()->jdebet;
                                    $row['kredit'] = $rs3->row()->jkredit;
                                }
                                $row['saldo'] = $row['kredit'] - $row['debet'];
                            }
                            else {
                                if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                    $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
                                }
                                $this->db->select("IFNULL(SUM(kredit - debet),0) as kredit");
                                $this->db->join('tjurnal b', 'a.jur_no = b.jur_no', 'left');
                                $this->db->join('trek c', 'a.rek_no = c.rek_no', 'left');
                                $this->db->where('b.is_batal', 0);
                                $this->db->where('c.rek_gol >', 3);
                                $this->db->where('c.rek_type', 3);
                                $this->db->where("b.jur_tgl >=", $this_month."-01 00:00:00");
                                $rs3 = $this->db->get('tdjurnal a');
                                if( $rs3->num_rows() ) {
                                    $row['kredit'] = $rs3->row()->kredit;
                                }

                                if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                    $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
                                }
                                $this->db->select("IFNULL((sum(debet) - sum(kredit)) * -1, 0) as saldo");
                                $this->db->join('tjurnal b', 'a.jur_no = b.jur_no', 'left');
                                $this->db->join('trek c', 'a.rek_no = c.rek_no', 'left');
                                $this->db->where('b.is_batal', 0);
                                $this->db->where('c.rek_gol >', 3);
                                $this->db->where('c.rek_type', 3);
                                $rs3 = $this->db->get('tdjurnal a');
                                if( $rs3->num_rows() ) {
                                    $row['saldo'] = $rs3->row()->saldo;
                                }

                                if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                    $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
                                }
                                $this->db->select("IFNULL((sum(debet) - sum(kredit)) * -1, 0) as saldo");
                                $this->db->join('tjurnal b', 'a.jur_no = b.jur_no', 'left');
                                $this->db->join('trek c', 'a.rek_no = c.rek_no', 'left');
                                $this->db->where('b.is_batal', 0);
                                $this->db->where('c.rek_no', $def_laba_tahun_no);
                                $rs3 = $this->db->get('tdjurnal a');
                                if( $rs3->num_rows() ) {
                                    $row['saldo'] += $rs3->row()->saldo;
                                }

                                $row['saldo'] -= $row['kredit'];
                            }

                        }
                        else {
                            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                $this->db->where('b.cab_no', $this->session->userdata('cat_gudang_no'));
                            }

                            $this->db->select_sum('IFNULL(a.debet,0)', 'debet');
                            $this->db->select_sum('IFNULL(a.kredit,0)', 'kredit');
                            $this->db->where('b.is_batal', 0);
                            $this->db->where('a.rek_no', $row['rek_no']);
                            $this->db->where('c.rek_type', 3);
                            $this->db->where('b.jur_tgl >', $next_month."-01 00:00:00");
                            $this->db->join('tjurnal b', 'a.jur_no = b.jur_no', 'left');
                            $this->db->join('trek c', 'a.rek_no = c.rek_no', 'left');
                            $rs1 = $this->db->get('tdjurnal a');

                            if( $rs1->num_rows() ) {
                                $row['debet'] = ( !empty($rs1->row()->debet) ) ? $rs1->row()->debet : 0;
                                $row['kredit'] = ( !empty($rs1->row()->kredit) ) ? $rs1->row()->kredit : 0;
                            }

                            if( $this->session->userdata('cat_gudang_no') != "all" ) {
                                $this->db->where('c.cab_no', $this->session->userdata('cat_gudang_no'));
                            }
                            $this->db->select("(sum(a.debet) - sum(a.kredit)) as saldo");
                            $this->db->join('trek b', 'a.rek_no = b.rek_no', 'left');
                            $this->db->join('tjurnal c', 'a.jur_no = c.jur_no', 'left');
                            $this->db->where('c.is_batal', 0);
                            $this->db->where('a.rek_no', $row['rek_no']);
                            $rs2 = $this->db->get('tdjurnal a');
                            if( $rs2->num_rows() ) {
                                $row['saldo'] = $rs2->row()->saldo;
                            }

                            if( $row['rek_gol'] == 1 ) {
                                $row['saldo'] = $row['saldo'] - ($row['debet'] - $row['kredit']);
                            }
                            else {
                                $row['saldo'] = ($row['saldo'] * -1) - ($row['kredit'] - $row['debet']);
                            }
                        }
                    }

                    $saldo = $row['saldo'];
                    $total_saldo += $saldo;

                    $row['saldo'] = number_format($row['saldo'], 2);
                    $rek_type = $row['rek_type'];


                    if( $rek_type == 1 ) {
                        if( $k > 0 ) {
                            $data[] = array(
                                'kode' => '',
                                'rek_nama' => 'TOTAL '.$last_name,
                                'rek_type' => '',
                                'posisi' => '',
                                'rek_gol' => '',
                                'rek_no' => '',
                                'rek_kode' => '',
                                'saldo' => number_format($total_saldo, 2),
                                'debet' => 0,
                                'kredit' => 0
                            );
                            $total_saldo = 0;
                        }

                        $last_name = $row['rek_nama'];
                        $rek_gol = $row['rek_gol'];
                    }

                    $data[] = $row;

                }

                $data[] = array(
                    'kode' => '',
                    'rek_nama' => 'TOTAL '. ( strpos(strtolower($last_name), 'modal') !== false ? "MODAL & LABA" : $last_name),
                    'rek_type' => '',
                    'posisi' => '',
                    'rek_gol' => '',
                    'rek_no' => '',
                    'rek_kode' => '',
                    'saldo' => number_format($total_saldo, 2),
                    'debet' => 0,
                    'kredit' => 0
                );
            }

            if( count($data) > 0 ) {
                $return['success'] = true;
                foreach ($data as $row) {
                    if( $row['rek_type'] < 3 && $row['rek_kode'] != "" ) {
                        $row['saldo'] = "";
                    }
                    $return['rows'][] = $row;
                }

            }
        }

        header('Content-Type:application/json');
        echo json_encode($return);
    }
}