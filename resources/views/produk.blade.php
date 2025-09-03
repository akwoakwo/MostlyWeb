@extends('setup.app')
@section('title', 'Produk - MostlyWeb')

@section('content')
    <div class="container-fluid py-5">
        @if (isset($subpaket))
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="alert alert-secondary d-flex justify-content-between align-items-center" role="alert">
                        <div>
                            Anda sedang memilih desain untuk paket <b>{{ $subpaket->nama_subpaket }}</b>
                        </div>
                        <a href="{{ route('pemesanan.form', ['subpaket_id' => $subpaket->id]) }}"
                            class="btn register-btn btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Pemesanan
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Filter Kategori</h5>
                        @foreach ($kategori as $item)
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="checkbox" value="{{ $item->id }}">
                                <label class="form-check-label">{{ $item->nama_kategori }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row g-4" id="produk-list">
                    @foreach ($produk as $item)
                        <div class="col-md-6 produk-card" data-kategori="{{ $item->kategori_id }}">
                            <div class="card shadow-sm h-100">
                                <img src="{{ asset('assets/img/' . $item->gambar_produk) }}" class="card-img-top"
                                    alt="{{ $item->nama_produk }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                    @if (isset($subpaket))
                                        <a href="{{ route('preview.produk', ['id' => $item->id, 'subpaket_id' => $subpaket->id]) }}"
                                            class="btn btn-produk btn-sm">
                                            Preview
                                        </a>
                                        <a href="{{ route('pemesanan.form', ['subpaket_id' => $subpaket->id, 'produk_id' => $item->id]) }}"
                                            class="btn register-btn btn-sm">
                                            Gunakan Desain
                                        </a>
                                    @else
                                        <a href="/preview/{{ $item->id }}"
                                            class="btn btn-produk btn-sm">
                                            Preview
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
