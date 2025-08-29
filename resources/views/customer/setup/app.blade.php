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

<body class="page-customer">

    <button id="sidebarToggle" class="btn d-md-none">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            @include('customer.layout.sidebar')

            <!-- Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('customer.layout.footer')
        </div>
    </div>

    <div id="sidebarOverlay" class="sidebar-overlay d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.style.transform = 'translateX(0)';
            overlay.classList.remove('d-none');
        }

        function closeSidebar() {
            sidebar.style.transform = 'translateX(-100%)';
            overlay.classList.add('d-none');
        }

        toggleBtn.addEventListener('click', () => {
            if (sidebar.style.transform === 'translateX(0px)') {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);
    </script>

    <script>
        // Preview gambar profil saat dipilih
        const profileImage = document.getElementById('profileImage');
        const previewImage = document.getElementById('previewImage');

        profileImage.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
            }
        });
    </script>

    <script>
        document.getElementById('profileImage').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>

</html>
