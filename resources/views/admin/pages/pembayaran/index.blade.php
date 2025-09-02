@extends('admin.setup.app')
@section('title', 'Data Pembayaran - Admin MostlyWeb')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Pembayaran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Data Pembayaran
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" class="d-flex align-items-center mb-4" action="{{ route('admin.pembayaran.index') }}" method="GET">
                        <div class="me-3">
                            <label for="startDate" class="form-label">Tanggal Mulai:</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="me-3">
                            <label for="endDate" class="form-label">Tanggal Selesai:</label>
                            <input type="date" class="form-control" id="endDate" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <button type="submit" id="filterBtn" class="btn btn-primary mt-4 me-2">
                            <i class="ti ti-filter"></i> Filter
                        </button>
                        <a href="{{ route('admin.pembayaran.index') }}" id="resetBtn" class="btn btn-secondary mt-4" style="display: none;">
                            <i class="ti ti-reload"></i> Reset
                        </a>
                    </form>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <b>{{ $pembayaran->count() }} PEMBAYARAN BERHASIL</b>
                        <a id="printBtn" class="btn btn-success shadow-none" href="{{ route('admin.pembayaran.cetak', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank">
                            <i class="ti ti-printer"></i> Cetak Data
                        </a>
                    </div>
                    <div class="table-responsive text-center">
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
                                            <span class="badge bg-success">Berhasil</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu Konfirmasi</span>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const filterBtn = document.getElementById('filterBtn');
        const resetBtn = document.getElementById('resetBtn');

        if (startDateInput.value || endDateInput.value) {
            resetBtn.style.display = 'block';
            filterBtn.style.display = 'none';
        } else {
            resetBtn.style.display = 'none';
            filterBtn.style.display = 'block';
        }
    });
</script>

@endsection