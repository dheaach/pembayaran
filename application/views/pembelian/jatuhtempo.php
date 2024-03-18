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
                        Supplier
                    </label>
                    <select class="form-control m-input" data-col-index="3" name="filtercustomer" id="filtercustomer">
                    </select>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Jenis
                    </label>
                    <select class="form-control m-input" data-col-index="4" name="filterjenis" id="filterjenis">
                        <option value="-1" selected>Semua</option>
                        <option value="1">Pembelian</option>
                        <option value="2">Retur Pembelian</option>
                    </select>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        Jatuh Tempo
                    </label>
                    <select class="form-control m-input" data-col-index="5" name="filtertop" id="filtertop">
                    </select>
                </div>
            </div>
            <div class="m--margin-bottom-20 clearfix">
                <div class="pull-right">
                    <button class="btn btn-primary ladda-button btn-generate-data" data-style="expand-right"><i class="la la-search"></i> Generate</button>
                </div>
            </div>
        </form>
        <table class="table table-striped- table-bordered table-hover tbl--fh" id="tbl-list">
            <thead>
                <tr>
                    <th class="all">Tanggal</th>
                    <th class="all">No. Faktur</th>
                    <th class="all">TOP</th>
                    <th class="desktop">Total</th>
                    <th class="all">Tgl Jatuh Tempo</th>
                    <th class="all">Saldo Piutang</th>
                    <th class="desktop">Pelanggan</th>
                    <th class="desktop">Alamat</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="8">No data available in table</td>
            </tr>
            </tbody>
            <!--<tfoot>
            <tr>
                <th class="text-right" colspan="3">TOTAL</th>
                <th class="text-right desktop">0</th>
                <th class="text-right all">0</th>
                <th class="text-right desktop" colspan="3">&nbsp;</th>
            </tr>
            </tfoot>-->
        </table>
    </div>
</div>
