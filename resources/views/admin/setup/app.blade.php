<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin MostlyWeb')</title>

    <link rel="stylesheet" href="{{ asset('modernize/src/assets/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.layout.sidebar')

        <div class="body-wrapper">
            @include('admin.layout.navbar')

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('modernize/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('modernize/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('modernize/src/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('modernize/src/js/dashboard.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let maxBenefit = 10;
            let wrapper = document.getElementById("benefit-wrapper");
            let addBtn = document.getElementById("add-benefit");
            let upBtn = document.getElementById("add-upbenefit");

            // Tambah benefit baru
            addBtn.addEventListener("click", function() {
                let count = wrapper.querySelectorAll(".input-group").length;
                if (count < maxBenefit) {
                    let div = document.createElement("div");
                    div.className = "input-group mb-2";
                    div.innerHTML = `
                    <input type="text" name="benefit[]" class="form-control" placeholder="Benefit ${count + 1}">
                    <button type="button" class="btn btn-danger remove-benefit">Hapus</button>
                `;
                    wrapper.appendChild(div);
                } else {
                    alert("Maksimal 10 benefit saja!");
                }
            });

            upBtn.addEventListener("click", function() {
                let count = wrapper.querySelectorAll(".input-group").length;
                if (count < maxBenefit) {
                    let div = document.createElement("div");
                    div.className = "input-group mb-2";
                    div.innerHTML = `
                    <input type="text" name="benefit[]" class="form-control" placeholder="Benefit ${count + 1}">
                    <button type="button" class="btn btn-danger remove-benefit">Hapus</button>
                `;
                    wrapper.appendChild(div);
                } else {
                    alert("Maksimal 10 benefit saja!");
                }
            });

            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("remove-benefit")) {
                    e.target.closest(".input-group").remove();
                }
            });
        });
    </script>
</body>

</html>
