<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 11:01 AM
 */
?>

<div class="m-portlet">
    <div class="m-portlet__body print-area">
        <div class="pull-right no-print">
            <button class="btn btn-danger btn-kembali"><i class="fa fa-times"></i> Kembali</button>
            <button class="btn btn-primary btn-print"><i class="fa fa-print"></i> Print</button>
        </div>
        <div class="clearfix no-print" style="margin-bottom:20px;"></div>
        <div class="row" style="margin-bottom:20px;">
            <div class="col-4" style="text-align:center;">
                <img alt="" src="<?php echo site_url(); ?>/assets/app/media/img/logos/logo-green.png" height="100">
            </div>
            <div class="col-8">
                <form class="m-form" id="frm-transaksi">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group form__group-fit row">
                                <label for="example-text-input" class="col-4 col-form-label"><strong>NAMA</strong></label>
                                <div class="col-8">
                                    <p>: <?php echo isset($detail_invoice['person_name']) ? $detail_invoice['person_name'] : ""?></p>
                                </div>
                            </div>
                            <div class="form-group m-form__group form__group-fit row">
                                <label for="example-text-input" class="col-4 col-form-label"><strong>ALAMAT</strong></label>
                                <div class="col-8">
                                    <p>: <?php echo isset($detail_invoice['person_alamat']) ? $detail_invoice['person_alamat'] : ""?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group m-form__group form__group-fit row">
                                <label for="example-text-input" class="col-4 col-form-label"><strong>NO. BAYAR</strong></label>
                                <div class="col-8">
                                    <p>: <?php echo isset($detail_invoice['pay_no']) ? $detail_invoice['pay_no'] : ""?></p>
                                </div>
                            </div>
                            <div class="form-group m-form__group form__group-fit row">
                                <label for="example-text-input" class="col-4 col-form-label"><strong>TGL. BAYAR</strong></label>
                                <div class="col-8">
                                    <p>: <?php echo isset($detail_invoice['pay_date']) ? date('d-m-Y H:i:s', strtotime($detail_invoice['pay_date'])) : ""?></p>
                                </div>
                            </div>
                            <div class="form-group m-form__group form__group-fit row">
                                <label for="example-text-input" class="col-4 col-form-label"><strong>NO. VOUCHER</strong></label>
                                <div class="col-8">
                                    <p>: <?php echo isset($detail_invoice['pay_voucher']) ? $detail_invoice['pay_voucher'] : ""?></p>
                                </div>
                            </div>
                        </div>            
                    </div>
                </form>
            </div>
        </div>
        <h4><strong>NOTA PEMBAYARAN HUTANG</strong></h4>
        <div class="table-responsive">
            <table class="table table-striped- table-bordered table-hover tbl--fh tbl-border-black" id="tbl-list">
                <thead>
                    <tr>
                        <th class="text-right" style="width:5%;">No.</th>
                        <th>No. Faktur</th>
                        <th>Tgl. Faktur</th>
                        <th class="text-right">Saldo</th>
                        <th class="text-right">Retur</th>
                        <th class="text-right">Dibayar</th>
                        <th class="text-right">Sisa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $dibayar = 0;
                        $retur = 0;
                        $sisa = 0;
                        if( count($detail_payment) ) {
                            foreach($detail_payment as $k => $row) {
                                $sisa_saldo = ($row['saldo_awal'] + $row['total_retur']) - $row['total_bayar'];
                                // $sisa_saldo = $row['saldo_awal'] - $row['total_bayar'];
                    ?>
                            <tr>
                                <td class="text-right"><?php echo ($k + 1); ?></td>
                                <td><?php echo $row['in_no']; ?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($row['pur_date'])); ?></td>
                                <td class="text-right"><?php echo number_format($row['saldo_awal'], 2); ?></td>
                                <td class="text-right"><?php echo number_format(abs($row['total_retur']),2); ?></td>
                                <td class="text-right"><?php echo number_format($row['total_bayar'], 2); ?></td>
                                <td class="text-right"><?php echo number_format(round($sisa_saldo, 2), 2); ?></td>
                            </tr>
                    <?php
                                $dibayar += $row['total_bayar'];
                                $retur += $row['total_retur'];
                                $sisa += $sisa_saldo;
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">SUBTOTAL</th>
                        <!-- <th class="text-right"><?php echo number_format($retur, 2); ?></th> -->
                        <th class="text-right"><?php echo number_format($dibayar, 2); ?></th>
                        <th class="text-right"><?php echo number_format($sisa, 2); ?></th>
                    </tr>
                </tfoot>
            </table>

            <table class="table table-striped- table-hover tbl-border-black" id="tbl-list">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Account</th>
                        <th>No. Bayar</th>
                        <th>Tgl. Terbit</th>
                        <th>Term</th>
                        <th>Bank</th>
                        <th class="text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total_bayar = 0;
                        if( count($detail_checkout) > 0 ) {
                            foreach( $detail_checkout as $row ) {
                    ?>
                    <tr>
                        <td><?php echo $row['jenis_transaksi']; ?></td>
                        <td><?php echo $row['rek_nama']; ?></td>
                        <td><?php echo $row['nobg']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['tgl_terbit'])); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['due_date'])); ?></td>
                        <td><?php echo $row['bank']; ?></td>
                        <td class="text-right"><?php echo number_format($row['nominal'], 2); ?></td>
                    </tr>
                    <?php
                            $total_bayar += $row['nominal'];
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-right"><strong>TOTAL</strong></th>
                        <th class="text-right"><strong><?php echo number_format($total_bayar, 2); ?></strong></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-note"><small><em>Note: <?php echo $detail_invoice['pay_ket']; ?></em></small></div>
        <div class="pull-right no-print">
            <button class="btn btn-danger btn-kembali"><i class="fa fa-times"></i> Kembali</button>
            <button class="btn btn-primary btn-print"><i class="fa fa-print"></i> Print</button>
        </div>
        <div class="clearfix no-print"></div>
    </div>
</div>

