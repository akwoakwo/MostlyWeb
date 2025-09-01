@extends('admin.setup.app')
@section('title','Sub Paket - Admin MostlyWeb')

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
                        <div class="modal fade" id="modal-baru" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Sub Paket</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form action="{{ route('paket.substore', $paket->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Nama Sub Paket</label>
                                                <input type="text" name="nama_subpaket" class="form-control @error('nama_subpaket') is-invalid @enderror">
                                                @error('nama_subpaket')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label>Harga</label>
                                                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror">
                                                @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label>Benefit</label>
                                                <div id="benefit-wrapper">
                                                    <input type="text" name="benefit[]" class="form-control mb-2" placeholder="Benefit">
                                                </div>
                                                <button type="button" class="btn btn-sm btn-primary" id="add-benefit">
                                                    + Tambah Benefit
                                                </button>
                                                @error('benefit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success shadow-none">Simpan</button>
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
                                        {{-- edit data --}}
                                        <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#edit-modal{{ $item->id }}"><i class="ti ti-pencil"></i></button>
                                        <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Sub Paket</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('paket.subupdate',$item->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="paket_id" value="{{ $paket->id }}">

                                                        <div class="modal-body">
                                                            <div class="mb-2">
                                                                <label>Nama Sub Paket</label>
                                                                <input type="text" name="nama_subpaket" class="form-control @error('nama_subpaket') is-invalid @enderror shadow-none" value="{{ $item->nama_subpaket }}">
                                                                @error('nama_subpaket')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-2">
                                                                <label>Harga</label>
                                                                <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror shadow-none" value="{{ $item->harga }}">
                                                                @error('harga')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-2">
                                                                <label>Benefit</label>
                                                                <div id="benefit-wrapper">
                                                                    @foreach($item->benefit as $i => $benefit)
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" name="benefit[]" class="form-control" value="{{ $benefit }}" placeholder="Benefit {{ $i+1 }}">
                                                                        <button type="button" class="btn btn-danger remove-benefit">Hapus</button>
                                                                    </div>
                                                                    @endforeach
                                                                    <button type="button" class="btn btn-sm btn-primary" id="add-upbenefit">
                                                                        + Tambah Benefit
                                                                    </button>
                                                                </div>

                                                                @error('benefit')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-success shadow-none">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- hapus data --}}
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
