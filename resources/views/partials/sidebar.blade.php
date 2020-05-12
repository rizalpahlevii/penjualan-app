<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('favicon.png') }}" class="img-circle" alt="User Image">
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
            @if (Auth::user()->level == "Admin")
            <li
                class="treeview {{ set_active(['satuan.index','satuan.create','satuan.edit','kategori.index','kategori.create','kategori.edit','barang.create','barang.index','barang.edit','barang.masuk.index','barang.masuk.create','barang.barcode.index']) }}">
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
            @endif


            @if (Auth::user()->level == "Admin")
            <li
                class="treeview {{ set_active(['jabatan.index','jabatan.create','jabatan.edit','suplier.index','suplier.create','suplier.edit','pelanggan.create','pelanggan.index','pelanggan.edit','pegawai.create','pegawai.index','pegawai.edit']) }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['jabatan.index','jabatan.create','jabatan.edit']) }}">
                        <a href="{{ route('jabatan.index') }}"><i class="fa fa-bookmark"></i> Jabatan</a>
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
                    <li class="{{ set_active(['pegawai.create','pegawai.index','pegawai.edit']) }}">
                        <a href="{{ route('pegawai.index') }}">
                            <i class="fa fa-user"></i> <span>Pegawai</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if (Auth::user()->level == "Admin" or Auth::user()->level == "Petugas")

            <li class="{{ set_active(['kasir.index']) }}">
                <a href="{{ route('kasir.index') }}">
                    <i class="fa fa-th"></i> <span>Kasir</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->level == "Admin" or Auth::user()->level == "Petugas")
            <li
                class="treeview {{ set_active(['transaksi.piutang.index','transaksi.return.penjualan.index','transaksi.pembelian.index','transaksi.pembelian.create','transaksi.hutang.index','transaksi.return.penjualan.index','transaksi.return.penjualan.create','transaksi.return.pembelian.index','transaksi.return.pembelian.create','transaksi.penjualan.periode.index','transaksi.penjualan.barang.index','transaksi.penggajian.index','transaksi.penggajian.create','transaksi.kas.index','transaksi.kas.create','transaksi.penjualan.all']) }}">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['transaksi.kas.index','transaksi.kas.create']) }}">
                        <a href="{{ route('transaksi.kas.index') }}"><i class="fa fa-calendar"></i> Kas</a>
                    </li>
                    <li class="{{ set_active(['transaksi.penggajian.index','transaksi.penggajian.create']) }}">
                        <a href="{{ route('transaksi.penggajian.index') }}"><i class="fa fa-credit-card"></i>
                            Penggajian</a>
                    </li>
                    <li class="{{ set_active(['transaksi.penjualan.all']) }}">
                        <a href="{{ route('transaksi.penjualan.all') }}"><i class="fa fa-credit-card"></i>
                            Transaksi Penjualan</a>
                    </li>
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
            @endif

            @if (Auth::user()->level == "Admin" or Auth::user()->level == "Manager")
            <li
                class="treeview {{ set_active(['report.penjualan.periode.index','report.penjualan.barang.index','report.grafik.index','report.pembelian.pembelian','report.kas.index','report.labarugi.index','report.penjualan.periode','report.penjualan.barang','report.hutang.index','report.piutang.index']) }}">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview {{ set_active(['report.penjualan.periode','report.penjualan.barang']) }}">
                        <a href="#"><i class="fa fa-shopping-bag"></i> Penjualan
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ set_active(['report.penjualan.periode']) }}">
                                <a href="{{ route('report.penjualan.periode') }}"><i class="fa fa-circle-o"></i>
                                    Per Periode</a></li>

                            <li class="{{ set_active(['report.penjualan.barang']) }}">
                                <a href="{{ route('report.penjualan.barang') }}"><i class="fa fa-circle-o"></i>
                                    Per Barang</a></li>
                        </ul>
                    </li>
                    <li class="{{ set_active(['report.pembelian.pembelian']) }}">
                        <a href="{{ route('report.pembelian.pembelian') }}"><i class="fa fa-shopping-cart"></i>
                            Pembelian</a>
                    </li>
                    <li class="{{ set_active(['report.hutang.index']) }}">
                        <a href="{{ route('report.hutang.index') }}"><i class="fa fa-calendar-minus-o"></i> Hutang</a>
                    </li>
                    <li class="{{ set_active(['report.piutang.index']) }}">
                        <a href="{{ route('report.piutang.index') }}"><i class="fa fa-calendar"></i> Piutang</a>
                    </li>
                    <li class="{{ set_active(['report.kas.index']) }}">
                        <a href="{{ route('report.kas.index') }}"><i class="fa fa-calendar-check-o"></i> Kas</a>
                    </li>
                    <li class="{{ set_active(['report.labarugi.index']) }}">
                        <a href="{{ route('report.labarugi.index') }}"><i class="fa fa-line-chart"></i> Laba Rugi</a>
                    </li>
                    <li class="{{ set_active(['report.penggajian.index']) }}">
                        <a href="{{ route('report.penggajian.index') }}"><i class="fa fa-user"></i> Penggajian</a>
                    </li>
                    <li class="{{ set_active(['report.grafik.index']) }}">
                        <a href="{{ route('report.grafik.index') }}"><i class="fa fa-bar-chart"></i> Grafik</a>
                    </li>
                </ul>
            </li>
            @endif


            @if (Auth::user()->level == "Admin")
            <li class="header">Pengaturan</li>
            <li class="{{ set_active(['user.create','user.index','user.edit']) }}">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-users"></i> <span>Pengguna</span>
                </a>
            </li>
            @endif
        </ul>
    </section>

</aside>