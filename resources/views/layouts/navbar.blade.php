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
                        <a class="nav-link" href="{{ route('statistik') }}">Statistik</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorite') }}">Favorite</a>
                        </li>
                        @if(auth()->user()->status != 'admin' && auth()->user()->status != 'super_admin')
                            <li class="nav-item d-flex ps-2">
                                <i class="fa-solid fa-user m-0" style="color: #ffff; padding-top: 12px"></i>
                                <a class="nav-link" href="{{ route('profile') }}">
                                    {{ auth()->user()->username }}
                                </a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @auth
                                <form action="{{ route('logout') }}" method="POST" id="form-logout">
                                    @csrf
                                    <button type="button" class="dropdown-item" id="logout"><i class="bi bi-box-arrow-right"></i> Logout</button>
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
                            @else
                                <li><a class="dropdown-item" href="/register"><i class="fa-solid fa-user-plus"></i>Register</a></li>
                                <li><a class="dropdown-item" href="/login"><i class="bi bi-box-arrow-in-right" style="margin-right: 12px"></i>Login</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>