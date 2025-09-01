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
            let maxFitur = 10;
            let wrapper = document.getElementById("fitur-wrapper");
            let addBtn = document.getElementById("add-fitur");

            addBtn.addEventListener("click", function() {
                let count = wrapper.querySelectorAll(".input-group").length;
                if (count < maxFitur) {
                    let div = document.createElement("div");
                    div.className = "input-group mb-2";
                    div.innerHTML = `
                    <input type="text" name="fitur[]" class="form-control" placeholder="Fitur ${count + 1}">
                    <button type="button" class="btn btn-danger remove-fitur">Hapus</button>
                `;
                    wrapper.appendChild(div);
                } else {
                    alert("Maksimal 10 fitur saja!");
                }
            });
        });
    </script>

    <script>
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("add-upfitur")) {
                let paketId = e.target.getAttribute("data-id");
                let wrapper = document.getElementById("fitur-wrapper-" + paketId);

                let count = wrapper.querySelectorAll(".input-group").length;
                if (count < 10) {
                    let div = document.createElement("div");
                    div.className = "input-group mb-2";
                    div.innerHTML = `
                <input type="text" name="fitur[]" class="form-control" placeholder="fitur">
                <button type="button" class="btn btn-danger remove-fitur">Hapus</button>
            `;
                    wrapper.appendChild(div);
                } else {
                    alert("Maksimal 10 fitur saja!");
                }
            }

            if (e.target.classList.contains("remove-fitur")) {
                e.target.closest(".input-group").remove();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let maxBenefit = 10;
            let wrapper = document.getElementById("benefit-wrapper");
            let addBtn = document.getElementById("add-benefit");

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
        });
    </script>

    <script>
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("add-upbenefit")) {
                let paketId = e.target.getAttribute("data-id");
                let wrapper = document.getElementById("benefit-wrapper-" + paketId);

                let count = wrapper.querySelectorAll(".input-group").length;
                if (count < 10) {
                    let div = document.createElement("div");
                    div.className = "input-group mb-2";
                    div.innerHTML = `
                <input type="text" name="benefit[]" class="form-control" placeholder="Benefit">
                <button type="button" class="btn btn-danger remove-benefit">Hapus</button>
            `;
                    wrapper.appendChild(div);
                } else {
                    alert("Maksimal 10 benefit saja!");
                }
            }

            // hapus input benefit
            if (e.target.classList.contains("remove-benefit")) {
                e.target.closest(".input-group").remove();
            }
        });
    </script>

    <script>
        document.getElementById('logoBaruBtn').addEventListener('click', function() {
            document.getElementById('formLogoBaru').style.display = 'block';
            document.getElementById('formLogoDatabase').style.display = 'none';
        });

        document.getElementById('logoDatabaseBtn').addEventListener('click', function() {
            document.getElementById('formLogoBaru').style.display = 'none';
            document.getElementById('formLogoDatabase').style.display = 'block';
        });
    </script>
</body>

</html>
