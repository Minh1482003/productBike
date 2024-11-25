<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
  <!-- Nếu đang ở trang admin thì load thêm CSS và JS của admin -->
  @vite(['resources/css/admin/style.css', 'resources/js/admin/script.js'])

  <title>Document</title>
</head>
<body>
  
  <header class="header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-3">
          <div class="inner-logo">
            <a href="admin/dashhboad">Admin</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="body">
    <div class="sider">
      <div class="inner-menu">
        <ul>
          <li><a href="/admin/dashboard">Tổng quan</a></li>
          <li><a href="/admin/products">Sản phẩm</a></li>
          <li><a href="/admin/roles">Nhóm quyền</a></li>
          <li><a href="/admin/accounts">Danh sách tài khoản</a></li>
        </ul>
      </div>
    </div>

    <main>
      @yield('content')
    </main>
  </div> 

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>