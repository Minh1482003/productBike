@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Chỉnh sửa tài khoản</h1>

  <form action="/admin/accounts/edit/{{ $users[0]->Id_KH }}" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    
    <div class="form-group">
      <label for="title">Tên người dùng:</label>
      <input 
        placeholder="Không được để trống tên"
        type="text"
        class="form-control"
        id="title"
        name="Name"
        value="{{ $users[0]->Name }}"
        required>
    </div>

    <div class="form-group">
      <label for="username">Username:</label>
      <input
        type="username"
        class="form-control"
        id="username"
        name="Username"
        value="{{ $users[0]->Username }}"
        >
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input
        type="email"
        class="form-control"
        id="title"
        name="Email"
        value="{{ $users[0]->Email }}"
        >
    </div>

    <div class="form-group">
      <label for="stock">Số điện thoại:</label>
      <input
        type="number"
        class="form-control"
        id="stock"
        name="SDT"
        value="{{ $users[0]->SDT }}"
        min="0">
    </div>

    <div class="form-group">
      <label for="Address">Địa chỉ:</label>
      <input 
        type="text"
        class="form-control"
        id="Address"
        name="Address"
        value="{{ $users[0]->Address }}">
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
          src="{{ $users[0]->Image }}"
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
        {{ $users[0]->Status == 'active' ? 'checked' : '' }}
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
        {{ $users[0]->Status == 'inactive' ? 'checked' : '' }}
        >
      <label for="statusInActive" class="form-check-label">Dừng hoạt động</label>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn btn-primary"
      >Cập nhật</button>
    </div>
  </form>
  
@endsection