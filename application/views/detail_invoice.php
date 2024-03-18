<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 11:01 AM
 */
?>

<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="pull-right no-print">
            <button class="btn btn-danger btn-kembali"><i class="fa fa-times"></i> Kembali</button>
        </div>
        <div class="clearfix no-print" style="margin-bottom:20px;"></div>
        <form class="m-form m-form--fit m--margin-bottom-20">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Nama Supplier</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['person_name']) ? $detail_invoice['person_name'] : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">No. Invoice</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_inv']) ? $detail_invoice['pur_inv'] : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Tgl. Invoice</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_inv_date']) ? date('d-m-Y H:i:s', strtotime($detail_invoice['pur_inv_date'])) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">No. Faktur Pajak</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['no_faktur_pajak']) && $detail_invoice['is_fp'] == 1 ? $detail_invoice['no_faktur_pajak'] : "-"; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">No. Transaksi</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_no']) ? $detail_invoice['pur_no'] : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Tgl. Transaksi</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_date']) ? date('d-m-Y H:i:s', strtotime($detail_invoice['pur_date'])) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Jatuh Tempo</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_due_date']) ? date('d-m-Y H:i:s', strtotime($detail_invoice['pur_due_date'])) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Keterangan</label>
                        <div class="col-9">
                            <p>: <?php echo isset($detail_invoice['pur_ket']) ? $detail_invoice['pur_ket'] : "-"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <h5 style="margin-top:20px;">Detail Transaksi</h5>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Subtotal</label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['pur_sub_total']) && $detail_invoice['pur_sub_total'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['pur_sub_total']),2) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Discount</label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['pur_pot_rp']) && $detail_invoice['pur_pot_rp'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['pur_pot_rp']),2) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">PPN <?php echo isset($detail_invoice['pur_ppn_rp']) ? $detail_invoice['ppn_name']." ".round($detail_invoice['pur_ppn_persen'],2)."%" : ""; ?></label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['pur_ppn_rp'])  && $detail_invoice['pur_ppn_rp'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['pur_ppn_rp']),2) : "-"; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Grand Total</label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['pur_total']) && $detail_invoice['pur_total'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['pur_total']),2) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Total Bayar</label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['total_bayar']) && $detail_invoice['total_bayar'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['total_bayar']),2) : "-"; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-form__group form__group-fit row">
                        <label for="example-text-input" class="col-3 col-form-label">Sisa Hutang</label>
                        <div class="col-9">
                            <p>: <?php echo ( isset($detail_invoice['sisa_bayar']) && $detail_invoice['sisa_bayar'] > 0 ) ? "Rp. ".number_format(round($detail_invoice['sisa_bayar']),2) : "-"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <h5 style="margin-top:20px;">List Pembayaran</h5>
            <div class="table-responsive">
                <table class="table table-striped- table-bordered table-hover tbl--fh" id="tbl-list">
                    <thead>
                        <tr>
                            <th style="width:20%">No. Pembayaran</th>
                            <th style="width:15%">Tanggal</th>
                            <th class="text-right" style="width:15%">Total Retur</th>
                            <th class="text-right" style="width:15%">Total Bayar</th>
                            <th>Keterangan</th>
                            <th style="width:5%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if( count($detail_payment) ) {
                                foreach($detail_payment as $row) {
                        ?>
                                <tr>
                                    <td><?php echo $row['pay_no']; ?></td>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($row['pay_date'])); ?></td>
                                    <td class="text-right"><?php echo number_format(abs($row['total_retur']),2); ?></td>
                                    <td class="text-right"><?php echo number_format($row['bayar'],2); ?></td>
                                    <td><?php echo $row['pay_ket']; ?></td>
                                    <td><a href="javascript:;" data-payno="<?php echo $row['pay_no']; ?>" class="btn m-btn--icon m-btn--icon-only m-btn--pill btn-outline-info btn-sm btn-small-nota"><i class="fa fa-eye"></i></a></td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
        <div class="pull-right no-print">
            <button class="btn btn-danger btn-kembali"><i class="fa fa-times"></i> Kembali</button>
        </div>
        <div class="clearfix no-print"></div>
    </div>
</div>

