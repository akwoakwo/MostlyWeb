@extends('admin.setup.app')
@section('title','Paket - Admin MostlyWeb')

@section('content')

    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Paket</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Data Paket
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
                        <div class="d-flex align-items-center justify-content-between m-3">
                            <b> {{ $paket->count() }} PAKET </b>

                            {{-- tambah data --}}
                            <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modal-baru">Tambah Paket Baru</button>
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
                                                    <input type="text" name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror shadow-none" value="{{ old('nama_paket') }}" >
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

                        <div class="row">
                        @if (count($paket))
                            @foreach ($paket as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">{{ $item->nama_paket }}</h5>
                                            <div class="d-flex gap-2">
                                                {{-- edit data --}}
                                                <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#edit-modal{{ $item->id }}"><i class="ti ti-pencil"></i></button>
                                                <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Nama paket</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                            <form action="{{ route('paket.update',$item->id) }}" method="post">
                                                                @method('put')
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-2">
                                                                        <label>Nama Paket</label>
                                                                        <input type="text" name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror shadow-none" value="{{ $item->nama_paket }}">
                                                                        @error('nama_paket')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
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
                                                <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-modal{{ $item->id }}"><i class="ti ti-trash"></i></button>
                                                <div class="modal fade" id="hapus-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p style="color: black">Apakah anda yakin untuk menghapus paket <b>{{ $item->nama_paket }}</b> ? <br> Jika iya, semua detail paket yang berkaitan juga akan terhapus </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                            <form action="{{ route('paket.destroy',$item->id) }}" method="POST" style="display: inline;">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="submit" value="Hapus" class="btn btn-danger shadow-none">
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {{-- detail data --}}
                                                <a href="{{ route('paket.show',$item->id) }}" class="btn btn-info"><i class="ti ti-plus"></i></a>
                                            </div>
                                        </div>
                                        <hr>
                                        <b>Daftar paket terkait :</b>
                                        <ol>
                                            @foreach ($subpaket->where('paket_id', $item->id) as $sub)
                                                <li>{{ $sub->nama_subpaket }}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="d-flex justify-content-center align-items-center text-center">
                            <p style="color: red"> Belum Ada Data </p>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
