<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky-Bike</title>
    <link rel="stylesheet" href="{{ asset('assetsHome/css/sanpham.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsHome/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsHome/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsHome/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsHome/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsHome/css/xedap.css') }}">


    <link rel="icon" type="image/x-icon" href="../assest/img/logo.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assest/css/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../assest/css/main.css">
    <script src="../assest/js/sanpham.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
   
</head>

<body>
    <!-- Header -->
  <div class="bd">
    <div class="grid">
      <header class="header">
        <div class="logo">
            <a href="{{ route('home.index') }}"><img src="./assetsHome/img/logo.jpg" alt="" class="logo"></a>
        </div>
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
                    <a href="#" class="link__navbar--items">Thuê xe đạp</a>
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
              @if(isset($userData))
                <li id="infor_user"><img src="{{ $userData->Image }}" style="width: 30px">{{ $userData->Name }}</li>
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
    <!-- main -->
    <section class="recent-view container" id="recent-view-section">
      <div class="viewed-products-header">
        <h2 class="viewed-products-title">
          SẢN PHẨM
        </h2>
      </div>
      
      <div class="product-list">

        @foreach ($products as $item)
        <div class="product-item">
          <!-- Hình ảnh sản phẩm -->
          <div class="product-thumbnail">
            <img class="img-primary" src="{{ $item->Image }}">
        
            <!-- Hành động xuất hiện khi hover -->
            <div class="product-hover-actions">
              <button type="button" title="Thêm vào giỏ">
                <i class="fas fa-shopping-cart"></i>
              </button>
              <a href="#" title="Xem chi tiết">
                <i class="fas fa-eye"></i>
              </a>
            </div>
          </div>
        
          <!-- Thông tin sản phẩm -->
          <div class="product-info">
            <div class="product-name">
              <span class="watermark">Khác</span> <!-- Chữ mờ -->
              <a href="#" title="Xe đạp đường trường Ultegra">{{ $item->Name }}</a>
            </div>
        
            <!-- Đánh giá sản phẩm -->
            <div class="product-rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
        
            <!-- Giá sản phẩm -->
            <div class="product-price">
              <span class="price">{{ $item->Price }}₫</span>
              <div class="price-details">
                <span class="compare-price">44.990.000₫</span>
                <span class="discount">-28%</span>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    
    </section>
    

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

</body>

</html>