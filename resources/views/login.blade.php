<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Portal</title>
  <link rel="shortcut icon" href="{{asset('../../assets/images/logo_resmi.png')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('../../assets/login/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../../assets/login/assets/css/all.min.css')}}">
  <style>
body {
  background: linear-gradient(-45deg, #0056b3, #003366, #0073e6, #001a33);
  background-size: 400% 400%;
  animation: gradientBG 12s ease infinite;
  font-family: "Open Sans", sans-serif;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.login-box {
  background: #fff;
  border-radius: 15px;
  padding: 2.5rem;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
  animation: fadeInUp 0.7s ease;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.login-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}

.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 12px rgba(0, 123, 255, 0.5);
  transition: 0.3s;
}

/* Tombol */
.btn-primary {
  border-radius: 50px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 0.6rem;
  font-size: 1rem;
  background: linear-gradient(90deg, #0056b3, #0073e6);
  border: none;
  color: white;
  position: relative;
  overflow: hidden;
  transition: background 0.4s, transform 0.2s;
}

.btn-primary:hover {
  background: linear-gradient(90deg, #004494, #0066cc);
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(0, 91, 187, 0.4);
}

.btn-primary:active {
  transform: scale(0.97);
}

.btn-primary::after {
  content: "";
  position: absolute;
  width: 0;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(255, 255, 255, 0.25);
  transition: width 0.4s ease;
}
.btn-primary:hover::after {
  width: 100%;
}

.btn-primary .spinner-border {
  width: 18px;
  height: 18px;
  visibility: hidden;
}

/* Password Eye */
#showPasswordBtn {
  background: transparent;
  border: none;
  cursor: pointer;
  color: #555;
  transition: transform 0.2s ease;
}
#showPasswordBtn:active {
  transform: scale(1.2);
}

  </style>
</head>

<body>
  <div class="login-box col-md-5">
    <div class="text-center mb-3">
      <img src="{{asset('../../assets/images/logo2.png')}}" alt="Logo" width="200">
      <h4 class="mt-2">Portal</h4>
      <p class="text-muted">Silakan login</p>
    </div>
    <form id="loginForm" method="POST" action="{{ route('loginPegawai') }}">
      @csrf
      <div class="form-group">
        <label for="userid">User ID</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-user"></i></span>
          </div>
          <input type="text" class="form-control" id="userid" name="userid" placeholder="Masukkan User ID" required>
        </div>
        <small class="text-danger d-none" id="useridError">User ID wajib diisi</small>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
          </div>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
          <div class="input-group-append">
            <button id="showPasswordBtn" type="button"><i id="eyeIcon" class="fas fa-eye-slash"></i></button>
          </div>
        </div>
        <small class="text-danger d-none" id="passwordError">Password wajib diisi</small>
      </div>

      @if($errors->has('login'))
      <div class="alert alert-danger">
        {{ $errors->first('login') }}
      </div>
      @endif

    <button type="submit" class="btn btn-primary w-100">
    <span>Login</span>
    <div class="spinner-border spinner-border-sm" role="status"></div>
    </button>


      <div class="mt-3 text-center">
        <a href="{{ url('forgot-password') }}">Lupa Password?</a>
      </div>
    </form>
  </div>

  <script src="{{asset('../../assets/login/assets/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('../../assets/login/assets/js/bootstrap.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      // Toggle Password
      $('#showPasswordBtn').on('click', function () {
        const passwordInput = $('#password');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        $('#eyeIcon').toggleClass('fa-eye fa-eye-slash');
      });

      // Validasi real-time
      $('#userid, #password').on('input', function () {
        if ($(this).val().trim() === '') {
          $(this).addClass('is-invalid');
          $(this).siblings('small').removeClass('d-none');
        } else {
          $(this).removeClass('is-invalid');
          $(this).siblings('small').addClass('d-none');
        }
      });

        // Loading spinner saat submit
        $('#loginForm').on('submit', function () {
        if ($('#userid').val().trim() === '' || $('#password').val().trim() === '') {
            return false; // stop submit
        }
        $('.spinner-border').css('visibility', 'visible'); // munculkan spinner
        $('button[type=submit]').prop('disabled', true);
        });

    });
  </script>
</body>
</html>
