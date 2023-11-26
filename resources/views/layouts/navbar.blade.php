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
                        @auth
                            @if(auth()->user()->status == 'admin')
                                <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                            @elseif(auth()->user()->status == 'super_admin')
                                <a class="nav-link" href="{{ route('super.admin.home') }}">Home</a>
                            @else
                                <a class="nav-link" href="/">Home</a>
                            @endif
                        @else
                            <a class="nav-link" href="/">Home</a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/statistik">Statistik</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">
                                <i class="fa-solid fa-user" style="color: #ffff;"></i>
                            </a>
                        </li>
                    @endauth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Apakah kamu yakin?')" type="submit" class="dropdown-item">Logout</button>
                                </form>
                            @else
                                <li><a class="dropdown-item" href="/register">Register</a></li>
                                <li><a class="dropdown-item" href="/login">Login</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>