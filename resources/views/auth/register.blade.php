<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
  <title>Document</title>
  @vite('resources/css/admin/style.css')
</head>
<body>
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
<div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-8">
        <h1 class="text-center">Đăng kí tài khoản</h1>
        <form action="/authen/register" method="POST">
          @csrf
          
          <div class="form-group">
            <label for="title">Tên người dùng:</label>
            <input 
              placeholder="Không được để trống tên"
              type="text"
              class="form-control"
              id="title"
              name="Name"
              required>
          </div>

          <div class="form-group">
            <label for="username">Username:</label>
            <input
              placeholder="Bắt buộc" 
              type="username"
              class="form-control"
              id="username"
              name="Username"
              required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input 
                placeholder="Bắt buộc"
                type="email" 
                class="form-control" 
                id="email" 
                name="Email" 
                required
              >
          </div>
          
          <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input
              placeholder="Bắt buộc" 
              type="password"
              class="form-control"
              id="password"
              name="Password_1"
              required>
          </div>

          <div class="form-group">
            <label for="password">Nhập lại mật khẩu:</label>
            <input
              placeholder="Bắt buộc" 
              type="password"
              class="form-control"
              id="password"
              name="Password_2"
              required>
          </div>
       
          
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
              Đăng kí
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>  

  <div class="row">
    <div class="col-5"></div>
    <span>Bạn đã có tài khoản ? <a href="{{ route('authen.login') }}" class="btn-sm">Trở lại trang đăng nhập</a></span>
  </div>
  
  @vite('resources/js/admin/script.js')
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>