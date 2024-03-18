<?php
/**
 * Created by PhpStorm.
 * User: captjinx
 * Date: 1/30/2019
 * Time: 11:01 AM
 */
?>
<div class="m-portlet">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-xl-8">

                <!--begin:: Widgets/Daily Sales-->
                <div class="m-widget14">
                    <div class="m-widget14__header m--margin-bottom-30">
                        <h3 class="m-widget14__title"> Grafik Transaksi Penjualan </h3>
                        <!-- <span class="m-widget14__desc"> Check out each collumn for more details </span> -->
                    </div>
                    <div class="m-widget14__chart" style="height:120px;">
                        <canvas id="m_chart_daily_sales"></canvas>
                    </div>
                </div>

                <!--end:: Widgets/Daily Sales-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Support Stats-->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Transaksi Penjualan</h3>
                                <!-- <span class="m-widget1__desc">&nbsp;</span> -->
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-info"><span class="txt-transaksi-penjualan">0</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Omset Penjualan</h3>
                                <!-- <span class="m-widget1__desc">Yearly Expenses</span> -->
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-info">Rp. <span class="txt-total-omset">0</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Avg Penjualan</h3>
                                <!-- <span class="m-widget1__desc">Regional Logistics</span> -->
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-info">Rp. <span class="txt-avg-penjualan">0</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Support Stats-->
            </div>
        </div>
    </div>
</div>


