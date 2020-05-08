<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nama }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('dashboard') }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li
                class="treeview {{ set_active(['satuan.index','satuan.create','satuan.edit','kategori.index','kategori.create','kategori.edit','barang.create','barang.index','barang.edit','barang.masuk.index','barang.masuk.create']) }}">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>Barang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['satuan.index','satuan.create','satuan.edit']) }}">
                        <a href="{{ route('satuan.index') }}"><i class="fa fa-circle-o"></i> Satuan</a>
                    </li>

                    <li class="{{ set_active(['kategori.index','kategori.create','kategori.edit']) }}">
                        <a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori</a>
                    </li>

                    <li class="{{ set_active(['barang.index','barang.create','barang.edit']) }}">
                        <a href="{{ route('barang.index') }}"><i class="fa fa-circle-o"></i> Barang</a>
                    </li>
                    <li class="{{ set_active(['barang.masuk.index']) }}">
                        <a href="{{ route('barang.masuk.index') }}"><i class="fa fa-circle-o"></i> Stok Masuk</a>
                    </li>
                    <li class="{{ set_active(['barang.barcode.index']) }}">
                        <a href="{{ route('barang.barcode.index') }}"><i class="fa fa-circle-o"></i> Barcode</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['suplier.index','suplier.create','suplier.edit']) }}">
                <a href="{{ route('suplier.index') }}">
                    <i class="fa fa-truck"></i> <span>Suplier</span>
                </a>
            </li>
            <li class="{{ set_active(['pelanggan.create','pelanggan.index','pelanggan.edit']) }}">
                <a href="{{ route('pelanggan.index') }}">
                    <i class="fa fa-user"></i> <span>Pelanggan</span>
                </a>
            </li>
            <li class="{{ set_active(['user.create','user.index','user.edit']) }}">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li class="{{ set_active(['kasir.index']) }}">
                <a href="{{ route('kasir.index') }}">
                    <i class="fa fa-th"></i> <span>Kasir</span>
                </a>
            </li>
            <li
                class="treeview {{ set_active(['transaksi.piutang.index','transaksi.return.penjualan.index','transaksi.pembelian.index','transaksi.pembelian.create','transaksi.hutang.index','transaksi.return.penjualan.index','transaksi.return.penjualan.create','transaksi.return.pembelian.index','transaksi.return.pembelian.create','transaksi.penjualan.periode.index','transaksi.penjualan.barang.index']) }}">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ set_active(['transaksi.piutang.index']) }}">
                        <a href="{{ route('transaksi.piutang.index') }}"><i class="fa fa-calendar"></i> Piutang</a>
                    </li>
                    <li class="{{ set_active(['transaksi.hutang.index']) }}">
                        <a href="{{ route('transaksi.hutang.index') }}"><i class="fa fa-calendar-o"></i>
                            Hutang</a>
                    </li>
                    <li class="{{ set_active(['transaksi.pembelian.index','transaksi.pembelian.create']) }}">
                        <a href="{{ route('transaksi.pembelian.index') }}"><i class="fa fa-shopping-basket"></i>
                            Pembelian</a>
                    </li>

                    <li
                        class="treeview {{ set_active(['transaksi.penjualan.periode.index','transaksi.penjualan.barang.index']) }}">
                        <a href="#"><i class="fa fa-shopping-bag"></i> Penjualan
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ set_active(['transaksi.penjualan.periode.index']) }}">
                                <a href="{{ route('transaksi.penjualan.periode.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Per Periode</a></li>

                            <li class="{{ set_active(['transaksi.penjualan.barang.index']) }}">
                                <a href="{{ route('transaksi.penjualan.barang.index') }}"><i class="fa fa-circle-o"></i>
                                    Per Barang</a></li>
                        </ul>
                    </li>
                    <li
                        class="treeview {{ set_active(['transaksi.return.penjualan.index','transaksi.return.penjualan.create','transaksi.return.pembelian.index','transaksi.return.pembelian.create']) }}">
                        <a href="#"><i class="fa fa-sticky-note"></i> Return
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li
                                class="{{ set_active(['transaksi.return.penjualan.index','transaksi.return.penjualan.create']) }}">
                                <a href="{{ route('transaksi.return.penjualan.index') }}"><i class="fa fa-circle-o"></i>
                                    Penjualan</a></li>
                            <li
                                class="{{ set_active(['transaksi.return.pembelian.index','transaksi.return.pembelian.create']) }}">
                                <a href="{{ route('transaksi.return.pembelian.index') }}"><i class="fa fa-circle-o"></i>
                                    Pembelian</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li
                class="treeview {{ set_active(['laporan.kas.index','laporan.kas.create','laporan.cetak.index','laporan.kas.create','laporan.labarugi.index','laporan.grafik.index']) }}">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['laporan.kas.index']) }}">
                        <a href="{{ route('laporan.kas.index') }}"><i class="fa fa-calendar"></i> Kas</a>
                    </li>
                    <li class="{{ set_active(['laporan.cetak.index']) }}">
                        <a href="{{ route('laporan.cetak.index') }}"><i class="fa fa-print"></i> Cetak</a>
                    </li>
                    <li class="{{ set_active(['laporan.labarugi.index']) }}">
                        <a href="{{ route('laporan.labarugi.index') }}"><i class="fa fa-line-chart"></i> Laba Rugi</a>
                    </li>
                    <li class="{{ set_active(['laporan.grafik.index']) }}">
                        <a href="{{ route('laporan.grafik.index') }}"><i class="fa fa-bar-chart"></i> Grafik</a>
                    </li>

                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>