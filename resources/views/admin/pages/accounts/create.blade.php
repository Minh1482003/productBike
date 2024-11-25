@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Thêm tài khoản</h1>

  <form action="/admin/accounts/create" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Tên người dùng:</label>
      <input 
        placeholder="Không được để trống tên"
        type="text"
        class="form-control"
        id="title"
        name="Name"
        required>
    </div>

    <div class="form-group">
      <label for="username">Username:</label>
      <input
        placeholder="Bắt buộc" 
        type="username"
        class="form-control"
        id="username"
        name="Username"
        required>
    </div>

    <div class="form-group">
      <label for="password">Mật khẩu:</label>
      <input
        placeholder="Bắt buộc" 
        type="password"
        class="form-control"
        id="password"
        name="Password_1"
        required>
    </div>

    <div class="form-group">
      <label for="password">Nhập lại mật khẩu:</label>
      <input
        placeholder="Bắt buộc" 
        type="password"
        class="form-control"
        id="password"
        name="Password_2"
        required>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input
        placeholder="Bắt buộc" 
        type="email"
        class="form-control"
        id="title"
        name="Email"
        required>
    </div>

    <div class="form-group">
      <label for="stock">Số điện thoại:</label>
      <input
        type="number"
        class="form-control"
        id="stock"
        name="SDT"
        value="0"
        min="0">
    </div>

    <div class="form-group">
      <label for="Address">Địa chỉ:</label>
      <input 
        type="text"
        class="form-control"
        id="Address"
        name="Address">
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
      <button
        type="submit"
        class="btn btn-primary"
      >Tạo mới</button>
    </div>
  </form>
@endsection