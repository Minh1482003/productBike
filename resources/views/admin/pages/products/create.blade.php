@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Thêm mới sản phẩm</h1>

  <form action="/admin/products/create" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Tiêu đề</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        required>
    </div>

    <div class="form-group">
      <label for="desc">Mô tả</label>
      <textarea
        class="form-control"
        id="desc"
        name="Description"
        rows="5"
        textarea-mce></textarea>
    </div>

    <div class="form-group">
      <label>Loại hình sản phẩm:</label>
      <div class="mb-3">
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="buy" value="buy">
          <label class="form-check-label" for="buy">Mua</label>
        </div>
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="rent" value="rent">
          <label class="form-check-label" for="rent">Thuê</label>
        </div>
        <div class="form-check">
          <input class="" type="radio" name="Buy_or_rent" id="both" value="both">
          <label class="form-check-label" for="both">Cả bán và cho thuê</label>
        </div>
      </div>
    </div>

    <div class="form-group" inputPrice>
      <label for="price">Giá bán</label>
      <input
        type="number"
        class="form-control"
        id="price"
        name="Price"
        value="0"
        min="0">
    </div>
    <div class="form-group d-none" inputPrice>
      <label for="price">Giá thuê 1 giờ</label>
      <input
        type="number"
        class="form-control"
        id="price"
        name="PriceHour"
        value="0"
        min="0">
    </div>
    <div class="form-group d-none" inputPrice>
      <label for="price">Giá thuê 1 ngày</label>
      <input
        type="number"
        class="form-control"
        id="price"
        name="PriceDay"
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
        value="0"
        min="0">
    </div>

    <div 
      class="form-group"
      upload-image>
      <label for="thumbnail">Ảnh</label>
      <input
          type="file"
          class="form-control-file"
          id="thumbnail"
          name="image"
          accept="image/*"
          upload-image-input>
        <img
          src=""
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
        min="1">
    </div>

    <div class="form-group form-check form-check-inline">
      <input
        type="radio"
        class="form-check-input"
        id="statusActive"
        name="Status"
        value="active"
        checked>
      <label for="statusActive" class="form-check-label">Hoạt động</label>
    </div>

    <div class="form-group form-check form-check-inline">
      <input
        type="radio"
        class="form-check-input"
        id="statusInActive"
        name="Status"
        value="inactive">
      <label for="statusInActive" class="form-check-label">Dừng hoạt động</label>
    </div>

    <div class="form-group">
      <label for="stock">Danh mục:</label>
      <select class="form-select form-control mb-3" name="category">
        @foreach ($categorys as $item)
          <option value="{{ $item->Id_DM }}"> {{ $item->Name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn btn-primary"
      >Tạo mới</button>
    </div>
  </form>
@endsection