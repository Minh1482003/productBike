<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
</head>
<body>
  <div class="container">
    <div class="row">

      <div class="col-4">
        <div class="card">
          <h5 class="card-header">Thông tin khách hàng</h5>
          <div class="card-body checkout-cart">

            <form action="{{ route('update.User') }}" method="POST" form-update-address>
              @csrf 
              @method('PTACH')
              <input hidden type="text" value="{{ $userData->Address }}" input-get-address>
              <div class="form-floating"> 
                <input type="email" class="form-control"
                  name="Email" value="{{ $userData->Email }}">
                <label for="floatingInputGrid">Email:</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control"
                  name="Name" value="{{ $userData->Name }}">
                <label for="floatingInputGrid">Họ và tên:</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control" 
                  name="Phone" value="{{ $userData->SDT }}">
                <label for="floatingInputGrid">Số điện thoại:</label>
              </div>
      
              <div class="form-floating">
                <select class="form-select" id="province" 
                  name="provinces" aria-label="Floating label select example">
                  <option selected option-province>---</option>
                </select>
                <label>Tỉnh thành</label>
              </div>

              <div class="form-floating">
                <select disabled class="form-select" 
                  name="district"
                  id="district" aria-label="Floating label select example">
                  <option selected option-district>---</option>
                </select>
                <label>Quận huyện</label>
              </div>
          
              <div class="form-floating">
                <select disabled class="form-select" id="wards" 
                  name="wards" aria-label="Floating label select example">
                  <option selected option-wards>---</option>
                </select>
                <label>Phường xã</label>
              </div>

              <div class="form-floating">
                <input type="text" 
                  name="addressDetail"
                  class="form-control">
                <label>Địa chỉ cụ thể:</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control" value="">
                <label for="floatingInputGrid">Ghi chú:</label>
              </div>

              <div>
                <button type="submit" class="btn btn-primary" btn-submit-adress>Cập nhật</button>
              </div>
            </form>
            
          </div>
        </div>

      </div>

      <div class="col-4">

        <div class="card">
          <h5 class="card-header border">Thông tin sản phẩm</h5>
          <div class="card-body">
            <div class="row d-flex align-items-center">
              <img src="{{$productRent->Image}}" style="width: 100px"> 
              <span class="col-8">{{$productRent->Name}}</span>
            </div>
          </div>
        </div>

        <div class="card mt-2">
          <h5 class="card-header border">Quy định khi thuê xe đạp:</h5>
          <div class="card-body">
            <div class="row d-flex align-items-center">
            <h2><span style="font-size: 14pt;"><strong>Quy định khi thu&ecirc; xe đạp:</strong></span></h2>
            <p>Qu&yacute; kh&aacute;ch h&agrave;ng đặt cọc 1 trong c&aacute;c giấy tờ tuỳ th&acirc;n như sau: Chứng minh nh&acirc;n d&acirc;n ( Identity Card); Hộ chiếu ( Passport) HOẶC Chuyển Tiền 100% gi&aacute; trị xe đạp, Khi kh&aacute;ch trả xe SHOP xe ho&agrave;n trả 100% tiền gi&aacute; trị của xe đạp</p>
            <p>Qu&yacute; kh&aacute;ch h&agrave;ng thực hiện việc đặt cọc khi&nbsp;<strong>thu&ecirc; xe đạp</strong>&nbsp;như sau:</p>
            <p><strong>&nbsp; &nbsp; &ndash; Đối với kh&aacute;ch thu&ecirc; xe&nbsp; :</strong>&nbsp;Gi&aacute; trị của xe + 100% ph&iacute; thu&ecirc; xe</p>
            <ul>
            <li>&nbsp;Nếu qu&yacute; kh&aacute;ch c&oacute; nhu cầu&nbsp;<strong>thu&ecirc; xe đạp tại &nbsp;gi&aacute; rẻ tại Đ&agrave; Nẵng</strong>&nbsp;, vui l&ograve;ng li&ecirc;n hệ theo địa chỉ sau:</li>
            <li><strong>Cửa H&agrave;ng Xe Đạp Đức Li&ecirc;n Đ&agrave; Nẵng</strong></li>
            <li><strong>Địa chỉ:&nbsp;</strong><a href="https://www.google.com/maps/place/Xe+%C4%90%E1%BA%A1p+%C4%90%E1%BB%A9c+Li%C3%AAn/@16.0672421,108.2162443,15z/data=!4m5!3m4!1s0x0:0x508b2832dc9752b8!8m2!3d16.0672421!4d108.2162443">52 Trần Kế Xương, P. Hải Ch&acirc;u 2, Q. Hải Ch&acirc;u, Tp. Đ&agrave; Nẵng</a></li>
            </ul>
            </div>
          </div>
        </div>

      </div>


      <div class="col-4">

        <div class="card">
          <h5 class="card-header">Thông tin đơn thuê</h5>
          <div class="card-body">

            <div class="py-2">
              <div class="my-2">
                <label for="datetime-input">Thời gian bắt đầu  thuê</label>
                <input type="datetime-local" class="form-control" />
              </div>

              <div class="my-2">
                <label for="datetime-input">Thời gian kết thúc thuê</label>
                <input type="datetime-local" class="form-control" />
              </div>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="checkTypeRent">
              <label class="form-check-label" for="checkTypeRent">
                Thuê theo giờ:  <span class="text-danger">{{ $productRent->Price_Hour }}</span>đ/giờ
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="checkTypeRent">
              <label class="form-check-label" for="checkTypeRent">
                Thuê theo ngày: <span class="text-danger">{{ $productRent->Price_Day }}</span>đ/ngày
              </label>
            </div>


            <div class="row py-3">
              <span class="col-7" >Tạm tính:</span>
              <span class="col-5 fs-5 text-end toltal-checkout" >50<span class="price-checkout">₫</span></span>
            </div>
            
            <div class="row justify-content-between">
              <span class="col-8 back-cart" btn-backcart><a href="{{ route('cart.product') }}">❮ Quay lại</a></span>
              <button class="col-3 btn btn-success" button-order>Đặt thuê</button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <form action="{{ route('cart.checkoutfinal') }}" method="POST" 
    from-submit-checkout>
    @csrf
    <input hidden type="number" name="toltalPrice" value="">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('client/js/script.js') }}"></script>
</body>
</html>