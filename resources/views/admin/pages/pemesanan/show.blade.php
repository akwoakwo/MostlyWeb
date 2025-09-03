@extends('admin.setup.app')
@section('title', 'Detail Pemesanan - Admin MostlyWeb')
@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Pemesanan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted" href="{{ route('admin.pemesanan.index') }}">Data Pemesanan</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Detail Pemesanan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Pemesanan</h5>
                    <hr>
                    <p><strong>Nama User:</strong> {{ $pemesanan->user->name ?? 'User Tidak Ditemukan' }}</p>
                    <p><strong>Invoice Number:</strong> {{ $pemesanan->invoice_number }}</p>
                    <p><strong>Token Midtrans:</strong> {{ $pemesanan->token_midtrans }}</p>
                    <p><strong>Catatan:</strong> {{ $pemesanan->catatan }}</p>
                    <p><strong>Total Harga:</strong> Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Status Pembayaran:</strong> 
                        @if($pemesanan->status_pembayaran == 'success')
                            <span class="badge bg-success">Sudah Dibayar</span>
                        @elseif($pemesanan->status_pembayaran == 'pending')
                            <span class="badge bg-warning">Menunggu Pembayaran</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

                @if($pemesanan->pembayaran)
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Pembayaran</h5>
                    <hr>
                    <p><strong>Tanggal Bayar:</strong> {{ $pemesanan->pembayaran->created_at ? $pemesanan->pembayaran->created_at->translatedFormat('d F Y') : '-' }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ $pemesanan->pembayaran->payment_method ?? '-' }}</p>
                    <p><strong>Transaksi ID Midtrans:</strong> {{ $pemesanan->pembayaran->transaction_id_midtrans ?? '-' }}</p>
                    <p><strong>Issuer:</strong> {{ $pemesanan->pembayaran->issuer ?? '-' }}</p>
                    <p><strong>Acquirer:</strong> {{ $pemesanan->pembayaran->acquirer ?? '-' }}</p>
                    <p><strong>Total Pembayaran:</strong> Rp{{ number_format($pemesanan->pembayaran->total_amount, 0, ',', '.') }}</p>
                    <p><strong>Status Pembayaran:</strong> 
                        @if($pemesanan->pembayaran->status == 'settlement')
                            <span class="badge bg-success">Berhasil</span>
                        @elseif($pemesanan->pembayaran->status == 'pending')
                            <span class="badge bg-warning">Menunggu Konfirmasi</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Paket</h5>
                    <hr>
                    <p><strong>Nama Paket:</strong> {{ $pemesanan->subpaket->paket->nama_paket ?? '-' }}</p>
                    <p><strong>Sub Paket:</strong> {{ $pemesanan->subpaket->nama_subpaket ?? '-' }}</p>
                    <h6><strong>Benefit:</strong></h6>
                    <ul>
                        @foreach($pemesanan->subpaket->benefit ?? [] as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        @if($pemesanan->produk)
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Produk</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="card">
                                <img src="{{ asset('assets/img/' . $pemesanan->produk->gambar_produk) }}" class="card-img-top" alt="Cover Produk">
                                <div class="card-body text-left">
                                    <h5 class="card-title">{{ $pemesanan->produk->nama_produk }}</h5>
                                    <h6>Fitur Produk:</h6>
                                    <ul>
                                        @foreach($pemesanan->produk->fitur as $fitur)
                                            <li>{{ $fitur }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection