@extends('setup.app')
@section('title', 'Produk - MostlyWeb')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Filter Kategori</h5>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="hotel" id="filterHotel">
                        <label class="form-check-label" for="filterHotel">Website Hotel</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="bakery" id="filterBakery">
                        <label class="form-check-label" for="filterBakery">Website Bakery</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="ecommerce" id="filterEcommerce">
                        <label class="form-check-label" for="filterEcommerce">E-commerce</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" value="company" id="filterCompany">
                        <label class="form-check-label" for="filterCompany">Company Profile</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten kanan (Produk) -->
        <div class="col-md-9">
            <div class="row g-4" id="produk-list">
                <!-- Card Produk -->
                <div class="col-md-6 produk-card" data-kategori="hotel">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('assets/img/sampul_pkpri.png') }}" class="card-img-top" alt="Website Hotel">
                        <div class="card-body">
                            <h5 class="card-title">Website Hotel</h5>
                            <a href="/preview" class="btn btn-produk btn-sm">Preview</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 produk-card" data-kategori="bakery">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('assets/img/sampul_bakery.png') }}" class="card-img-top" alt="Website Bakery">
                        <div class="card-body">
                            <h5 class="card-title">Website Bakery</h5>
                            <a href="{{ url('/preview/bakery') }}" class="btn btn-produk btn-sm">Preview</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 produk-card" data-kategori="hotel">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('assets/img/sampul_pkpri.png') }}" class="card-img-top" alt="Website Hotel">
                        <div class="card-body">
                            <h5 class="card-title">Website Hotel</h5>
                            <a href="{{ url('/preview/hotel') }}" class="btn btn-produk btn-sm">Preview</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 produk-card" data-kategori="bakery">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('assets/img/sampul_bakery.png') }}" class="card-img-top" alt="Website Bakery">
                        <div class="card-body">
                            <h5 class="card-title">Website Bakery</h5>
                            <a href="{{ url('/preview/bakery') }}" class="btn btn-produk btn-sm">Preview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
