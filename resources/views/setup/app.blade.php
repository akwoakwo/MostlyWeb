<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MostlyWeb')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Navbar -->
    @include('layout.navbar')

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.querySelectorAll(".lihat-selengkapnya").forEach(btn => {
            btn.addEventListener("click", function() {
                const extra = this.nextElementSibling;
                extra.classList.toggle("d-none");
                this.querySelector("i").classList.toggle("bi-plus-circle");
                this.querySelector("i").classList.toggle("bi-dash-circle");
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const kategoriBoxes = document.querySelectorAll(".kategori-box");
            const cards = document.querySelectorAll("#produk-container .col-md-6");

            kategoriBoxes.forEach(box => {
                box.addEventListener("click", function() {
                    let kategori = this.getAttribute("data-kategori");

                    if (!kategori) return;
                    kategoriBoxes.forEach(b => b.classList.remove("active-kategori"));
                    this.classList.add("active-kategori");

                    cards.forEach(card => {
                        if (card.getAttribute("data-kategori") === kategori) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });
        });
    </script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

    <script>
        const scrollBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        };
    </script>

    <script>
        var swiper = new Swiper(".myPreviewSwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script>
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let checked = Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(cb => cb.value);
                document.querySelectorAll('.produk-card').forEach(card => {
                    let kategori = card.getAttribute('data-kategori');
                    if (checked.length === 0 || checked.includes(kategori)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
