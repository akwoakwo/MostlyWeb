@extends('setup.app')
@section('title', 'Preview Produk - MostlyWeb')

@section('content')
<div class="container my-5">

    <div class="swiper myPreviewSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('assets/img/preview1.png') }}" class="img-fluid" style="height:500px; width:100%; object-fit:cover;">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/img/preview2.png') }}" class="img-fluid" style="height:500px; width:100%; object-fit:cover;">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/img/preview3.png') }}" class="img-fluid" style="height:500px; width:100%; object-fit:cover;">
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <div class="swiper-pagination"></div>
    </div>

    <h2 class="fw-bold">Website Bakery</h2>

    <div class="mt-3">
        <h5>Komponen yang digunakan:</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Bahasa Pemrograman: PHP</li>
            <li class="list-group-item">Framework: Laravel</li>
            <li class="list-group-item">Frontend: Bootstrap 5</li>
            <li class="list-group-item">Database: MySQL</li>
        </ul>
    </div>

    <div class="text-center mt-5">
        <a href="/" class="btn btn-secondary px-4">
            Kembali
        </a>
    </div>

</div>

@endsection
