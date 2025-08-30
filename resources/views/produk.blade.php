@extends('setup.app')
@section('title', 'Produk - MostlyWeb')

@section('content')
<div class="container-fluid py-5">
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
                            <img src="{{ asset('assets/img/' . $item->gambar_produk) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                <a href="/preview/{{ $item->id }}" class="btn btn-produk btn-sm">Preview</a>
                                <a href="{{ route('pemesanan', ['id' => request('subpaket_id'), 'produk_id' => $item->id]) }}"
                                    class="btn btn-primary btn-sm mt-2">
                                    Pilih untuk Pemesanan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>

@endsection
