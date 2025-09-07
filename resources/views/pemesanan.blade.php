@extends('setup.app')
@section('title', 'Pemesanan - MostlyWeb')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold text-center mb-4">Form Pemesanan</h2>
                <div class="card shadow-lg border-0 rounded-3 mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold text-secondary mb-3">{{ $subpaket->nama_subpaket }}</h4>
                        <h3 class="text-dark mb-3">Rp {{ number_format($subpaket->harga ?? 0, 0, ',', '.') }}</h3>
                        <h5 class="fw-semibold mb-2">Benefit yang didapat:</h5>
                        <ul class="list-unstyled">
                            @php
                                $benefits = is_array($subpaket->benefit ?? [])
                                    ? $subpaket->benefit
                                    : json_decode($subpaket->benefit ?? '[]', true);
                            @endphp
                            @forelse ($benefits as $benefit)
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $benefit }}</li>
                            @empty
                                <li class="text-muted">Tidak ada benefit terdaftar</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Detail Pemesanan</h5>
                        <form action="{{ route('user.pesen') }}" method="POST">
                            @csrf
                            <!-- Input hidden untuk subpaket_id dan user_id -->
                            <input type="hidden" name="subpaket_id" value="{{ $subpaket->id }}">

                            <!-- Blok Opsi Desain dimasukkan ke dalam form -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Pilih Opsi Desain Website</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="opsiDesain" id="opsiProduk"
                                        value="produk" @if (request()->has('produk_id')) checked @else checked @endif>
                                    <label class="form-check-label" for="opsiProduk">
                                        Menggunakan Desain Produk Katalog Tersedia
                                    </label>
                                    <div class="mt-2" id="design-option-container">
                                        @if (request()->has('produk_id'))
                                            <div id="selected-product-card"
                                                class="card p-3 d-flex flex-column align-items-start gap-3 position-relative">
                                                <img src="{{ asset('assets/img/' . $produk->gambar_produk) }}"
                                                    alt="{{ $produk->nama_produk }}" class="rounded"
                                                    style="width:100%; object-fit: cover;">
                                                <div>
                                                    <button type="button" id="remove-design-btn"
                                                        class="btn-close position-absolute end-0 m-3"></button>
                                                    <h6 class="mb-0 fw-semibold">{{ $produk->nama_produk }}</h6>
                                                    <a href="{{ route('list.produk', ['subpaket_id' => $subpaket->id]) }}"
                                                        type="button" class="btn btn-sm register-btn px-1 mt-1">Ganti
                                                        Desain</a>
                                                </div>
                                            </div>
                                        @else
                                            <div id="tambah-desain-btn"
                                                class="d-flex flex-wrap justify-content-center gap-3 mt-2">
                                                <a href="{{ route('list.produk', ['subpaket_id' => $subpaket->id]) }}"
                                                    class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                                    <i class="bi bi-plus-circle"></i> Tambah Desain Katalog
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if (!request()->has('produk_id'))
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="opsiDesain" id="opsiCustom"
                                            value="custom">
                                        <label class="form-check-label" for="opsiCustom">
                                            Membawa Desain Sendiri
                                        </label>
                                        <div class="mt-2 ms-4 text-muted small">
                                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                                <a href="https://wa.me/6281234567890" target="_blank"
                                                    class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                                    <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                                </a>
                                                <a href="mailto:emailanda@gmail.com"
                                                    class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                                    <i class="bi bi-envelope-fill me-2"></i> Gmail
                                                </a>
                                                <a href="https://instagram.com/username" target="_blank"
                                                    class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                                    <i class="bi bi-instagram me-2"></i> Instagram
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Akhir dari Opsi Desain -->

                            <!-- Input tersembunyi untuk menyimpan produk_id jika dipilih -->
                            @if (request()->has('produk_id'))
                                <input type="hidden" name="produk_id" id="produk-id-input"
                                    value="{{ request('produk_id') }}">
                            @endif

                            @if ($subpaket->paket->nama_paket === 'Bisnis')
                                <!-- Input nama domain dan ekstensi -->
                                <div class="mb-3">
                                    <label for="domain" class="form-label">Nama Domain Web</label>
                                    <div class="row g-3">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nama_domain" id="domain"
                                                placeholder="nama domain anda" required pattern="^[a-z0-9]+(-[a-z0-9]+)*$"
                                                title="Gunakan huruf kecil, angka, dan tanda minus (-) tanpa spasi">
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select" name="ekstensi_domain" id="ekstensi-domain"
                                                required>
                                                <option value=".com">.com</option>
                                                <option value=".id">.id</option>
                                                <option value=".co.id">.co.co.id</option>
                                                <option value=".net">.net</option>
                                                <option value=".org">.org</option>
                                                <option value=".info">.info</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                    placeholder="Tuliskan catatan jika ada"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
                                    Lanjutkan Pemesanan
                                </button>
                                <a href="/" class="btn btn-secondary px-4 py-2 ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeBtn = document.getElementById('remove-design-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('produk_id');
                    window.location.href = url.toString();
                });
            }

            // Logika untuk menonaktifkan produk_id jika opsi "Membawa Desain Sendiri" dipilih
            const opsiCustom = document.getElementById('opsiCustom');
            const produkIdInput = document.getElementById('produk-id-input');

            if (opsiCustom) {
                opsiCustom.addEventListener('change', function() {
                    if (this.checked && produkIdInput) {
                        produkIdInput.disabled = true;
                    }
                });
            }

            const opsiProduk = document.getElementById('opsiProduk');
            if (opsiProduk) {
                opsiProduk.addEventListener('change', function() {
                    if (this.checked && produkIdInput) {
                        produkIdInput.disabled = false;
                    }
                });
            }

            // Sanitasi input domain
            document.getElementById('domain').addEventListener('input', function() {
                this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '').replace(/^-+|-+$/g, '')
                    .replace(/--+/g, '-');
            });
        });
    </script>
@endsection
