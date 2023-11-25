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
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
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
                            <form method="POST" action="{{ route('regis') }}" class="signin-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="radio" id="dosen" class="" name="status" value="dosen" required>
                                    <label class="label" for="dosen">Dosen</label>
                                    <input type="radio" id="mahasiswa" class="" name="status" value="mahasiswa" required>
                                    <label class="label" for="mahasiswa">Mahasiswa</label>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="nim_nip">Nim/Nip</label>
                                    <input type="text" name="nim_nip" class="form-control @error('nim_nip') is-invalid @enderror" placeholder="Nim/Nip" autofocus value="{{ old('nim_nip') }}" required>
                                    @error('nim_nip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"  placeholder="Username" value="{{ old('username') }}" required>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- tambai kondimen lain -->
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Email</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="konfirmasi_password">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password" required>
                                    @error('konfirmasi_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        Up</button>
                                </div>
                                <div class="form-group d-md-flex my-3">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Already have registed?? <a data-toggle="tab" href="login.html">Sign
                                    In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>