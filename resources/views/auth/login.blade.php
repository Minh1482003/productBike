<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
</head>
<body>
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form action="/authen/login" method="POST">@csrf
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example13">Email address</label>
              <input name="Email" type="email" id="form1Example13" class="form-control form-control-lg" />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example23">Password</label>
              <input name="Password" type="password" id="form1Example23" class="form-control form-control-lg" />
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
              </div>
              <a href="#!">Forgot password?</a>
            </div>

            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Sign in</button>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
            </div>

            <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
              role="button">
              <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
            </a>
            <a data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
              role="button">
              <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>

          </form>
        </div>
      </div>
    </div>
  </section>

  <div class="row">
    <div class="col-5"></div>
    <span>Bạn chưa có tài khoản ? <a href="{{ route('authen.register') }}" class="btn-sm">Đăng kí tài khoản</a></span>
  </div>
  
  <script src="{{ asset('admin/js/script.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>