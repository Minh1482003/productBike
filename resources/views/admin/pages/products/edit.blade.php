@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Chỉnh sửa sản phẩm</h1>

  <form action="/admin/products/edit/{{ $product->Id_SP }}" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH') 
    
    <div class="form-group">
      <label for="title">Tiêu đề</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        value="{{ $product->Name }}"
        required>
    </div>

    <div class="form-group">
      <label for="desc">Mô tả</label>
      <textarea
        class="form-control"
        id="desc"
        name="Description"
        rows="10"
        textarea-mce>{{ $product->Description }}</textarea>
    </div>

    @php
      $isBuy_rent = $product->Buy_or_rent;
    @endphp

    <div class="form-group">
      <label>Loại hình sản phẩm:</label>
      <div class="mb-3">
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="buy" value="buy" {{ $isBuy_rent == 'buy' ? 'checked' : '' }}>
          <label class="form-check-label" for="buy">Mua</label>
        </div>
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="rent" value="rent" {{ $isBuy_rent == 'rent' ? 'checked' : '' }}>
          <label class="form-check-label" for="rent">Thuê</label>
        </div>
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="both" value="both" {{ $isBuy_rent == 'both' ? 'checked' : '' }}>
          <label class="form-check-label" for="both">Cả bán và cho thuê</label>
        </div>
      </div>
    </div>
  
    <div class="form-group {{ $isBuy_rent == 'buy' || $isBuy_rent == 'both' ? '' : 'd-none' }}" inputPrice>
      <label for="price">Giá bán</label>  
      <input
        type="number"
        class="form-control"
        id="price"
        name="Price"
        value="{{ $product->Price }}"
        min="0">
    </div>
    <div class="form-group {{ $isBuy_rent == 'rent' || $isBuy_rent == 'both' ? '' : 'd-none' }}" inputPrice>
      <label for="price">Giá thuê 1 giờ</label>
      <input
        type="number"
        class="form-control"
        id="price"
        name="PriceHour"
        value="{{ $product->Price_hour }}"
        min="0">
    </div>
    <div class="form-group {{ $isBuy_rent== 'rent' || $isBuy_rent == 'both' ? '' : 'd-none' }}" inputPrice>
      <label for="price">Giá thuê 1 ngày</label>
      <input
        type="number"
        class="form-control"
        id="price"
        value="{{ $product->Price_day }}"
        value="0"
        min="0">
    </div>

    <div class="form-group">
      <label for="stock">Số lượng</label>
      <input
        type="number"
        class="form-control"
        id="stock"
        name="Quantity"
        value="{{ $product->Quantity }}"
        min="0">
    </div>

    <div 
      class="form-group"
      upload-image >
      <label for="thumbnail">Ảnh</label>
      <input
          type="file"
          class="form-control-file"
          id="thumbnail"
          name="image"
          accept="image/*"
          upload-image-input>
          
        <img
          src="{{ $product->Image }}"
          upload-image-preview
          class="image-preview">
    </div>

    <div class="form-group">
      <label for="stock">Vị trí</label>
      <input
        type="number"
        class="form-control"
        id="stock"
        name="Position"
        placeholder="Tự động tăng"
        min="1"
        value="{{ $product->Position }}"
        >
    </div>

    <div class="form-group form-check form-check-inline">
      <input
        type="radio"
        class="form-check-input"
        id="statusActive"
        name="Status"
        value="active"
        {{ $product->Status == 'active' ? 'checked' : '' }}
        >
      <label for="statusActive" class="form-check-label">Hoạt động</label>
    </div>

    <div class="form-group form-check form-check-inline">
      <input
        type="radio"
        class="form-check-input"
        id="statusInActive"
        name="Status"
        value="inactive"
        {{ $product->Status == 'inactive' ? 'checked' : '' }}
        >
      <label for="statusInActive" class="form-check-label">Dừng hoạt động</label>
    </div>

    <div class="form-group">
      <label for="stock">Danh mục:</label>
      <select class="form-select form-control mb-3" name="category">
        @foreach ($categorys as $item)
          <option 
            {{ $item->Id_DM == $product->Id_DM ? 'selected' : '' }}
            value="{{ $item->Id_DM }}">{{ $item->Name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn btn-primary"
      >Cập nhật</button>
    </div>
  </form>
@endsection