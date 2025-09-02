@extends('setup.app')

@section('title', 'Preview Produk - MostlyWeb')

@section('content')

<div class="container my-5">
    <div class="swiper myPreviewSwiper">
        <div class="swiper-wrapper">
            @foreach($produk->previews as $index => $preview)
                <div class="swiper-slide">
                    <img src="{{ asset('assets/img/' . $preview->gambar) }}" class="img-fluid" style="height:500px; width:100%; object-fit:cover;">
                </div>
            @endforeach
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <h2 class="fw-bold mt-3">{{ $produk->nama_produk }}</h2>
    <div class="mt-5">
        <h4 class="fw-bold text-dark mb-3">Komponen yang Digunakan</h4>
        <div class="d-flex flex-wrap gap-3">
            @foreach($produk->logos as $logo)
                <div class="komponen-logo text-center">
                    <img src="{{ asset('assets/' . $logo->gambar_logo) }}" alt="logo" class="img-thumbnail rounded p-2">
                    <small class="d-block mt-2 text-muted">{{ $logo->nama_logo }}</small>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-5">
        <h4 class="fw-bold text-dark mb-3">Fitur Produk</h4>
        <div class="d-flex flex-wrap gap-3">
            @php
                $features = is_array($produk->fitur) ? $produk->fitur : json_decode($produk->fitur, true);
            @endphp
            <ul class="list-unstyled">
                @foreach ($features as $fitur)
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $fitur }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="text-center mt-5">
        @if (isset($subpaket_id))
            <a href="{{ route('list.produk', ['subpaket_id' => $subpaket_id]) }}" class="btn btn-secondary px-4">
                Kembali
            </a>
        @else
            <a href="{{ route('list.produk') }}" class="btn btn-secondary px-4">
                Kembali
            </a>
            <button type="button" class="btn btn-primary px-4 ms-2" data-bs-toggle="modal" data-bs-target="#paketModal">
                Gunakan Desain
            </button>
        @endif
    </div>
</div>

<!-- Modal untuk memilih paket -->
@if(!isset($subpaket_id))
<div class="modal fade" id="paketModal" tabindex="-1" aria-labelledby="paketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paketModalLabel">Pilih Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="pilihPaket" class="form-label">Pilih Paket Jasa</label>
                    <select id="pilihPaket" class="form-select">
                        @foreach($detailPakets as $paket)
                            <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}" data-benefit="{{ json_encode($paket->benefit) }}" data-nama-paket="{{ $paket->paket->nama_paket }}">
                                {{ $paket->nama_subpaket }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="paket-details" class="card p-3 bg-light" style="display:none;">
                    <h6 class="fw-bold mb-2">Paket <span id="nama-paket"></span></h6>
                    <h6 class="fw-bold mb-2">Harga: <span id="harga-paket"></span></h6>
                    <h6 class="fw-bold">Benefit yang didapat:</h6>
                    <ul id="benefit-list" class="list-unstyled"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="lanjutkan-btn" class="btn btn-success">Lanjutkan Pemesanan</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pilihPaketSelect = document.getElementById('pilihPaket');
        const paketDetails = document.getElementById('paket-details');
        const namaPaketSpan = document.getElementById('nama-paket');
        const hargaPaketSpan = document.getElementById('harga-paket');
        const benefitList = document.getElementById('benefit-list');
        const lanjutkanBtn = document.getElementById('lanjutkan-btn');
        const produkId = {{ $produk->id }};

        function updateModalContent() {
            const selectedOption = pilihPaketSelect.options[pilihPaketSelect.selectedIndex];
            const namaPaket = selectedOption.getAttribute('data-nama-paket');
            const harga = selectedOption.getAttribute('data-harga');
            const benefitJson = selectedOption.getAttribute('data-benefit');
            const subpaketId = selectedOption.value;

            namaPaketSpan.textContent = namaPaket;
            hargaPaketSpan.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(harga);

            try {
                const benefits = JSON.parse(benefitJson);
                benefitList.innerHTML = benefits.map(b => `<li><i class="bi bi-check-circle-fill text-success me-2"></i>${b}</li>`).join('');
            } catch (e) {
                benefitList.innerHTML = `<li class="text-muted">Tidak ada benefit terdaftar</li>`;
            }

            lanjutkanBtn.href = `/pemesanan/${subpaketId}?produk_id=${produkId}`;
            paketDetails.style.display = 'block';
        }

        if (pilihPaketSelect) {
            updateModalContent();
            pilihPaketSelect.addEventListener('change', updateModalContent);
        }
    });
</script>
@endif
@endsection
