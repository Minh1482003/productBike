<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự án 1</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assetsProduct/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">

    <style>
    #infor_user {
        font-size: 13px;
    }
    #infor_user img {
        width: 30px;
        padding-right: 5px;
        border-radius: 50px;
    }
    </style>
</head>
<body>
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
    <!-- Header -->
    <div class="bd">
        <div class="grid">
            <header class="header">
                <div class="logo">
                    <a href="{{ route('home.index') }}"><img src="{{ asset('assetsProduct/img/logo.jpg') }}" alt="" class="logo"></a>
                </div>
                <!-- Navbar -->
                <div class="header__navbar">
                    <ul class="navbar">
                        <li class="navbar__items">
                            <a href="#" class="link__navbar--items">Xe đạp <i class="ri-arrow-down-s-fill"></i></a>
                        
                        </li>
                        <li class="navbar__items">
                            <a href="#" class="link__navbar--items">Phụ tùng xe đạp <i class="ri-arrow-down-s-fill"></i></a>
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
                        @if(isset($userData)  )
                            <li id="infor_user"><img src="{{ $userData->Image }}">{{ $userData->Name }}</li>
                            <li id="infor_user"><a href="{{ route('authen.logout') }}" class="btn btn-danger btn-sm">Đăng xuất</a></li>
                        @else
                            <li class="icon_items">
                                <a href="{{ route('authen.login') }}" class="link_icon border mr-2 p-2 rounded"><i class="fa-solid fa-user"></i>Đăng nhập</a>
                            </li>
                            <li class="icon_items">
                                <a href="{{ route('authen.register') }}" class="link_icon border p-2 rounded"><i class="fa-solid fa-user"></i>Đăng kí</a>
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
    <div class="product-details">
        <div class="product-page">
            <p>Trang chủ / Sản phẩm nổi bật <b>/ Xe đạp đường trường Domane AL 5 đĩa</b></p>
        </div>
        <div class="product-container">
            <div class="product-images">
                <div class="images-type">
                    <img src="{{ asset('assetsProduct/img/product/img6.webp') }}" alt="" >
                    <img src="{{ asset('assetsProduct/img/product/img9.webp') }}" alt="">
                    <img src="{{ asset('assetsProduct/img/product/img10.webp') }}" alt="">
                </div>
                <div class="images-main">
                    <img src="{{ $product->Image }}" alt="Xe đạp đường trường Domane AL 5 đĩa">
                </div>
            </div>
            <div class="right-details">
                <h1 class="title">{{ $product->Name }}</h1>
                <div class="icon-star">
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                </div>
                <p>Thương hiệu: EGA Bike Mã sản phẩm: Đang cập nhật</p>
                <div class="price-details">
                    @if($product->Buy_or_rent == 'buy')
                        <span class="current-price">{{ number_format($product->Price, 0, ',', '.') . ' VND' }}</span>
                    @elseif($product->Buy_or_rent == 'rent')
                        <div class="row ml-1 fs-5">
                            <span>Gía thuê 1 ngày/ <span class="fs-4 text-danger fw-bold">{{ number_format($product->Price_day, 0, ',', '.') . ' đ' }}</span></span>
                            <span>Gía thuê 1 giờ/ <span class="fs-4 text-danger fw-bold">{{ number_format($product->Price_hour, 0, ',', '.') . ' đ' }}</span></span>
                        </div>
                    @endif
        
                </div>
                <p>(Tiết kiệm: <b class="tietkiem">12.400.000₫</b>)</p>
                <div class="quantity">
                    <h4>Số lượng:</h4>
                    <button class="btn">-</button>
                    <input type="number" value="1">
                    <button class="btn">+</button>
                </div>
                <div class="actions">
                    <button class="add-to-cart">Thuê Ngay</button> 
                </div>
            </div>
        </div>
    </div>
    <div class="mota">
        <h1>Thông tin chi tiết sản phẩm</h1>
        <hr>
        <div>{!! $product->Description !!}</div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="grid_ft">
            <div class="nav--ft">
                <ul class="list_nav--ft">
                    <li class="items__nav">
                        <a href="#" class="link_items"><img class="logo" src="{{ asset('assetsProduct/img/logo.jpg') }}" alt=""></a>
                    </li>
                    <li class="items-nav">
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('admin/js/script.js') }}"></script>

    <form action="route('rent.order', ['Id_SP' => $product->Id_SP]" method="get"></form>
</body>
</html>