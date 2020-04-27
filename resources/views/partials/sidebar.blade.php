<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('assets') }}/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">James Brown</div><small>Administrator</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="{{ set_active('dashboard') }}" href="{{ route('dashboard') }}"><i
                        class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">MASTER</li>
            <li>
                <a class="{{ set_active(['barang.index']) }}" href="{{ route('barang.index') }}"><i
                        class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Barang</span>
                </a>
            </li>
        </ul>
    </div>
</nav>