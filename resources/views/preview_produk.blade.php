@extends('setup.app')
@section('title', 'Preview Produk - MostlyWeb')

@section('content')
<div class="container my-5">
    <div class="swiper myPreviewSwiper">
        <div class="swiper-wrapper">
            @foreach($produk->previews as $index => $preview)
            <div class="swiper-slide">
                <img src="{{ asset('assets/img/' . $preview->gambar) }}" class="img-fluid" style="height:500px; width:100%; object-fit:cover;">
            </div>
            @endforeach
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <h2 class="fw-bold mt-3">{{ $produk->nama_produk }}</h2>
    <div class="mt-5">
        <h4 class="fw-bold text-dark mb-3">Fitur Dari Produk Website</h4>
        <div class="d-flex flex-wrap gap-3">
            <div class="">
                @php
                    $fitur = is_array($produk->fitur) ? $produk->fitur : json_decode($produk->fitur, true);
                @endphp
                @if (!empty($fitur))
                    @foreach ($fitur as $item)
                    <span class="badge badge-fitur px-3 py-2 fs-6 shadow-sm">
                        <i class="bi bi-check-circle me-1"></i> {{ $item }}
                    </span>
                    @endforeach
                @else
                    <p class="text-muted">Tidak ada fitur tersedia.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h4 class="fw-bold text-dark mb-3">Komponen yang Digunakan</h4>
        <div class="d-flex flex-wrap gap-3">
            @foreach($produk->logos as $logo)
            <div class="komponen-logo text-center">
                <img src="{{ asset('assets/' . $logo->gambar_logo) }}" alt="logo" class="img-thumbnail rounded p-2">
                <small class="d-block mt-2 text-muted">{{ $logo->nama_logo }}</small>
            </div>
            @endforeach
        </div>
    </div>
    <div class="text-center mt-5">
        <a href="/" class="btn btn-secondary px-4">
            Kembali
        </a>
    </div>
</div>
@endsection
