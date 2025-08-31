@extends('admin.setup.app')
@section('title','Ulasan Layanan - Admin MostlyWeb')

@section('content')

    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Ulasan Layanan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Ulasan Layanan
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
                            {{-- tambah data --}}
                            <b> {{ $data->count() }} Ulasan </b>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="editable-datatable">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                <th>Pemesanan</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <th>{{ $index+1 }}</th>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary shadow-none" data-bs-toggle="modal" data-bs-target="#modal-pemesanan{{ $item->id }}"><i class="ti ti-file-text"></i></button>
                                    <div class="modal fade" id="modal-pemesanan{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Pemesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div>
                                                            <img src="{{ asset('assets/img/'.$item->pemesanan->produk->gambar_produk) }}" alt="{{ $item->pemesanan->produk->gambar_produk }}" class="img-fluid">
                                                        </div>
                                                        <div class="mt-2">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                <tr>
                                                                        <td> Tanggal Pesan </td>
                                                                        <td> : </td>
                                                                        <td> {{ $item->pemesanan->created_at ? $item->pemesanan->created_at->translatedFormat('d F Y') : '-' }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Jenis Paket </td>
                                                                        <td> : </td>
                                                                        <td> {{ $item->pemesanan->subpaket->nama_subpaket }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Jenis Desain </td>
                                                                        <td> : </td>
                                                                        <td> be belom </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->rating == 5)
                                        ⭐⭐⭐⭐⭐
                                    @elseif ($item->rating == 4)
                                        ⭐⭐⭐⭐☆
                                    @elseif ($item->rating == 3)
                                        ⭐⭐⭐☆☆
                                    @elseif ($item->rating == 2)
                                        ⭐⭐☆☆☆
                                    @elseif ($item->rating == 1)
                                        ⭐☆☆☆☆
                                    @endif
                                </td>
                                <td>{{ $item->ulasan }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger shadow-none" data-bs-toggle="modal" data-bs-target="#hapus-modal{{ $item->id }}"><i class="ti ti-trash"></i></button>
                                    <div class="modal fade" id="hapus-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p style="color: black">Apakah anda yakin untuk menghapus ulasan dari <b>{{ $item->user->name}}</b> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Tidak</button>
                                                <form action="{{ route('ulasan.destroy',$item->id) }}" method="POST" style="display: inline;">
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