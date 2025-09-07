@extends('setup.app')
@section('title', 'Detail Pemesanan - MostlyWeb')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold text-center mb-4">Detail Pemesanan</h2>
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="fw-bold mb-3">Invoice: {{ $pemesanan->invoice_number }}</h5>
                            <h2 class="mb-1"><b>Total Biaya: Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                </b></h2>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-6 align-self-center">
                                <p class="mb-1"><b>Nama:</b> {{ $pemesanan->user->name }}</p>
                                <p class="mb-1"><b>Email:</b> {{ $pemesanan->user->email }}</p>
                                @if (isset($pemesanan->domain))
                                    <p class="mb-1"><b>Nama Domain:</b> {{ $pemesanan->domain }}</p>
                                @endif
                                <p class="mb-1"><b>Status Pembayaran:</b> <span
                                        class="badge bg-warning">{{ $pemesanan->status_pembayaran }}</span></p>
                                @if ($pemesanan->catatan)
                                    <p class="mb-1"><b>Catatan:</b> {{ $pemesanan->catatan }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if ($pemesanan->produk_id === null)
                                    <p class="mb-1"><b>Silahkan melakukan konsultasi melalui media sosial kami berikut
                                            ini</b></p>
                                    <div class="mt-2 text-muted small">
                                        <div class="d-flex flex-column justify-content-center gap-2">
                                            <a href="https://wa.me/6281234567890" target="_blank"
                                                class="btn btn-light login-btn px-4 py-2 fw-semibold">
                                                <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                            </a>
                                            <a href="mailto:emailanda@gmail.com"
                                                class="btn btn-light login-btn px-4 py-2 fw-semibold">
                                                <i class="bi bi-envelope-fill me-2"></i> Gmail
                                            </a>
                                            <a href="https://instagram.com/username" target="_blank"
                                                class="btn btn-light login-btn px-4 py-2 fw-semibold">
                                                <i class="bi bi-instagram me-2"></i> Instagram
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ asset('assets/img/' . $pemesanan->produk->gambar_produk) }}"
                                        alt="{{ $pemesanan->produk->nama_produk }}" class="rounded"
                                        style="width:100%; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <hr>
                            <p class="mb-1"><b>Paket:</b> {{ $pemesanan->subpaket->nama_subpaket }}</p>
                            @if ($pemesanan->produk_id === null)
                                <p class="mb-1"><b>Referensi Desain:</b> Custom via konsultasi</p>
                            @else
                                <p class="mb-1"><b>Referensi Desain:</b> {{ $pemesanan->produk->nama_produk }}</p>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="button" class="btn btn-success px-4 py-2 fw-semibold" id="checkout-btn">
                                Lanjutkan Checkout
                            </button>
                            <button type="button" class="btn btn-danger px-4 py-2 fw-semibold" data-bs-toggle="modal"
                                data-bs-target="#batalModal">
                                Batalkan Pemesanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Pembatalan -->
    <div class="modal fade" id="batalModal" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalModalLabel">Konfirmasi Pembatalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin membatalkan pesanan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <form action="{{ route('pemesanan.cancel', $pemesanan->invoice_number) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Sertakan pustaka Midtrans Snap.js --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBtn = document.getElementById('checkout-btn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', async function() {
                this.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memuat...`;
                this.disabled = true;

                const invoiceNumber = "{{ $pemesanan->invoice_number }}";

                try {
                    // Ambil token dari backend
                    const response = await fetch('/midtrans/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ invoice_number: invoiceNumber })
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Gagal memuat modal pembayaran.');
                    }

                    const data = await response.json();
                    const snapToken = data.snap_token;

                    // Bangun pesan WhatsApp
                    let waMessage = `*Pemesanan Baru (Menunggu Pembayaran)*
                                    *Invoice:* {{ $pemesanan->invoice_number }}
                                    *Nama:* {{ $pemesanan->user->name }}
                                    *Email:* {{ $pemesanan->user->email }}
                                    *Paket:* {{ $pemesanan->subpaket->nama_subpaket }}
                                    @if($pemesanan->domain)
                                    *Domain:* {{ $pemesanan->domain }}
                                    @endif
                                    *Harga:* Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}`;
                    
                    @if ($pemesanan->produk)
                        waMessage += `\n*Desain:* {{ $pemesanan->produk->nama_produk }}`;
                    @endif

                    waMessage += `\n\nSilakan cek dashboard Midtrans untuk memproses transaksi.`;

                    // Kirim notifikasi ke WhatsApp
                    const waLink = `https://wa.me/6281329871420?text=${encodeURIComponent(waMessage)}`;
                    window.open(waLink, '_blank');

                    // Buka modal pembayaran Midtrans
                    snap.pay(snapToken, {
                        onSuccess: function (result) {
                            Swal.fire({
                                title: 'Pembayaran Berhasil!',
                                text: 'Terima kasih atas pembayaran Anda. Kami akan segera memproses pesanan Anda.',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = "{{ route('pemesanan.thankYou', ['invoice_number' => $pemesanan->invoice_number]) }}";
                            });
                        },
                        onPending: function (result) {
                            Swal.fire('Pembayaran Tertunda', 'Transaksi Anda masih menunggu pembayaran. Silakan selesaikan pembayaran.', 'warning');
                        },
                        onError: function (result) {
                            Swal.fire('Pembayaran Gagal', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.', 'error');
                        },
                        onClose: function () {
                            Swal.fire('Pembayaran Dibatalkan', 'Anda menutup modal pembayaran. Pesanan Anda tetap menunggu pembayaran.', 'info');
                        }
                    });

                } catch (error) {
                    Swal.fire('Terjadi Kesalahan', error.message, 'error');
                } finally {
                    this.innerHTML = `Lanjutkan Checkout`;
                    this.disabled = false;
                }
            });
        }
    });
</script>
