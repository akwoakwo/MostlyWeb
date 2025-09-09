<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('assets/img/logo.png') }}" alt="MostlyWeb Logo" width="40" height="40" class="me-2">
            <span class="fw-bold">
                <span class="text-most">Mostly</span><span class="text-web">Web</span>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0 mx-lg-auto">
                <li class="nav-item mx-4 fw-bold">
                    <a class="nav-link nav-menu active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item mx-4 fw-bold">
                    <a class="nav-link nav-menu" href="#profil">Profil</a>
                </li>
                <li class="nav-item mx-4 fw-bold">
                    <a class="nav-link nav-menu" href="#layanan">Layanan</a>
                </li>
                <li class="nav-item mx-4 fw-bold">
                    <a class="nav-link nav-menu" href="#produk">Produk</a>
                </li>
                <li class="nav-item mx-4 fw-bold">
                    <a class="nav-link nav-menu" href="#kontak">Kontak</a>
                </li>
            </ul>

            @php
                use Illuminate\Support\Facades\Auth;
                use App\Models\Pemesanan;
                $pendingOrder = Pemesanan::where('user_id', Auth::id())
                    ->where('status_pembayaran', 'pending')
                    ->first();
            @endphp

            <div class="button-auth d-lg-flex ms-lg-3 mt-3 mt-lg-0">
                @auth
                    {{-- Cek pemesanan pending untuk user yang login --}}
                    @if ($pendingOrder)
                        <div class="position-relative me-3 d-flex align-items-center">
                            <a href="{{ route('pemesanan.detail', $pendingOrder->invoice_number) }}" class="text-dark">
                                <i class="bi bi-bag-fill" style="font-size: 1.2rem;"></i>
                               <span class="position-absolute top-20 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">pending orders</span>
                                </span>
                            </a>
                        </div>
                    @endif
                    <div class="dropdown d-flex align-items-center mb-3 ms-3 mb-lg-0 ms-lg-0">
                        @if (auth()->user()->gambar === null)
                            <img src="{{ auth()->user()->avatar }}" alt="Logo" width="35" height="35"
                                class="d-inline-block align-text-top bg-white rounded-circle">
                        @else
                            <img src="{{ asset('assets/img/' . auth()->user()->gambar) }}" alt="Logo" width="35"
                            height="35" class="d-inline-block align-text-top bg-white rounded-circle">
                        @endif
                        <a class="btn fw-bold dropdown-toggle text-truncate text-center d-inline-block"  href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/profil-user">Profil</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn login-btn me-2 fw-semibold" href="#" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Masuk</a>
                    <a class="btn register-btn me-2 fw-semibold" href="#" data-bs-toggle="modal"
                        data-bs-target="#registerModal">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow-lg">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-3">
                <h3 class="fw-bold"><span class="text-most">Mostly</span><span class="text-web">Web</span></h3>
            </div>
            <div class="modal-body">
                <p class="text-start fw-semibold">Silahkan Masukan Akun Anda</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="emailLogin" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="emailLogin" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
                        <label for="passwordLogin" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Masukkan password" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn login-btn fw-semibold text-light">Masuk</button>
                    </div>
                </form>


                <div class="text-center mb-3">
                    <p class="text-muted mb-2">Atau Masuk Dengan</p>
                    <div class="d-grid mb-3">
                        <a href="{{ route('login.google') }}" type="button" class="btn btn-outline-dark btn-google"><img src="https://www.svgrepo.com/show/355037/google.svg" width="20" alt="Google Logo"></a>
                    </div>
                </div>

                <div class="text-center">
                    <p class="mb-0">Belum punya akun?
                        <a href="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="text-secondary text-decoration-none fw-semibold">Daftar Akun</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow-lg">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-3">
                <h3 class="fw-bold"><span class="text-most">Mostly</span><span class="text-web">Web</span></h3>
            </div>
            <div class="modal-body">
                <p class="text-start fw-semibold">Silahkan Daftarkan Akun Anda</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="namaRegister" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="namaRegister" placeholder="Masukkan nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="nohpRegister" class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" id="nohpRegister" placeholder="Masukkan no HP" required>
                    </div>

                    <div class="mb-3">
                        <label for="emailRegister" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="emailRegister" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
                        <label for="passwordRegister" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordRegister" placeholder="Masukkan password" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn register-btn fw-semibold text-light">Daftar</button>
                    </div>
                </form>

                <div class="text-center mb-3">
                    <p class="text-muted mb-2">Atau Daftar Dengan</p>
                    <div class="d-grid mb-3">
                        <button type="button" class="btn btn-outline-dark btn-google"><img src="https://www.svgrepo.com/show/355037/google.svg" width="20" alt="Google Logo"></button>
                    </div>
                </div>

                <div class="text-center">
                    <p class="mb-0">Sudah punya akun?
                        <a href="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="text-secondary text-decoration-none fw-semibold">Masuk ke Akun</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

