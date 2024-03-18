<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 11:08 AM
 */
?>
<div class="m-portlet">
    <div class="m-portlet__body">
        <form class="m-form m-form--fit m--margin-bottom-20">
            <div class="row m--margin-bottom-20">
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Sampai Dengan
                    </label>
                    <div class="input-group date">
                        <input type="text" class="form-control m-input tgl_datepicker" data-date-format="dd-mm-yyyy" readonly id="enddate" name="enddate" value="<?php echo date('d-m-Y'); ?>"/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Gudang
                    </label>
                    <select class="form-control m-input" data-col-index="3" name="filtergudang" id="filtergudang">
                    </select>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Produk
                    </label>
                    <select class="form-control m-input" data-col-index="3" name="filterproduk" id="filterproduk">
                    </select>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Jumlah Stok
                    </label>
                    <select class="form-control m-input default-select2" data-col-index="3" name="filterstok" id="filterstok">
                        <option value="-1">Semua</option>
                        <option value="0">= 0</option>
                        <option value="1"><> 0</option>
                    </select>
                </div>
            </div>
            <div class="m--margin-bottom-20 clearfix">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary ladda-button btn-generate-data" data-style="expand-right"><i class="la la-search"></i> Generate</button>
                </div>
            </div>
        </form>
        <table class="table table-striped- table-bordered table-hover tbl--fh" id="tbl-list">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4">No data available in table</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th class="text-right" colspan="2">TOTAL</th>
                <th class="text-right">0</th>
                <th class="text-right">&nbsp;</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
