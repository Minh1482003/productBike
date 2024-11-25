<header class="header">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-3">
        <div class="inner-logo">
          <a href="admin/dashhboad">Admin</a>
        </div>
      </div>

      <div class="col-9">
        <div class="text-user text-right">
          <img src="{{ $User->Image }}">
          <p class="fw-bolder badge mr-3">{{ $User->Name }}</p>
          <a type="button" class="btn btn-danger btn-sm" href="{{ route('authen.logout') }}">Đăng xuất</a>
        </div>
      </div>

    </div>
  </div>
</header>