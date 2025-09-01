@extends('admin.setup.app')
@section('title','Preview Produk - Admin MostlyWeb')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Preview Produk</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted " href="/paket">Data Preview Produk</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                {{ $produk->nama_produk }}
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
            <div id="carouselPreview" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($produk->previews as $key => $preview)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('assets/img/'.$preview->gambar) }}" class="d-block w-100" style="max-height:400px;object-fit:cover;">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPreview" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPreview" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <hr>

            <h5>Teknologi yang digunakan:</h5>
            <div class="d-flex gap-3 flex-wrap">
                @foreach($produk->logos as $logo)
                <div class="text-center">
                    <img src="{{ asset('assets/'.$logo->gambar_logo) }}" alt="{{ $logo->nama_logo }}" width="60">
                    <p>{{ $logo->nama_logo }}</p>
                </div>
                @endforeach
            </div>

            <hr>

            {{-- tambah data --}}
            <form action="{{ route('produk.prestore', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <div class="mb-3">
                    <label>Tambah Preview Produk</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
            </form>

            <hr>

            {{-- hapus data --}}
            <h5>Daftar Preview</h5>
            <div class="d-flex flex-wrap gap-3">
                @foreach($produk->previews as $preview)
                <div class="card" style="width: 12rem;">
                    <img src="{{ asset('assets/img/'.$preview->gambar) }}" class="card-img-top">
                    <div class="card-body text-center">
                        <form action="{{ route('produk.predestroy', $produk->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
