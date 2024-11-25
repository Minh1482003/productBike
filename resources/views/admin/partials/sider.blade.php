<div class="sider">
  <div class="inner-menu">
    <ul>
      <li>
        <a href="/admin/dashboard">Tổng quan</a>
      </li>
      @if(in_array('product:view', $Permissions))
      <li>
          <a href="/admin/products">Sản phẩm</a>
      </li>
      <li>
          <a href="/admin/products/rent">Sản phẩm thuê</a>
      </li>
      @endif

      @if(in_array('category:view', $Permissions))
      <li>
          <a href="/admin/categorys">Danh mục</a>
      </li>
      @endif

      @if(in_array('user:view', $Permissions))
      <li>
          <a href="/admin/accounts">Danh sách tài khoản</a>
      </li>
      @endif

      @if(in_array('role:view', $Permissions))
      <li>
          <a href="/admin/roles">Nhóm quyền</a>
      </li>
      @endif
  </div>
</div>