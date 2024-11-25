@extends('client.layouts.default')

@section('content')
  <div class="container py-5">
    <p class="mt-3">Trang chủ/Giỏ hàng</p>
    <h3>Giỏ hàng</h3>
    <div class="row">

      <div class="col-8 border" id="cartQuantity">
        <!-- item products -->
        <div class="p-2 d-flex align-items-center border-bottom border-2">
          <input type="checkbox" class="form-check-input mx-2" name="">

          <img src="https://bizweb.dktcdn.net/thumb/compact/100/521/820/products/wohoxtouringdrybag6-1296x-0f6eb4af893443d4b233f19bb40c6c1e.jpg" style="width: 70px">
          
          <span class="col-4">Xe đạp đường dài</span>

          <input 
            type="text" style="width: 100px" class="text-end border-0 col-4 ms-5 text-danger fw-bold" 
            name="Price" 
            value="1000000">
          <span class="text-danger">₫</span>

          <div class="col-3 border quantity-cart ms-5" style="width: 101px">
            <button class="border-0 btn btn-light btn-sm" value="-" button-quantity>-</button>
            <input 
              type="text" style="width: 30px" class="col-3 text-center border-0" min="0"
              value="1">
            <button class="border-0 btn btn-light btn-sm" value="+" button-quantity>+</button>
          </div>
          
          <button class="border-0 btn ms-4 delete-cart"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="p-2 d-flex align-items-center border-bottom border-2">
          <input type="checkbox" class="form-check-input mx-2" name="">

          <img src="https://bizweb.dktcdn.net/thumb/compact/100/521/820/products/wohoxtouringdrybag6-1296x-0f6eb4af893443d4b233f19bb40c6c1e.jpg" style="width: 70px">
          
          <span class="col-4">Xe đạp đường dài</span>

          <input 
            type="text" style="width: 100px" class="text-end border-0 col-4 ms-5 text-danger fw-bold" 
            name="Price" 
            value="1000000">
          <span class="text-danger">₫</span>

          <div class="col-3 border quantity-cart ms-5" style="width: 101px">
            <button class="border-0 btn btn-light btn-sm" value="-" button-quantity>-</button>
            <input 
              type="text" style="width: 30px" class="col-3 text-center border-0" min="0"
              value="1">
            <button class="border-0 btn btn-light btn-sm" value="+" button-quantity>+</button>
          </div>
          
          <button class="border-0 btn ms-4 delete-cart"><i class="bi bi-x-lg"></i></button>
        </div>

        <!-- End item products -->
        
      </div>
      
      <div class="col-3 border bg-light text-dark p-3">
        <h4>Tạm tính:</h4>
        <div class="row">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-normal">Tổng cộng:</span>
            <div class="input-group" style="max-width: 150px">
              <input type="text" 
                    class="form-control text-danger bg-light fw-bold text-end border-0 p-0" 
                    value="8490000" 
                    name="toltal_price"
                    style="max-width: 200px" 
                    readonly>
              <span class="input-group-text text-danger border-0 bg-light ms-1 ps-0">đ</span>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <button type="button" class="btn btn-dark">Thanh toán</button>
        </div>
      </div>
      </div>
  </div>
  
  
  <form action="/cart/add" method="POST" id="add-to-cart-form">

    <input type="hidden" name="product_id" value="12345">
    <input type="hidden" name="quantity" value="1">
    
  </form>

@endsection