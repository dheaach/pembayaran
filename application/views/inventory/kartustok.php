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
                <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Periode
                    </label>
                    <div class="input-daterange input-group tgl_datepicker" id="periode" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control m-input" name="startdate" id="startdate" placeholder="From" data-col-index="1" value="<?php echo date('01-m-Y'); ?>"/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-ellipsis-h"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control m-input" name="enddate" id="enddate" placeholder="To" data-col-index="2" value="<?php echo date('d-m-Y'); ?>"/>
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
            </div>
            <div class="row m--margin-bottom-20">
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
        <table class="table table-striped- table-bordered table-hover tbl--fh" id="tbl-list-global">
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>Transaksi</th>
                    <th>Harga</th>
                    <th>Qty In</th>
                    <th>Qty Out</th>
                    <th>Total</th>
                    <th>Saldo</th>
                    <th>HPP</th>
                    <th>Total Saldo</th>
                    <th>Harga Jual</th>
                    <th>Laba/Rugi</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="11">No data available in table</td>
            </tr>
            </tbody>
            <!--<tfoot>
            <tr>
                <th class="text-right" colspan="2">TOTAL</th>
                <th class="text-right">0</th>
                <th class="text-right">0</th>
                <th class="text-right" colspan="5">&nbsp</th>
                <th class="text-right">0</th>
                <th class="text-right">0</th>
            </tr>
            </tfoot>-->
        </table>
    </div>
</div>
