<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('modernize/src/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('/') ? 'active' : '' }}" href="/dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pesanan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.pemesanan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">Pembelian</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.pembayaran.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-credit-card"></i>
                        </span>
                        <span class="hide-menu">Pembayaran</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Katalog</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('logo*') ? 'active' : '' }}" href="/logo"   aria-expanded="false">
                        <span>
                            <i class="ti ti-chart-donut-3"></i>
                        </span>
                        <span class="hide-menu">Logo</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('paket*') ? 'active' : '' }}" href="/paket" aria-expanded="false">
                        <span>
                            <i class="ti ti-package"></i>
                        </span>
                        <span class="hide-menu">Paket</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Template</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('kategori*') ? 'active' : '' }}" href="/kategori" aria-expanded="false">
                        <span>
                            <i class="ti ti-folder"></i>
                        </span>
                        <span class="hide-mwnu">Kategori Website</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('produk*') ? 'active' : '' }}" href="/produk" aria-expanded="false">
                        <span>
                            <i class="ti ti-palette"></i>
                        </span>
                        <span class="hide-menu">Produk Website</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Profil Admin</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('data-admin*') ? 'active' : '' }}" href="/data-admin" aria-expanded="false">
                        <span>
                            <i class="ti ti-id-badge"></i>
                        </span>
                        <span class="hide-menu">Data Admin</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Lainnya</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('ulasan*') ? 'active' : '' }}" href="/ulasan" aria-expanded="false">
                        <span>
                            <i class="ti ti-message-dots"></i>
                        </span>
                        <span class="hide-menu">Ulasan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('faq*') ? 'active' : '' }}" href="/faq" aria-expanded="false">
                        <span>
                            <i class="ti ti-help"></i>
                        </span>
                        <span class="hide-menu">FAQ</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
