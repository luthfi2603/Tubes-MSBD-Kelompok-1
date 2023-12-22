<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Fakultas Ilmu Komputer dan Teknologi Informasi</title>
    <link rel="shortcut icon" href="{{asset('assets/img/usu.png')}}" type="image/x-icon">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>

<body>
    <nav class="sidebar">
        <img src="../assets/img/usu.png" class="sidebar-logo" alt="" width="50">
        <a href="#" class="logo">REPOSITORI</a>
        <a href="#" class="logo">FASILKOM-TI USU</a>
        <hr class="lines">
        <div class="menu-content">
            <li class="item">
                <a href="{{ route('karya.tulis.kelola') }}"><i class="fa-solid fa-book"></i><span>Kelola Karya Tulis</span></a>
            </li>
            <li class="item">
                <a href="{{ route('jenis.tulisan.kelola') }}"><i class="fa-solid fa-list"></i><span>Kelola Jenis Tulisan</span></a>
            </li>
            @if(auth()->user()->status == 'super_admin')
                <li class="item">
                    <a href="{{ route('pegawai.kelola') }}"><i class="fa-solid fa-circle-user"></i><span>Kelola Pegawai</span></a>
                </li>
            @endif
            <li class="item">
                <a href="{{ route('user.kelola') }}"><i class="fa-solid fa-users"></i><span>Kelola User</span></a>
            </li>
            <li class="item">
                <a href="{{ route('mahasiswa.kelola') }}"><i class="fa-regular fa-address-card"></i><span>Kelola Mahasiswa</span></a>
            </li>
            <li class="item">
                <a href="{{ route('dosen.kelola') }}"><i class="fa-solid fa-user-tie"></i><span>Kelola Dosen</span></a>
            </li>
            <li class="item">
                <a href="{{ route('bidang.ilmu.kelola') }}"><i class="fa-solid fa-book-bookmark"></i><span>Kelola Bidang Ilmu</span></a>
            </li>
            <li class="item">
                <a href="{{ route('kata.kunci.kelola') }}"><i class="fa-solid fa-spell-check"></i><span>Kelola Kata Kunci</span></a>
            </li>
            <li class="item">
                <a href="{{ route('ebook.kelola') }}"><i class="fa-solid fa-file-pdf"></i><span>Kelola E-Book</span></a>
            </li>
            @if(auth()->user()->status == 'super_admin')
                <li class="item">
                    <a href="{{ route('log') }}"><i class="fa-solid fa-scroll"></i><span>Log</span></a>
                </li>
            @endif
            <li class="item">
                <form action="{{ route('logout') }}" method="POST" id="form-logout">
                    @csrf
                    <button type="button" class="button-like-link" id="logout"><i class="bi bi-box-arrow-right"></i>  Logout</button>
                </form>
                <script>
                    document.getElementById('logout').addEventListener('click', () => {
                        Swal.fire({
                            icon: "question",
                            title: "Apakah kamu yakin untuk logout?",
                            showCancelButton: true,
                            confirmButtonColor: "#006633",
                            cancelButtonColor: "#6b6767",
                            confirmButtonText: "Logout"
                        }).then((result) => {
                            if(result.isConfirmed){
                                document.getElementById('form-logout').submit()
                            }else{
                                return false;
                            }
                        });
                    });
                </script>
            </li>
        </div>
    </nav>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbarbrand justify-content-start">
                <div class="d-flex items-center">
                    <div class="brand me-3">
                        <img src="{{ asset('assets/img/usu.png') }}" alt="" width="50">
                    </div>
                    <div class="py-2">
                        <h6 class="d-none d-md-block" style="font-weight: 600;">REPOSITORI UNIVERSITAS SUMATERA UTARA</h6>
                        <p class="d-none d-md-block" style="font-weight: 500; font-size: 80%;">FAKULTAS ILMU KOMPUTER DAN TEKNOLOGI INFORMASI</p>
                        <h6 class="d-block d-md-none" style="font-weight: 600;">REPOSITORI USU</h6>
                        <p class="d-block d-md-none" style="font-weight: 500; font-size: 80%;">FASILKOM-TI</p>
                    </div>
                </div>
            </div>
            <div class="navbar-left justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if(auth()->user()->status == 'admin')
                                <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                            @else
                                <a class="nav-link" href="{{ route('super.admin.home') }}">Home</a>
                            @endif
                        </li>
                        <li class="nav-item d-flex ps-2">
                            <i class="fa-solid fa-user m-0" style="color: #ffff; padding-top: 12px"></i>
                            <span class="nav-link">
                                {{ auth()->user()->username }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <i class="fa-solid fa-bars" id="sidebar-close"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- main -->
    <div class="main">
        @yield('container')
    </div>

    <!-- Footer-->
    <footer class="footer py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#">About</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#">Contact</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#">Terms of Use</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#">Privacy Policy</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; Fasilkom-TI, 2023. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- include javascript -->
    <script>
        // js nya sidebar
        const sidebar = document.querySelector(".sidebar");
        const sidebarClose = document.querySelector("#sidebar-close");
        const menu = document.querySelector(".menu-content");
        const menuItems = document.querySelectorAll(".submenu-item");
        const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

        sidebarClose.addEventListener("click", () => {
            sidebar.classList.toggle("close");

            if(document.getElementsByClassName('col-lg-4').length != 0){
                const elements = document.getElementsByClassName('fa-xmark');

                if(elements[0].style.left === '45.4%'){
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.left = '37.7%';
                    }
                }else{
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.left = '45.4%';
                    }
                }
            }
        });

        menuItems.forEach((item, index) => {
            item.addEventListener("click", () => {
                menu.classList.add("submenu-active");
                item.classList.add("show-submenu");
                menuItems.forEach((item2, index2) => {
                    if (index !== index2) {
                        item2.classList.remove("show-submenu");
                    }
                });
            });
        });

        subMenuTitles.forEach((title) => {
            title.addEventListener("click", () => {
                menu.classList.remove("submenu-active");
            });
        });
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>