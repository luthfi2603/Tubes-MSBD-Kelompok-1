<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Fakultas Ilmu Komputer dan Teknologi Informasi</title>
	<link rel="icon" type="image/x-icon" href="{{asset('assets/img/usu.png')}}" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('assets/css/loginregister.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    @if(session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(assets/img/loginimg.png);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4" style="font-weight: 600; font-family: 'Montserrat', sans-serif;">
                                        Sign Up</h3>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    @if(old('status') == 'mahasiswa')
                                        <input type="radio" id="dosen" name="status" value="dosen">
                                        <label class="label" for="dosen">Dosen</label>
                                        <input type="radio" id="mahasiswa" name="status" value="mahasiswa" checked>
                                        <label class="label" for="mahasiswa">Mahasiswa</label>
                                    @elseif(old('status') == 'dosen')
                                        <input type="radio" id="dosen" name="status" value="dosen" checked>
                                        <label class="label" for="dosen">Dosen</label>
                                        <input type="radio" id="mahasiswa" name="status" value="mahasiswa">
                                        <label class="label" for="mahasiswa">Mahasiswa</label>
                                    @else
                                        <input type="radio" id="dosen" name="status" value="dosen">
                                        <label class="label" for="dosen">Dosen</label>
                                        <input type="radio" id="mahasiswa" name="status" value="mahasiswa">
                                        <label class="label" for="mahasiswa">Mahasiswa</label>
                                        @error('status')
                                            <div style="color: #dc3545; font-size: 90%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="nim_nidn">NIM/NIDN</label>
                                    <input type="text" name="nim_nidn" id="nim_nidn" class="form-control @error('nim_nidn') is-invalid @enderror" placeholder="NIM/NIDN" autofocus value="{{ old('nim_nidn') }}">
                                    @error('nim_nidn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"  placeholder="Username" value="{{ old('username') }}" autocomplete="username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- tambai kondimen lain -->
                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        </div>
                                        <div class="col-1 p-0" style="padding-top: 12px !important">
                                            <i class="fa-regular fa-eye fa-xl" id="eye-password"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="konfirmasi_password">Konfirmasi Password</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password">
                                        </div>
                                        <div class="col-1 p-0" style="padding-top: 12px !important">
                                            <i class="fa-regular fa-eye fa-xl" id="eye-konfirmasi-password"></i>
                                        </div>
                                    </div>
                                    @error('konfirmasi_password')
                                        <div style="color: #dc3545; font-size: 87%; margin-top: 5px">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                                </div>
                            </form>
                            <p class="text-center">Already have registed?? <a data-toggle="tab" href="{{ route('login') }}">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-password');

        eyeIcon.addEventListener('click', () => {
            const passwordInputType = passwordInput.getAttribute('type');

            if (passwordInputType === 'password') {
                passwordInput.setAttribute('type', 'text');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }

            eyeIcon.style.right = `${passwordInput.offsetWidth - 20}px`;
        });
        
        const passwordInput2 = document.getElementById('konfirmasi_password');
        const eyeIcon2 = document.getElementById('eye-konfirmasi-password');

        eyeIcon2.addEventListener('click', () => {
            const passwordInputType2 = passwordInput2.getAttribute('type');

            if (passwordInputType2 === 'password') {
                passwordInput2.setAttribute('type', 'text');
                eyeIcon2.classList.remove('fa-eye');
                eyeIcon2.classList.add('fa-eye-slash');
            } else {
                passwordInput2.setAttribute('type', 'password');
                eyeIcon2.classList.remove('fa-eye-slash');
                eyeIcon2.classList.add('fa-eye');
            }

            eyeIcon2.style.right = `${passwordInput2.offsetWidth - 20}px`;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>