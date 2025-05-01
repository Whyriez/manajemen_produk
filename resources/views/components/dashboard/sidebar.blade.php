<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header" style="padding: 10px; background: none;">
            <a href="#" class="b-brand text-primary" style="display: flex; align-items: center; text-decoration: none;">
                <!-- Logo -->
                <img src="../assets/images/logo/logomlm.png" alt="logo"
                     style="max-width: 40px; height: auto; margin-right: 10px; display: block; background: none;">
        
                <!-- Label -->
                <span style="font-size: 18px; font-weight: bold; color: #ff1100;">PT BEST</span>
            </a>
        </div>
        
        <div class="navbar-content">
            <ul class="pc-navbar">
                @if (Auth::user()->role == 'admin')
                    <li class="pc-item">
                        <a href="{{ route('admin') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('admin.member.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Member</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('produks.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-inbox"></i></span>
                            <span class="pc-mtext">Produk</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('produks.members.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-inbox"></i></span>
                            <span class="pc-mtext">Produk Member</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('distribusi-produks.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-inbox"></i></span>
                            <span class="pc-mtext">Distribusi Produk Member</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('penjualans.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-exchange"></i></span>
                            <span class="pc-mtext">Penjualan</span>
                        </a>
                    </li>
                @else
                    <li class="pc-item">
                        <a href="{{ route('member') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('stoks.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box"></i></span>
                            <span class="pc-mtext">Stok Saya</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('addproduks.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-inbox"></i></span>
                            <span class="pc-mtext">Produk</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('transaksis.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-exchange"></i></span>
                            <span class="pc-mtext">Riwayat Transaksi</span>
                        </a>
                    </li>
                @endif

                {{-- <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                            class="pc-mtext">Menu
                            levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
