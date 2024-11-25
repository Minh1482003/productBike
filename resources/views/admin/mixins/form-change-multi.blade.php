<form action="{{ $action }}" method="POST" form-change-multi>@csrf @method('PATCH')
  <div class="d-flex align-items-start">
    <div class="form-group">
      <select name="type" class="form-control">
          <option class="bg-secondary text-white" disabled selected>-- Chọn hành động --</option>
          <option value="active">Hoạt động</option>
          <option value="inactive">Dừng hoạt động</option>
          <option value="change-position">Thay đổi vị trí</option>
          <option value="delete">Xóa sản phẩm</option>
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="ids" value="" class="form-control d-none">
    </div>
    <button type="submit" class="btn btn-primary">Áp dụng</button>
  </div>
</form>
