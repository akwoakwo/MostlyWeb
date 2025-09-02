<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cetak Data Pembayaran</title>
<!-- Bootstrap CSS untuk styling tabel -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.google.com/search?q=https://cdn.jsdelivr.net/npm/%40tabler/icons-webfont%40latest/tabler-icons.min.css">
<style>
body {
font-family: 'Poppins', sans-serif;
margin: 20mm;
color: #000;
}
.header-print {
text-align: center;
margin-bottom: 30px;
}
.header-print img {
max-width: 150px;
margin-bottom: 10px;
}
.header-print h2 {
font-weight: bold;
}
.filter-info {
font-size: 14px;
margin-bottom: 20px;
text-align: center;
}
.table {
width: 100%;
border-collapse: collapse;
}
.table th, .table td {
border: 1px solid #000;
padding: 8px;
text-align: center;
}
.table th {
background-color: #f2f2f2;
}
.total-row {
font-weight: bold;
}
@media print {
body {
background-color: #fff;
}
}
</style>
</head>
<body onload="window.print()">
<div class="header-print">
<img src="{{ asset('assets/img/logo.png') }}" alt="Logo Perusahaan">
<h2>Data Pembayaran</h2>
<p>Laporan Transaksi Pembayaran MostlyWeb</p>
</div>

@if(request('start_date') && request('end_date'))
<div class="filter-info">
    Data ditampilkan dari tanggal {{ request('start_date') }} sampai {{ request('end_date') }}
</div>
@endif

<div class="table">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama User</th>
                <th>Jenis Paket</th>
                <th>Sub Paket</th>
                <th>Invoice Number</th>
                <th>Status</th>
                <th>Metode Pembayaran</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pembayaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pemesanan->user->name ?? 'User Tidak Ditemukan' }}</td>
                <td>{{ $item->pemesanan->subpaket->paket->nama_paket ?? '-' }}</td>
                <td>{{ $item->pemesanan->subpaket->nama_subpaket ?? '-' }}</td>
                <td>{{ $item->pemesanan->invoice_number }}</td>
                <td>
                    @if($item->status == 'settlement')
                        Berhasil
                    @else
                        Menunggu Konfirmasi
                    @endif
                </td>
                <td>{{ $item->payment_method }}</td>
                <td>Rp{{ number_format($item->total_amount, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-end fw-bold">Total Keseluruhan:</td>
                <td class="fw-bold">Rp{{ number_format($totalPembayaran, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>