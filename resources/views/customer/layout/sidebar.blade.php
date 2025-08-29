<div id="sidebar" class="sidebar-customer col-md-3 col-lg-2 border-end min-vh-100 p-3">
    <div class="text-center mb-4">
        <img src="{{ asset('assets/img/'.auth()->user()->gambar) }}" alt="Profile" class="sidebar-img rounded-circle img-fluid mb-2">
        <h5 class="fw-semibold">{{ Auth::user()->name }}</h5>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="/profil-user" class="nav-link sidebar-item active">
                <i class="bi bi-person-circle me-2"></i> Pengaturan Profil
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="/riwayat-pesan" class="nav-link sidebar-item">
                <i class="bi bi-clock-history me-2"></i> Riwayat Pemesanan
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('logout') }}" class="nav-link sidebar-item">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="/" class="btn btn-customer w-100">
                Kembali
            </a>
        </li>
    </ul>
</div>


