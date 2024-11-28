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
          <h5 class="card-header">Thông tin nhận hàng</h5>
          <div class="card-body checkout-cart">

            <form action="{{ route('update.User') }}" method="POST" form-update-address>
              @csrf 
              @method('PTACH')
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
                  name="SDT" value="{{ $userData->SDT }}">
                <label for="floatingInputGrid">Số điện thoại:</label>
              </div>
      
              <div class="form-floating">
                <select class="form-select" id="province" 
                  name="provinces" aria-label="Floating label select example">
                  <option selected>---</option>
                </select>
                <label>Tỉnh thành</label>
              </div>

              <div class="form-floating">
                <select disabled class="form-select" 
                  name="district"
                  id="district" aria-label="Floating label select example">
                  <option selected>---</option>
                </select>
                <label>Quận huyện</label>
              </div>
          
              <div class="form-floating">
                <select disabled class="form-select" id="wards" 
                  name="wards" aria-label="Floating label select example">
                  <option selected>---</option>
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
          <h5 class="card-header border">Hình thức thanh toán</h5>
          <div class="card-body">
            <div class="form-check border rounded py-2 my-2">
              <input class="form-check-input mx-1" type="radio" name="checkPay">
              <label class="form-check-label">Chuyển khoản</label>
            </div>
            <div class="form-check border rounded py-2 my-2">
              <input class="form-check-input mx-1" type="radio" name="checkPay">
              <label class="form-check-label">Thanh toán khi nhận hàng</label>
            </div>
          </div>
        </div>

      </div>


      <div class="col-4">

        <div class="card">
          <h5 class="card-header">Thông tin đơn hàng</h5>
          <div class="card-body">
            
            @foreach($productCart as $item)
              <div class="row g-0 border-2 border-bottom my-2">
                <div class="col-2 img-checkout">
                  <img src="{{ $item['image'] }}">
                  <span>{{ $item['quantity'] }}</span>
                </div>
                <span class="col-5 mb-2">{{ $item['name'] }}</span>
                <span class="col-5" price-cart-item>{{ number_format($item['price'], 0, ',', '.')}}<span class="price-checkout">₫</span></span>
              </div>
            @endforeach

            <div class="row my-2">
              <div class="col-9">
                <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
              </div>
              <button class="col-3 btn btn-primary">Áp dụng</button>
            </div>

            <div class="row py-3">
              <span class="col-7" >Tổng cộng:</span>
              <span class="col-5 fs-5 text-end toltal-checkout" >{{ number_format($toltalCart, 0, ',', '.') }}<span class="price-checkout">₫</span></span>
            </div>
            
            <div class="row justify-content-between">
              <span class="col-8 back-cart" btn-backcart><a href="{{ route('cart.product') }}">❮ Quay về giỏ hàng</a></span>
              <button class="col-3 btn btn-success" button-order>Đặt Hàng</button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <form action="{{ route('cart.checkoutfinal') }}" method="POST" 
    from-submit-checkout>
    @csrf
    <input hidden type="number" name="toltalPrice" value="{{ $toltalCart }}">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('client/js/script.js') }}"></script>
</body>
</html>