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
                        Mulai Dari
                    </label>
                    <div class="input-group date">
                        <input type="text" class="form-control m-input tgl_datepicker" data-date-format="yyyy-mm" readonly id="startdate" name="startdate" value="<?php echo date('Y-m'); ?>"/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                    <label>
                        &nbsp;
                    </label>
                    <div class="input-group date">
                        <button type="button" class="btn btn-primary ladda-button btn-generate-data" data-style="expand-right"><i class="la la-search"></i> Generate</button>
                    </div>
                </div>
            </div>
        </form>
        <section id="neraca-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 style="font-size: 25px; font-weight: bold;">LAPORAN NERACA</h1>
                        <h2 style="font-size: 20px;">SUKSES JAYA</h2>
                        <h3 style="font-size: 16px;">Food Service dan Household</h3>
                        <h4 style="font-size: 14px;">Jl. Madura No. 5</h4>
                        <p class="blnthn" style="">&nbsp;</p>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="neraca-wrapper"></div>
        </section>
    </div>
</div>
