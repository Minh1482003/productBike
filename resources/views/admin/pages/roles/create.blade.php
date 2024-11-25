@extends('admin.layouts.default')

@section('content')

  <h2>Thêm mới quyền</h2>
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <form action="/admin/roles/create" id="form-create-product" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Tên quyền:</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        required>
    </div>
    <div class="form-group">
      <label for="title">Mô tả quyền:</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Description"
        required>
    </div>

    <div class="card">
      <div class="card-header"><h4>Cho phép</h4></div>
      <div class="card-body">
  
        <table class="table">
          <thead class="card-header">
            <tr>
              <th class="col-2"></th>
              <th class="col-2">Xem</th>
              <th class="col-2">Tạo mới</th>
              <th class="col-2">Sửa</th>
              <th class="col-2">Xóa</th>
              <th class="col-3">Cấp quyền</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><h5>Sản phẩm</h5></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="product:view"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="product:create"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="product:edit"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="product:delete"></td>
            </tr>

            <tr>
              <td><h5>Danh mục</h5></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="category:view"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="category:create"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="category:edit"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="category:delete"></td>
            </tr>

            <tr>
              <td><h5>Tài khoản</h5></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="user:view"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="user:create"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="user:edit"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="user:delete"></td>
            </tr>

            <tr>
              <td><h5>Quyền hạn</h5></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="role:view"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="role:create"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="role:edit"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="role:delete"></td>
              <td><input class="form-check-input" type="checkbox" name="CreatePermissions[]" value="role:provide"></td>
            </tr>
    
          </tbody>
        </table>

      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Tạo mới</button>
    </div>
  </form>

@endsection