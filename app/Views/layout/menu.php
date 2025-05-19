            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
                <!-- Brand demo (see /assets/css/demo/demo.css) -->
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <img src="{{toko && toko.logo ? '/assets/gambar/'+toko.logo:'/assets/img/logo.png' }}" alt="Brand Logo" width="50px" class="img-fluid">
                    </span>
                    <a href="/" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Sneakers JPR</a>
                    <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        <i class="ion ion-md-menu align-middle"></i>
                    </a>
                </div>
                <div class="sidenav-divider mt-0"></div>

                <!-- Links -->
                <ul class="sidenav-inner py-1">

                    <!-- Dashboards -->
                    <li class="sidenav-item">
                        <a href="/admin/beranda" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Beranda</div>
                        </a>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'admin'">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-clipboard-list"></i>
                            <div>Manajemen Data</div>
                        </a>
                        <ul class="sidenav-menu">
                            <li class="sidenav-item">
                                <a href="/admin/area" class="sidenav-link">
                                    <div>Service Area</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'admin'">
                        <a href="/admin/toko" class="sidenav-link">
                            <i class="sidenav-icon feather icon-layers"></i>
                            <div>Toko</div>
                        </a>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'admin'">
                        <a href="/admin/pengguna" class="sidenav-link">
                            <i class="sidenav-icon feather icon-user"></i>
                            <div>Pengguna</div>
                        </a>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'admin'">
                        <a href="/admin/produk" class="sidenav-link">
                            <i class="sidenav-icon feather icon-package"></i>
                            <div>Produk</div>
                        </a>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'kasir'">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-exchange-alt"></i>
                            <div>Transaksi</div>
                        </a>
                        <ul class="sidenav-menu">
                            <li class="sidenav-item" ng-if="users.role == 'admin'">
                                <a href="/admin/pembelian" class="sidenav-link">
                                    <div>Pembelian</div>
                                </a>
                            </li>
                            <li class="sidenav-item">
                                <a href="/admin/penjualan" class="sidenav-link">
                                    <div>Penjualan</div>
                                </a>
                            </li>
                            <li class="sidenav-item">
                                <a href="/admin/order" class="sidenav-link">
                                    <div>Order</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'kasir'">
                        <a href="/admin/order/this_day" class="sidenav-link">
                            <i class="sidenav-icon feather icon-bar-chart"></i>
                            <div>Penjualan Hari ini</div>
                        </a>
                    </li>
                    <li class="sidenav-item" ng-if="users.role == 'admin'">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-file-alt"></i>
                            <div>Laporan</div>
                        </a>
                        <ul class="sidenav-menu">
                            <li class="sidenav-item">
                                <a href="/admin/laporan/pembelian" class="sidenav-link">
                                    <div>Pembelian</div>
                                </a>
                            </li>
                            <li class="sidenav-item">
                                <a href="/admin/laporan/penjualan" class="sidenav-link">
                                    <div>Penjualan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>