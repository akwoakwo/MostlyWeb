@extends('admin.setup.app')
@section('title','Paket - Admin MostlyWeb')

@section('content')

    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Data Sub Paket</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="/dashboard">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="/paket">Data Paket</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    Paket {{ $paket->nama_paket }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div>
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
                        <div class="d-flex align-items-center justify-content-end m-3">
                            {{-- tambah data --}}
                            <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modal-baru">Tambah Sub Paket Baru</button>
                            <div class="modal fade" id="modal-baru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah nama paket</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                        <form action="{{ route('paket.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label>Nama Paket</label>
                                                    <input type="text" name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror shadow-none">
                                                    @error('nama_paket') 
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div> 
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Tidak</button> 
                                                <button type="submit" class="btn btn-success shadow-none">Kirim</button> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered" id="editable-datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Benefit</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $index => $item)
                                    <tr>
                                        <th>{{ $index+1 }}</th>
                                        <td>{{ $item->nama_subpaket }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <ol>
                                                @foreach($item->benefit as $b)
                                                    <li>{{ $b }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-primary btn-sm"><i class="ti ti-pencil"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-modal{{ $item->id }}"><i class="ti ti-trash"></i></button>
                                            <div class="modal fade" id="hapus-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p style="color: black">Apakah anda yakin untuk menghapus sub-paket <b>{{ $item->nama_subpaket }}</b> </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                        <form action="" method="POST" style="display: inline;">
                                                            @method('delete')
                                                            @csrf
                                                            <input type="submit" value="Hapus" class="btn btn-danger shadow-none">
                                                        </form> 
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
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