<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pembayaran - {{ $pemesanan->invoice_number }}</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Khusus untuk Resi -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .receipt-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .receipt-header {
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .receipt-header img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
        .receipt-header .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .receipt-header .text-most {
            color: #342C54; /* Warna merah */
        }
        .receipt-header .text-web {
            color: #FF7F50; /* Warna biru */
        }
        .receipt-body .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .receipt-body .detail-row strong {
            color: #495057;
        }
        .total-section {
            border-top: 1px dashed #dee2e6;
            margin-top: 20px;
            padding-top: 15px;
        }
        .footer-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        .footer-section .social-media {
            margin-top: 10px;
        }
        .footer-section .social-media a {
            margin: 0 10px;
            color: #495057;
            text-decoration: none;
        }
        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }
        @media print {
            body {
                background-color: #fff;
            }
            .receipt-container {
                max-width:100%;
                box-shadow: none;
                margin: 0;
            }
            .print-button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            <div class="logo-text">
                <span class="text-most">Mostly</span><span class="text-web">Web</span>
            </div>
            <h1 class="fw-bold text-center">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h1>
        </div>

        <div class="receipt-body">
            <div class="detail-row">
                <span>Invoice</span>
                <span>{{ $pemesanan->invoice_number }}</span>
            </div>
            <div class="detail-row">
                <span>Status</span>
                @if ($pemesanan->status_pembayaran == 'success')
                    <span>Berhasil</span>
                @endif
            </div>
            @if ($pemesanan->pembayaran)
            <div class="detail-row">
                <span>Metode Pembayaran</span>
                <span>{{ $pemesanan->pembayaran->payment_method }}</span>
            </div>
            <div class="detail-row">
                <span>Tanggal</span>
                <span>{{ \Carbon\Carbon::parse($pemesanan->pembayaran->transaction_time)->format('d F Y') }}</span>
            </div>
            <div class="detail-row">
                <span>Issuer</span>
                <span>{{ $pemesanan->pembayaran->issuer ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span>Acquirer</span>
                <span>{{ $pemesanan->pembayaran->acquirer ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span>Nomor Referensi</span>
                <span>{{ $pemesanan->pembayaran->reference_number ?? 'N/A' }}</span>
            </div>
            @endif
            <hr>
            <h6>Rincian Transaksi</h6>
            <div class="detail-row">
                <span>Jenis Paket</span>
                <span>{{ $pemesanan->subpaket->nama_subpaket }}</span>
            </div>
            @if ($pemesanan->produk)
            <div class="detail-row mt-2">
                <span>Desain Referensi</span>
                <span>{{ $pemesanan->produk->nama_produk }}</span>
            </div>
            @else
            <div class="detail-row mt-2">
                <span>Desain Referensi</span>
                <span>Custom</span>
            </div>
            @endif
            <div class="detail-row">
                <span>Jumlah</span>
                <span>Rp {{ number_format($pemesanan->subpaket->harga, 0, ',', '.') }}</span>
            </div>
            <div class="total-section">
                <div class="detail-row fw-bold">
                    <span>Total</span>
                    <span>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="footer-section">
            <p class="text-muted small">Terima kasih telah melakukan pemesanan di MostlyWeb.</p>
            <div class="social-media">
                <a href="https://instagram.com/username" target="_blank" class="text-decoration-none">@mosktlyweb</a>
                |
                <a href="mailto:emailanda@gmail.com" target="_blank" class="text-decoration-none">mostlyweb@gmail.com</a>
                |
                <a href="https://wa.me/6281234567890" target="_blank" class="text-decoration-none">08237428274</a>
            </div>
        </div>
    </div>
    <div class="print-button-container">
        <button onclick="window.print()" class="btn btn-primary px-4">Cetak Resi</button>
    </div>
</body>
</html>
