<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
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
                class="treeview {{ set_active(['satuan.index','satuan.create','satuan.edit','kategori.index','kategori.create','kategori.edit']) }}">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['satuan.index','satuan.create','satuan.edit']) }}">
                        <a href="{{ route('satuan.index') }}"><i class="fa fa-circle-o"></i> Satuan Barang</a>
                    </li>

                    <li class="{{ set_active(['kategori.index','kategori.create','kategori.edit']) }}">
                        <a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori Barang</a>
                    </li>

                </ul>
            </li>
            <li class="{{ set_active(['barang.create','barang.index']) }}">
                <a href="{{ route('barang.index') }}">
                    <i class="fa fa-reorder"></i> <span>Barang</span>
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
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>