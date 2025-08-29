@extends('customer.setup.app')
@section('title','Riwayat Pesan - MostlyWeb')

@section('content')
<section class="p-4 col-md-9 col-lg-10">
    <h3 class="fw-bold mb-4">Riwayat Pemesanan</h3>

    <div class="card shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal Pesan</th>
                        <th>Paket</th>
                        <th>Jenis Desain</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>1</td>
                        <td>2025-08-27</td>
                        <td>Pribadi</td>
                        <td>Template</td>
                        <td><span class="badge bg-success">Lunas</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2025-08-25</td>
                        <td>Bisnis</td>
                        <td>Custom</td>
                        <td><span class="badge bg-warning text-dark">Belum Bayar</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>2025-08-20</td>
                        <td>Desain</td>
                        <td>Template</td>
                        <td><span class="badge bg-success">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
