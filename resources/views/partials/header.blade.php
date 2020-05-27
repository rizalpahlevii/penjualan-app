<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{namaToko()}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('asset_toko') }}/{{logo()}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->nama }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('asset_toko') }}/{{logo()}}" class="img-circle" alt="User Image">

                            <p>
                                {{ Auth::user()->nama }} - {{ Auth::user()->level }}
                                <small>Member since {{ Auth::user()->created_at->format('d M Y H:i:s') }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div>

                                <div class="pull-left">
                                    <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <a href="{{ route('profile.password') }}" class="btn btn-default btn-flat">Ganti
                                    Password</a>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>