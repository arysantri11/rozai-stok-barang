<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/logo/logo-bsi.png') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/logo/logo-bsi.png') }}" alt="logo" />
        </a>
    </div>
    <ul class="nav">
        {{-- User Info --}}
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('images/user.jpg') }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                        <span>Gold Member</span>
                    </div>
                </div>
            </div>
        </li>
        {{-- End User Info --}}

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/dashboard') }}">
            <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Operator</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/user') }}">
            <span class="menu-icon">
                <i class="mdi mdi-account-multiple-outline"></i>
            </span>
            <span class="menu-title">User</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/kategori') }}">
            <span class="menu-icon">
                <i class="mdi mdi-view-grid"></i>
            </span>
            <span class="menu-title">Kategori</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/barang') }}">
            <span class="menu-icon">
                <i class="mdi mdi-package"></i>
            </span>
            <span class="menu-title">Barang</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
                <span class="menu-icon">
                    <i class="mdi mdi-cart-outline"></i>
                </span>
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaksi">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/brg-masuk') }}">Barang Masuk</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/brg-keluar') }}">Barang Keluar</a></li>
            </ul>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Stok</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/stok') }}">
            <span class="menu-icon">
                <i class="mdi mdi-package-variant-closed"></i>
            </span>
            <span class="menu-title">Stok Barang</span>
            </a>
        </li>
    </ul>
</nav>