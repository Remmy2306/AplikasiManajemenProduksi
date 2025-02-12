<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Sistem</title>
  <link rel="stylesheet" href="/tamplate/template/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/tamplate/template/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="/tamplate/template/css/style.css">
  <link rel="shortcut icon" href="/tamplate/template/images/favicon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h3>Silahkan login</h3>
              @if(session()->has('loginError'))
                  {{ session('loginError') }} <br>
              @endif
              @error('email')
                {{ $message }} <br>
              @enderror
              <form class="pt-3" method="POST" action="/proses_login">
                {{ csrf_field() }}
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <input type="submit" value="Login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/tamplate/template/vendors/base/vendor.bundle.base.js"></script>
  <script src="/tamplate/template/js/off-canvas.js"></script>
  <script src="/tamplate/template/js/hoverable-collapse.js"></script>
  <script src="/tamplate/template/js/template.js"></script>
</body>
</html>
