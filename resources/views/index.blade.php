@extends('setup.app')
@section('title', 'Home - MostlyWeb')

@section('content')
<section id="home" class="py-5 mb-0">
    <div class="container home-container p-5">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6 mb-4 mb-md-0 text-center text-md-start">
                <h1 class="fw-bold">Jasa Pembuatan Website Profesional</h1>
                <p class="mt-3">
                    Kami menyediakan layanan pembuatan website modern, responsif, dan sesuai kebutuhan bisnis Anda.
                    Dengan desain menarik dan performa optimal, website Anda siap bersaing di era digital.
                </p>
                <a href="#kontak" class="btn home-button fw-semibold mt-3">Konsultasi</a>
            </div>

            <div class="col-lg-6 col-md-6 text-center">
                <img src="{{ asset('assets/img/homepage.png') }}" class="img-fluid rounded">
            </div>

        </div>
    </div>
</section>

<section class="tools-section py-4 mt-0">
    <div class="slider">
        <div class="slide-track">
            <div class="slide"><img src="{{ asset('assets/img/logo/html.png') }}" alt="HTML"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/css.png') }}" alt="CSS"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/javascript.png') }}" alt="JS"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/bootstrap.png') }}" alt="Bootstrap"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/laravel.png') }}" alt="Laravel"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/php.png') }}" alt="PHP"></div>

            <div class="slide"><img src="{{ asset('assets/img/logo/html.png') }}" alt="HTML"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/css.png') }}" alt="CSS"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/javascript.png') }}" alt="JS"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/bootstrap.png') }}" alt="Bootstrap"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/laravel.png') }}" alt="Laravel"></div>
            <div class="slide"><img src="{{ asset('assets/img/logo/php.png') }}" alt="PHP"></div>
        </div>
    </div>
</section>

<section id="profil" class="profil-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Mengapa <span class="text-most">Mostly</span><span class="text-web">Web</span>?</h1>
            <p class="text-muted">Kami hadir untuk memberikan solusi digital terbaik dengan desain modern, performa optimal, dan teknologi terbaru.</p>
        </div>

        <div class="row g-4 align-items-stretch">
            <div class="col-12">
                <div class="p-4 shadow rounded d-flex flex-column flex-md-row align-items-center profil-card1">
                    <div class="mb-3 mb-md-0 text-center me-md-3 profil-img1">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo MostlyWeb">
                    </div>
                    <div class="text-center text-md-start profil-desc">
                        <p class="mb-0">
                            MostlyWeb adalah penyedia jasa pembuatan website profesional yang berfokus pada solusi digital modern
                            untuk mendukung pertumbuhan bisnis di berbagai sektor. Kami menghadirkan desain yang elegan, responsif,
                            serta ramah pengguna sehingga website dapat diakses dengan optimal di berbagai perangkat, baik desktop
                            maupun mobile. Selain itu, tim kami selalu mengutamakan performa, kecepatan, serta keamanan website
                            agar dapat memberikan pengalaman terbaik bagi pelanggan Anda. Dengan layanan yang fleksibel dan harga
                            yang kompetitif, MostlyWeb siap menjadi mitra strategis dalam mewujudkan kehadiran digital bisnis Anda
                            secara profesional dan terpercaya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row profil-baris row-cols-1 row-cols-sm-2 g-4 h-100 w-100">
                    <div class="col d-flex justify-content-center">
                        <div class="p-4 shadow rounded text-center profil-card2">
                            <img src="{{ asset('assets/img/profil-section1.png') }}" alt="Benefit 1" class="img-fluid mb-3 profil-img2">
                            <h5 class="fw-bold">Desain Modern</h5>
                            <p class="text-muted">Website dengan desain profesional & menarik sesuai trend.</p>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-center">
                        <div class="p-4 shadow rounded text-center profil-card3">
                            <img src="{{ asset('assets/img/profil-section2.png') }}" alt="Benefit 2" class="img-fluid mb-3 profil-img3">
                            <h5 class="fw-bold">Dipercaya Banyak Customer</h5>
                            <p class="text-muted">Telah melayani ratusan customer dari berbagai industri dan kebutuhan.</p>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-center">
                        <div class="p-4 shadow rounded text-center profil-card4">
                            <img src="{{ asset('assets/img/profil-section3.png') }}" alt="Benefit 3" class="img-fluid mb-3 profil-img4">
                            <h5 class="fw-bold">Banyak Pilihan Desain</h5>
                            <p class="text-muted">Tersedia berbagai template website siap pakai yang dapat disesuaikan.</p>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-center">
                        <div class="p-4 shadow rounded text-center profil-card5">
                            <img src="{{ asset('assets/img/profil-section4.png') }}" alt="Benefit 4" class="img-fluid mb-3 profil-img5">
                            <h5 class="fw-bold">Support & Maintenance</h5>
                            <p class="text-muted">Kami siap membantu & memberikan layanan purna jual.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="shadow rounded d-flex flex-column justify-content-between profil-card6">
                    <div class="p-4">
                        <h5 class="fw-bold mt-4">Responsive di Semua Perangkat</h5>
                        <p class="text-muted">
                            Website yang kami buat dapat dibuka dengan baik di desktop, tablet, maupun smartphone
                            tanpa mengurangi kualitas tampilan maupun fungsi.
                        </p>
                    </div>
                    <div class="text-center p-4 profil-img6">
                        <img src="{{ asset('assets/img/profil-section5.png') }}" alt="Responsive Phone" class="img-fluid" style="max-height: 250px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="layanan" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Layanan <span class="text-most">Mostly</span><span class="text-web">Web</span></h1>
            <p class="text-muted">
                Kami menyediakan berbagai layanan profesional untuk membantu bisnis Anda berkembang di dunia digital.
            </p>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h1 class="fw-bold">Solusi Digital Bisnis Anda</h1>
                <p>
                    Dengan pengalaman di bidang teknologi informasi dan desain, MostlyWeb
                    menghadirkan layanan pembuatan website yang tidak hanya menarik secara visual,
                    tetapi juga dioptimalkan untuk performa tinggi. Kami percaya bahwa website
                    adalah identitas digital yang penting bagi setiap bisnis.
                </p>
                <p>
                    Selain itu, kami juga menyediakan dukungan penuh mulai dari hosting,
                    pengelolaan server, hingga desain UI/UX modern yang ramah pengguna.
                    Semua layanan kami dirancang untuk memberikan pengalaman terbaik
                    kepada pelanggan Anda.
                </p>
            </div>

            <div class="col-md-6">
                <div class="accordion accordion-flush" id="accordionLayanan">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#layanan1" aria-expanded="true" aria-controls="layanan1">
                                Pembuatan Website
                            </button>
                        </h2>
                        <div id="layanan1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionLayanan">
                            <div class="accordion-body">
                                Kami membangun website modern, responsif, dan SEO friendly untuk mendukung pertumbuhan bisnis Anda.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#layanan2" aria-expanded="false" aria-controls="layanan2">
                                Hosting & Server
                            </button>
                        </h2>
                        <div id="layanan2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionLayanan">
                            <div class="accordion-body">
                                Layanan hosting cepat, aman, dan stabil untuk menjaga website Anda selalu online tanpa hambatan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#layanan3" aria-expanded="false" aria-controls="layanan3">
                                Desain UI/UX
                            </button>
                        </h2>
                        <div id="layanan3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionLayanan">
                            <div class="accordion-body">
                                Desain antarmuka modern yang menarik dan mudah digunakan untuk meningkatkan pengalaman pengguna.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#layanan4" aria-expanded="false" aria-controls="layanan4">
                                Maintenance & Support
                            </button>
                        </h2>
                        <div id="layanan4" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionLayanan">
                            <div class="accordion-body">
                                Dukungan teknis dan pemeliharaan rutin agar website Anda tetap optimal dan bebas dari masalah.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4 mt-4">
            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                @foreach ($paket as $item)
                    <li class="nav-item">
                        <button
                            class="nav-link nav-paket {{ $loop->first ? 'active' : '' }}" id="pills-{{ $item->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $item->id }}"
                            type="button" aria-controls="pills-{{ $item->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">Paket {{ $item->nama_paket }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            @foreach ($paket as $item)
                <div class="tab-pane fade show {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $item->id }}" aria-labelledby="pills-{{ $item->id }}-tab">>
                    <div class="row g-4">
                        @foreach ($subpaket->where('paket_id', $item->id) as $sub)
                            <div class="col-md-4">
                                <div class="card shadow h-100 p-3">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary fw-bold">{{ $sub->nama_subpaket }}</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <h1 class="text-black m-0 mt-2">Rp {{ number_format($sub->harga, 0, ',', '.') }}</h1>
                                        </div>
                                        <button class="btn btn-paket w-100 my-3">Pesan Sekarang</button>

                                        @php
                                            $benefits = is_array($sub->benefit) ? $sub->benefit : json_decode($sub->benefit, true);
                                            $mainBenefits = array_slice($benefits, 0, 4);
                                            $extraBenefits = array_slice($benefits, 4);
                                        @endphp

                                        <ul class="list-unstyled">
                                            @foreach ($mainBenefits as $benefit)
                                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $benefit }}</li>
                                            @endforeach

                                        </ul>

                                        @if (count($extraBenefits) > 0)
                                            <hr class="my-3">
                                            <p class="text-primary lihat-selengkapnya" style="cursor:pointer;">
                                                Lihat selengkapnya <i class="bi bi-plus-circle"></i>
                                            </p>
                                            <div class="extra-benefit d-none">
                                                <ul class="list-unstyled">
                                                    @foreach ($extraBenefits as $benefit)
                                                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $benefit }}</li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
</section>

<section id="produk" class="produk py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Produk Website <span class="text-most">Mostly</span><span class="text-web">Web</span></h2>
            <p class="text-muted">Beberapa desain website yang telah kami bangun dan dapat dijadikan referensi untuk custom website sesuai kebutuhan Anda.</p>
        </div>

        <div class="d-flex justify-content-center flex-wrap mb-5 gap-3">
            <div class="kategori-box text-center" data-kategori="hotel">Hotel</div>
            <div class="kategori-box text-center" data-kategori="bakery">Bakery</div>
            <div class="kategori-box text-center" data-kategori="rental">Rental</div>
            <div class="kategori-box text-center" data-kategori="ecommerce">E-Commerce</div>
            <div class="kategori-box text-center" data-kategori="travel">Travel</div>
            <div class="kategori-box text-center" data-kategori="portfolio">Portfolio</div>
            <div class="kategori-box text-center bg-dark text-white" onclick="window.location.href='/produk'">Selengkapnya</div>
        </div>

        <div id="produk-container" class="row g-4 justify-content-center">
            <div class="col-md-6 mb-3" data-kategori="hotel">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/img/sampul_pkpri.png') }}" class="card-img-top" alt="Website Bakery">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Website Hotel</h5>
                        <a href="#" class="btn btn-produk btn-sm">Preview</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-kategori="hotel">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/img/sampul_pkpri.png') }}" class="card-img-top" alt="Website Bakery">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Website Hotel</h5>
                        <a href="#" class="btn btn-produk btn-sm">Preview</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="produk-container" class="row g-4 justify-content-center">
            <div class="col-md-6" data-kategori="bakery">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/img/sampul_bakery.png') }}" class="card-img-top" alt="Website Bakery">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Website Bakery</h5>
                        <a href="/preview" class="btn btn-produk btn-sm">Preview</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-kategori="bakery">
                <div class="card shadow-sm">
                    <img src="{{ asset('assets/img/sampul_bakery.png') }}" class="card-img-top" alt="Website Bakery">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Website Bakery</h5>
                        <a href="#" class="btn btn-produk btn-sm">Preview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="testimoni" class="py-5">
    <div class="container text-center mb-4">
        <h2 class="fw-bold">Apa Kata Mereka Tentang <span class="text-most">Mostly</span><span class="text-web">Web</span>?</h2>
        <p class="text-muted">Testimoni dari customer yang sudah menggunakan jasa pembuatan website kami.</p>
    </div>

    <div class="container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Website toko online saya jadi lebih profesional dan pelanggan semakin mudah berbelanja. Terima kasih!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 1">
                            <h6 class="mb-0">Andi Pratama</h6>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐☆
                        </div>
                        <p>"Pelayanan cepat, hasil desain website menarik dan sesuai dengan kebutuhan bisnis saya."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 2">
                            <h6 class="mb-0">Siti Nurhaliza</h6>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Layanan sangat memuaskan, website perusahaan kami terlihat lebih modern dan responsif."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 3">
                            <h6 class="mb-0">Budi Santoso</h6>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐☆
                        </div>
                        <p>"Harga terjangkau dengan kualitas website yang sangat bagus. Rekomendasi banget!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 4">
                            <h6 class="mb-0">Dewi Lestari</h6>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Website toko online saya jadi lebih profesional dan pelanggan semakin mudah berbelanja. Terima kasih!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 1">
                            <h6 class="mb-0">Andi Pratama</h6>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow-sm p-3">
                        <div class="mb-2 text-warning">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Website toko online saya jadi lebih profesional dan pelanggan semakin mudah berbelanja. Terima kasih!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Customer 1">
                            <h6 class="mb-0">Andi Pratama</h6>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination mt-3"></div>
        </div>
    </div>
</section>

<section id="kontak" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pertanyaan yang Sering Diajukan Kepada <span class="text-most">Mostly</span><span class="text-web">Web</span></h2>
            <p class="text-muted">Beberapa pertanyaan umum yang sering diajukan customer terkait layanan pembuatan website kami.</p>
        </div>

        <div class="accordion" id="faqAccordion">
            <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span class="me-2 fw-bold">Berapa lama proses pembuatan website?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Rata-rata pembuatan website membutuhkan waktu antara 2 hingga 4 minggu, tergantung kompleksitas dan fitur yang diminta.
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="me-2 fw-bold">Apakah website bisa diakses di semua perangkat?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ya, semua website yang kami buat bersifat responsif sehingga dapat diakses dengan baik melalui komputer, tablet, maupun smartphone.
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="me-2 fw-bold">Apakah ada layanan maintenance setelah website selesai dibuat?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Tentu, kami menyediakan layanan maintenance berkala sesuai dengan kebutuhan Anda.
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span class="me-2 fw-bold">Apakah saya bisa melakukan kustomisasi desain website?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ya, Anda bebas melakukan kustomisasi desain sesuai preferensi, kami akan membantu mewujudkan ide Anda.
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <span class="me-2 fw-bold">Apakah biaya sudah termasuk domain dan hosting?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Biaya pembuatan website sudah termasuk domain dan hosting tahun pertama, selanjutnya bisa diperpanjang sesuai kebutuhan.
                    </div>
                </div>
            </div>
        </div>

        <div class="container-konsultasi mt-5 p-5 text-white rounded shadow text-center">
            <h3 class="fw-bold mb-3">Masih Ragu? Konsultasi Gratis Sekarang!</h3>
            <p class="mb-4">Diskusikan kebutuhan website Anda bersama tim kami dan temukan solusi terbaik untuk bisnis Anda.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                    <i class="bi bi-whatsapp me-2"></i> WhatsApp
                </a>
                <a href="mailto:emailanda@gmail.com" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                    <i class="bi bi-envelope-fill me-2"></i> Gmail
                </a>
                <a href="https://instagram.com/username" target="_blank" class="btn btn-light btn-konsultasi px-4 py-2 fw-semibold">
                    <i class="bi bi-instagram me-2"></i> Instagram
                </a>
            </div>
        </div>
    </div>
</section>

<a href="#home" class="scroll-to-top" id="scrollTopBtn">
  <i class="bi bi-arrow-up"></i>
</a>
@endsection
