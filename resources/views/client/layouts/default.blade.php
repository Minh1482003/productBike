<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Meta tag viewport cho responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsHome/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsHome/css/sanpham.css') }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- End trang chủ -->
</head>

<style>
  #infor_user {
    font-size: 13px;
  }
  #infor_user img {
    width: 30px;
    padding-right: 5px;
    border-radius: 50px;
  }

    
  /* Show Alert */
  [show-alert] {
    position: fixed;
    top: 70px;
    right: 15px;
    z-index: 9999;
  }

  [show-alert].alert-hidden {
    animation-name: alert-hidden;
    animation-duration: 0.5s;
    animation-fill-mode: both;
  }

  @keyframes alert-hidden {
    from {
      right: 10%;
    }
    to {
      right: 30%;
    }
    to {
      right:-80%;
    }
    to {
      right: -100%;
      display: none;
    }
  }

  [show-alert] [close-alert] {
    background: #ffffffc4;
    display: inline-block;
    width: 24px;
    height: 24px;
    line-height: 24px;
    text-align: center;
    font-weight: 600;
    border-radius: 50%;
    cursor: pointer;
  }
/* End Show Alert */
</style>

<body>
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 5000])
  <!-- Header -->
  <div class="bd">
    <div class="grid">
      <header class="header">
        <div class="logo">
            <a href="{{ route('home.index') }}"><img src="./assetsHome/img/logo.jpg" alt="" class="logo"></a>
        </div>

        <style>
          .header__navbar ul li a,
          .nav--ft ul li a  {
            font-size: 22px;
            line-height: 1.6rem;
          }
        </style>

        <!-- Navbar -->
        <div class="header__navbar">
          <ul class="navbar">
            <li class="navbar__items">
                <a href="{{ route('product.buy') }}" class="link__navbar--items">Xe đạp</a>
              </li>
                <li class="navbar__items">
                  <a href="#" class="link__navbar--items">Phụ tùng xe đạp</a>
                </li>
                <li class="navbar__items">
                    <a href="{{ route('product.rent') }}" class="link__navbar--items">Thuê xe đạp</a>
                </li>
                <li class="navbar__items">
                    <a href="#" class="link__navbar--items">Liên hệ</a>
                </li>
            </ul>
            <!-- Icon -->
          </div>
          <div class="icon">
            <ul class="icon_admin">
              <li class="icon_items">
                  <a href="#" class="link_icon"><i class="fa-solid fa-magnifying-glass"></i></a>
              </li>
              @if(isset($userData)  )
                <li id="infor_user"><img src="{{ $userData->Image }}">{{ $userData->Name }}</li>
                <li id="infor_user"><a href="{{ route('authen.logout') }}" class="btn btn-danger btn-sm">Đăng xuất</a></li>
              @else
                <li class="icon_items">
                    <a href="{{ route('authen.login') }}" class="link_icon border mr-2 p-2 rounded"></i>Đăng nhập</a>
                </li>
                <li class="icon_items">
                    <a href="{{ route('authen.register') }}" class="link_icon border p-2 rounded"></i>Đăng kí</a>
                </li>
              @endif
              <li class="icon_items">
                  <a href="{{ route('cart.product') }}" class="link_icon"><i class="ri-shopping-cart-fill"></i></a>
              </li>
            </ul>
          </div>
      </header>
    </div>
  </div>


  <div class="main">
    @yield('content')
  </div>


  <!-- Footer -->
  <footer class="footer" style="font-size: 62.5%; 
        line-height: 1.6rem; 
        font-family: 'Roboto', sans-serif; 
        box-sizing: border-box;">>
    <div class="grid_ft">
      <div class="nav--ft">
        <ul class="list_nav--ft">
          <li class="items__nav">
            <a href="#" class="link_items"><img class="logo" src="./assetsHome/img/logo.jpg" alt=""></a>
          </li>
          <li class="main_items-nav">
            <p>Cửa hàng xe đạp Sky</p>
          </li>
          <li class="items__nav">
            <p class="link_items para">Cửa hàng uy tín và chất lượng, <br> cam kết mang đến những trải
                  nghiệm <br> mua sắm tiện lợi và hiện đại</p>
          </li>
          <li class="items__nav">
            <p class="link_items">Mã số thuế: 12345678999</p>
          </li>
          <li class="items__nav">
            <p class="link_items"><i class="fa-solid fa-location-dot"></i> Địa chỉ: 05 Me Linh, Orri Garden,
                  Da Nang City</p>
          </li>
          <li class="items__nav">
            <p class="link_items"><i class="fa-solid fa-mobile"></i> Số điện thoại: 0947226778</p>
          </li>
          <li class="items__nav">
            <p class="link_items"><i class="fa-solid fa-envelope"></i> Email: theteam123@gmail.com</p>
          </li>
        </ul>
        <ul class="list_nav--ft">
          <li class="items__nav">
            <p class="main_items-nav mg1">Hỗ trợ khách hàng</p>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv">Cửa hàng</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Giới thiệu</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Liên hệ</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Câu hỏi thường gặp</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Khuyến mãi Combo</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Khuyến mãi Mua X tặng Y</a>
          </li>
        </ul>
        <ul class="list_nav--ft">
          <li class="items__nav">
            <p class="main_items-nav mg1">Chính sách</p>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: 10px;">Chính sách giao hàng</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Điều khoản dịch vụ</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Chính sách bảo mật</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Chính sách đổi trả</a>
          </li>
          <li class="items__nav">
            <a href="#" class="link_items hv" style="margin-top: -30px;">Chương trình cộng tác viên</a>
          </li>
        </ul>
        <ul class="list_nav--ft">
          <li class="items__nav">
            <p class="main_items-nav mg1">Đăng ký nhận tin</p>
          </li>
          <li class="items__nav">
            <p class="link_items" style="line-height: 1.5; margin: 20px 0px;">Bạn muốn nhận khuyến mãi đặc
                  biệt? <br> Đăng ký ngay.</p>
          </li>
          <li class="items__nav">
            <form action="">
              <input type="email" placeholder="Nhập địa chỉ email"
                  style="flex: 1; padding: 10px; border: none; border-radius: 10px 0 0 10px; outline: none;" />
              <button
                  style="padding: 10px; border: none; background-color: #000; color: #fff; border-radius: 0 10px 10px 0; cursor: pointer;">
                  Đăng ký
              </button>
            </form>
          </li>
          <li class="items__nav icon--ft">
            <a href="#" class="link_items"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="link_items"><i class="fa-brands fa-square-instagram"></i></a>
            <a href="#" class="link_items"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="link_items"><i class="fa-brands fa-tiktok"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </footer>

  <script src="{{ asset('client/js/script.js') }}"></script>
  <script src="./assetsHome/js/main.js"></script>
  <script src="../Sanpham/assest/js/sanpham.js"></script>
  <script src="{{ asset('admin/js/script.js') }}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
  