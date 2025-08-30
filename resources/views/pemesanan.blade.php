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

            <div class="card shadow border-0 rounded-3 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Pilih Opsi Desain Website</h5>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="opsiDesain" id="opsiProduk" value="produk" checked>
                        <label class="form-check-label" for="opsiProduk">
                            Menggunakan Desain Produk Katalog Tersedia
                        </label>
                        <div class="mt-2 text-dark small">
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="/produk" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                    <i class="bi bi-plus-circle"></i> Tambah Desain Katalog
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opsiDesain" id="opsiCustom" value="custom">
                        <label class="form-check-label" for="opsiCustom">
                            Membawa Desain Sendiri
                        </label>
                        <div class="mt-2 ms-4 text-muted small">
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                    <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                </a>
                                <a href="mailto:emailanda@gmail.com" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                    <i class="bi bi-envelope-fill me-2"></i> Gmail
                                </a>
                                <a href="https://instagram.com/username" target="_blank" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                                    <i class="bi bi-instagram me-2"></i> Instagram
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0 rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Data Pemesan</h5>

                    <form>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" placeholder="nama@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon / WhatsApp</label>
                            <input type="text" class="form-control" id="telepon" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" rows="3" placeholder="Tuliskan catatan jika ada"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-success px-4 py-2 fw-semibold">
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
@endsection
