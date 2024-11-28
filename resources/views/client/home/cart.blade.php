@extends('client.layouts.default')

@section('content')
  <div class="container py-5">
    <p class="mt-3">Trang chủ/Giỏ hàng</p>
    <h3>Giỏ hàng</h3>
    <div class="row">

      <div class="col-8 border">
        
        <!-- item products -->
        @foreach($productCarts as $item)
          <div class="p-2 d-flex align-items-center border-bottom border-2" div-product>
            <input hidden type="number" value="{{ $item->Price }}" price-origin>

            <input type="checkbox" class="form-check-input mx-2" name="checkCart">

            <input hidden type="number" value="{{ $item->Id_SP }}" name="id-product">

            <img src="{{ $item->Image }}" style="width: 100px" name="image-cart">
            
            <span class="col-4" name="name-cart">{{ $item->Name }}</span>
            
            <input 
              type="text" style="width: 100px" class="text-end border-0 col-4 ms-5 text-danger fw-bold" 
              disabled name="Price" 
              value="{{ $item->Price * $item->Quantity}}">
            <span class="text-danger">₫</span>

            <div class="col-3 border quantity-cart ms-5" style="width: 101px">
              <button class="border-0 btn btn-light btn-sm" value="-" button-quantity>-</button>
              <input 
                disabled
                type="text" style="width: 30px" class="col-3 text-center border-0" min="0"
                name="input-quantity"
                value="{{ $item->Quantity }}">
              <button class="border-0 btn btn-light btn-sm" value="+" button-quantity>+</button>
            </div>
            
            <button class="border-0 btn ms-4 delete-cart"
              button-delete  
              data-id="{{ $item->Id_SP }}"
              ><i class="bi bi-x-lg"></i></button>
            
          </div>
        @endforeach
        <!-- End item products -->
        
      </div>
      
      <div class="col-3 border bg-light text-dark p-3">
        <h4>Tạm tính:</h4>
        <div class="row">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fw-normal">Tổng cộng:</span>
            <div class="input-group" style="max-width: 150px">
              <input type="text" disabled
                    class="form-control text-danger bg-light fw-bold text-end border-0 p-0" 
                    value="0" 
                    name="toltal_price"
                    style="max-width: 200px" 
                    readonly>
              <span class="input-group-text text-danger border-0 bg-light ms-1 ps-0">đ</span>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <button type="button" class="btn btn-dark" btn-submit-cart>Thanh toán</button>
        </div>
      </div>
      </div>
  </div>
  
  <form
    form-delete-item
    action=""
    method="POST"
    data-path="/cart/delete">
    @csrf
    @method('DELETE')</form>
  
  <form action="/cart/checkout" method="POST" from-submit-cart>
    @csrf
    <input type="hidden" name="data">
    <input type="hidden" name="toltalCart">
  </form>

@endsection