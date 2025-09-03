@extends('admin.setup.app')
@section('title', 'Data Pemesanan - Admin MostlyWeb')

@section('content')

    <div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Pemesanan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Data Pemesanan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success customize-alert alert-dismissible border-success text-success fade show remove-close-icon" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center font-medium me-3 me-md-0">
                        <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger customize-alert alert-dismissible border-danger text-danger fade show remove-close-icon" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center font-medium me-3 me-md-0">
                        <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between m-3">
                        <b>{{ $pemesanan->count() }} PEMESANAN</b>
                    </div>

                    <div class="table-responsive text-center">
                        <table class="table table-striped table-bordered" id="editable-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama User</th>
                                    <th>Jenis Paket</th>
                                    <th>Sub Paket</th>
                                    <th>Invoice Number</th>
                                    <th>Total Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pemesanan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->user->name ?? 'User Tidak Ditemukan' }}</td>
                                    <td>{{ $item->subpaket->paket->nama_paket ?? '-' }}</td>
                                    <td>{{ $item->subpaket->nama_subpaket ?? '-' }}</td>
                                    <td>{{ $item->invoice_number }}</td>
                                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($item->status_pembayaran == 'success')
                                            <span class="badge bg-success">Sudah Dibayar</span>
                                        @elseif($item->status_pembayaran == 'pending')
                                            <span class="badge bg-warning">Menunggu Pembayaran</span>
                                        @else
                                            <span class="badge bg-danger">Gagal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="btn btn-primary btn-sm"> <i class="ti ti-eye"></i> Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
