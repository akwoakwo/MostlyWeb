@extends('setup.app')
@section('title', 'Terima Kasih - MostlyWeb')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 5rem;"></i>
            <h2 class="fw-bold mb-3">Terima Kasih atas Pemesanan Anda!</h2>
            <p class="lead mb-4">
                Pesanan Anda dengan nomor invoice <b>{{ $pemesanan->invoice_number }}</b> telah berhasil kami terima dan akan segera kami proses.
            </p>
            <div class="card shadow-lg border-0 rounded-3 p-4 mb-4 text-start">
                <h5 class="fw-bold mb-3">Detail Pesanan</h5>
                <p class="mb-1"><b>Paket:</b> {{ $pemesanan->subpaket->nama_subpaket }}</p>
                @if (isset($pemesanan->domain))
                    <p class="mb-1"><b>Nama Domain:</b> {{ $pemesanan->domain }}</p>
                @endif
                @if ($pemesanan->produk)
                    <p class="mb-1"><b>Desain Referensi:</b> {{ $pemesanan->produk->nama_produk }}</p>
                @else
                    <p class="mb-1"><b>Desain Referensi:</b> Tidak menggunakan desain katalog.</p>
                @endif
                <p class="mb-1"><b>Total Harga:</b> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('pemesanan.resi', ['invoice_number' => $pemesanan->invoice_number]) }}" class="btn btn-primary px-4 py-2 fw-semibold" target="_blank">
                    Cetak Resi Pesanan
                </a>
                <a href="{{ route('user') }}" class="btn btn-secondary px-4 py-2 fw-semibold">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
