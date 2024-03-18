<?php if( $this->session->userdata('login_role') != "supplier" ) : ?>
<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
    <li class="m-menu__item " aria-haspopup="true">
        <a href="<?php echo site_url(); ?>" class="m-menu__link ">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Dashboard</span>
        </a>
    </li>
    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
        <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Penjualan</span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                        <i class="m-menu__link-icon fa fa-luggage-cart"></i>
                        <span class="m-menu__link-text">Laporan Penjualan</span>
                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                        <span class="m-menu__arrow "></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('penjualan/rangkuman')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rangkuman</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('penjualan/rangkumancustomer')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rangkuman Customer</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('penjualan/rincian')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rincian</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('penjualan/subitem')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Sub Item</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('penjualan')."/kartupiutang"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Kartu Piutang</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('penjualan')."/saldopiutang"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Saldo Piutang</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('penjualan')."/jatuhtempo"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Piutang Jatuh Tempo</span>
                    </a>
                </li>
                <li class="m-menu__item  m-menu__item--submenu hidden" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                        <i class="m-menu__link-icon fa fa-shekel-sign"></i>
                        <span class="m-menu__link-text">Laba/Rugi</span>
                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                        <span class="m-menu__arrow "></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link ">
                                    <span class="m-menu__link-text">L/R Penjualan</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link ">
                                    <span class="m-menu__link-text">L/R per Barang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>
    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
        <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Pembelian</span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                        <i class="m-menu__link-icon fa fa-luggage-cart"></i>
                        <span class="m-menu__link-text">Laporan Pembelian</span>
                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                        <span class="m-menu__arrow "></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('pembelian/rangkuman')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rangkuman</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('pembelian/rangkumansupplier')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rangkuman Supplier</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="<?php echo site_url('pembelian/rincian')?>" class="m-menu__link ">
                                    <span class="m-menu__link-text">Rincian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('pembelian')."/kartuhutang"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Kartu Hutang</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('pembelian')."/saldohutang"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Saldo Hutang</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('pembelian')."/jatuhtempo"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Hutang Jatuh Tempo</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Inventory</span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('inventory')."/saldostok"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-folder"></i>
                        <span class="m-menu__link-text">Saldo Stok</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('inventory')."/kartustok"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-folder-1"></i>
                        <span class="m-menu__link-text">Kartu Stok</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
        <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Akuntansi</span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Buku Besar</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="<?php echo site_url('akuntansi')."/neraca"; ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Neraca</span>
                    </a>
                </li>
                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-file-contract"></i>
                        <span class="m-menu__link-text">Laba/Rugi</span>
                    </a>
                </li>
                <li class="m-menu__item  m-menu__item--submenu hidden" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                        <i class="m-menu__link-icon fa fa-shekel-sign"></i>
                        <span class="m-menu__link-text">Laba/Rugi</span>
                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                        <span class="m-menu__arrow "></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link ">
                                    <span class="m-menu__link-text">L/R Penjualan</span>
                                </a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                <a href="javascript:;" class="m-menu__link ">
                                    <span class="m-menu__link-text">L/R per Barang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>
    <li class="m-menu__item " aria-haspopup="true">
        <a href="<?php echo site_url('login/out'); ?>" class="m-menu__link ">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Logout</span>
        </a>
    </li>
</ul>
<?php else :?>
<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
    <li class="m-menu__item " aria-haspopup="true">
        <a href="<?php echo site_url(); ?>" class="m-menu__link ">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Dashboard</span>
        </a>
    </li>
    <li class="m-menu__item " aria-haspopup="true">
        <a href="<?php echo site_url('login/out'); ?>" class="m-menu__link ">
            <span class="m-menu__item-here"></span>
            <span class="m-menu__link-text">Logout</span>
        </a>
    </li>
</ul>
<?php endif; ?>