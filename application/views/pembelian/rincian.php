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
                        Customer
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
            </div>
            <div class="m--margin-bottom-20 clearfix">
                <div class="pull-right">
                    <button class="btn btn-primary btn-generate-data"><i class="la la-search"></i> Generate</button>
                </div>
            </div>
        </form>
        <table class="table table-striped- table-bordered table-hover tbl--fh" id="tbl-list">
            <thead>
                <tr>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Qty</th>
                    <th rowspan="2">Unit</th>
                    <th rowspan="2">Harga Beli</th>
                    <th colspan="2" class="text-center">Disc 1</th>
                    <th colspan="2" class="text-center">Disc 2</th>
                    <th colspan="2" class="text-center">Disc 3</th>
                    <th rowspan="2">Subtotal</th>
                    <th colspan="2" class="text-center">Ppn</th>
                    <th rowspan="2">Harga Nett</th>
                    <th rowspan="2">Group</th>
                </tr>
                <tr>
                    <th>%</th>
                    <th>Rp</th>
                    <th>%</th>
                    <th>Rp</th>
                    <th>%</th>
                    <th>Rp</th>
                    <th>Type</th>
                    <th class="border-right-width-1">Rp</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="16">No data available in table</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th class="text-right" colspan="5">TOTAL</th>
                <th class="text-right" colspan="2">0</th>
                <th class="text-right" colspan="2">0</th>
                <th class="text-right" colspan="2">0</th>
                <th class="text-right">0</th>
                <th class="text-right">&nbsp;</th>
                <th class="text-right">0</th>
                <th class="text-right">0</th>
                <th class="text-right">&nbsp;</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
