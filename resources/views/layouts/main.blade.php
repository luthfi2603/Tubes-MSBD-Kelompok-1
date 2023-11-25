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
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbarbrand justify-content-start">
                <div class="d-flex items-center">
                    <div class="brand me-3">
                        <img src="{{ asset('assets/img/usu.png') }}" alt="" width="50">
                    </div>
                    <div class="py-2">
                        <h6 class="d-none d-md-block" style="font-weight: 600;">REPOSITORI UNIVERSITAS SUMATERA UTARA
                        </h6>
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
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/statistik">Statistik</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user" style="color: #ffff;"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/register2">Register</a></li>
                                <li><a class="dropdown-item" href="login.html">Login</a></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bagian Search -->
    <div class="container-fluid" style="background-image: url(assets/img/Gedung-A.png)">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9">
                <div class="cardbi p-4 mt-0">
                    <h2 class="heading mt-3 text-center" style="font-weight: 600; color: #ffff;">REPOSITORI FASILKOM TI</h2>
                    <div class="d-flex justify-content-center px-5">
                        <div class="search">
                            <input type="text" class="search-input" style="font-weight: 500; color: #130D19;" placeholder="Search..." name="">
                            <button href="#" class="search-icon">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="search-advanced text-center mt-3">
                        <a href="/advanced-search" class="btn btn-success" style="font-weight: 600;">Pencarian lanjutan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main -->
    @yield('container')

    <!-- Footer-->
    <footer class="footer py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#!">About</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#!">Contact</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#!">Terms of Use</a></li>
                        <li class="list-inline-item"><a style="font-weight: 600; color: #ffff;" href="#!">Privacy Policy</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; Fasilkom-TI, 2023. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- include javascript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>