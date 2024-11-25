@extends('admin.layouts.default')

@section('content')
  <h2>Thêm mới quyền</h2>
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <form action="/admin/roles/edit/{{ $roles[0]->Id_role }}" id="form-create-product" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <label for="title">Tên quyền:</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        value="{{ $roles[0]->Name }}"
        required>
    </div>
    <div class="form-group">
      <label for="title">Mô tả quyền:</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Description"
        value="{{ $roles[0]->Description }}"
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
            <tr>
              <td><h5>Sản phẩm</h5></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="product:view" 
                {{ in_array('product:view', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="product:create"
                {{ in_array('product:create', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="product:edit"
                {{ in_array('product:edit', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="product:delete"
                {{ in_array('product:delete', $arrPermissions) ? 'checked' : '' }}></td>
            </tr>

            <tr>
              <td><h5>Danh mục</h5></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="category:view"
                {{ in_array('category:view', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="category:create"
                {{ in_array('category:create', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="category:edit"
                {{ in_array('category:edit', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="category:delete"
                {{ in_array('category:delete', $arrPermissions) ? 'checked' : '' }}></td>
            </tr>

            <tr>
              <td><h5>Tài khoản</h5></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="user:view"
                {{ in_array('user:view', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="user:create"
                {{ in_array('user:create', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="user:edit"
                {{ in_array('user:edit', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="user:delete"
                {{ in_array('user:delete', $arrPermissions) ? 'checked' : '' }}></td>
            </tr>

            <tr>
              <td><h5>Quyền hạn</h5></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="role:view"
                {{ in_array('role:view', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="role:create"
                {{ in_array('role:create', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="role:edit"
                {{ in_array('role:edit', $arrPermissions) ? 'checked' : '' }}></td>
              <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="role:delete"
                {{ in_array('role:delete', $arrPermissions) ? 'checked' : '' }}></td>
                <td><input class="form-check-input" type="checkbox" name="UpdatePermissions[]" value="role:provide"
                {{ in_array('role:provide', $arrPermissions) ? 'checked' : '' }}></td>
            </tr>
    
          </tbody>
        </table>

      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </form>

@endsection