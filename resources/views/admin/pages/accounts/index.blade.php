@extends('admin.layouts.default')
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
@section('content')

  <!-- form search -->
  <div class="row">
    <h2 class="col-8">Tài khoản</h2>
  </div>
  <!--End form search -->
  <div class="card mb-3">
    <div class="card-header">Bộ lọc và Sắp xếp</div>
    <div class="card-body">
      <div class="row">
      <div class="col-9 mt-1">
          @foreach ($filterStatus as $index => $item)
            <button
              class="btn btn-sm ml-1 btn-outline-success {{ $item['class'] }}"
              button-status="{{ $item['status'] }}"
            >{{ $item['name'] }}</button>
          @endforeach
        </div>
        <div class="col-3 text-right">
          <a class="btn btn-outline-success" href="/admin/accounts/create"> + Thêm mới</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="col-8"></div>
        <table class="table table-hover table-sm">
          <thead>
            <tr>
              <th>STT</th>
              <th>Hình ảnh</th>
              <th>Tên người dùng</th>
              <th>Username</th>
              <th>Email</th>
              <th class="text-center">Quyền hạn</th>
              <th>Trạng thái</th>
              <th class="text-center">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($accounts as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  <img src="{{ $item->Image }}" width="50px" height="auto">
                </td>
                <td>{{ $item->Name }}</td>
                <td>{{ $item->Username }}</td>
                <td>{{ $item->Email }}</td>
                <td>
                <select class="form-select form-control mb-3" id-user="{{ $item->Id_KH }}" name="Provide_Permission">
                  @foreach ($roles as $role)
                    <option {{ $role->Id_role == $item->Id_role ? 'selected' : '' }}
                      value="{{ $role->Id_role }}">{{ $role->Name }}</option>
                  @endforeach
                </select>
                </td>
                <td class="text-center">
                  @if($item->Status == "active")
                    <a class="badge badge-success"
                      data-id="{{ $item->Id_KH }}" data-status="{{ $item->Status }}"
                      button-change-status>Hoạt động</a>
                  @else 
                    <a class="badge badge-secondary"
                      data-id="{{ $item->Id_KH }}" data-status="{{ $item->Status }}"
                      button-change-status>Đã khóa</a>
                  @endif
                </td>
                <td class="btn-change">
                  <a class="mr-2"
                    href="/admin/accounts/detail/{{ $item->Id_KH }}"><i class="bi bi-eye"></i></a>

                  <a class="mx-1"
                    href="/admin/accounts/edit/{{ $item->Id_KH }}"><i class="bi bi-pencil-square"></i></a>

                  <button class="btn"
                    button-delete data-id="{{ $item->Id_KH }}"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
      
      </div>
    </div>
    </div>
  </div>

  <form
  form-change-status
  action=""
  method="POST"
  data-path="/admin/accounts/change-status">
  @csrf
  @method('PATCH')</form>

  <form form-provide-role action="/admin/accounts/provide-role" method="POST">
    @csrf 
    @method('PATCH')
    <input type="hidden" name="id_user">
    <input type="hidden" name="id_role"> 
  </form>

  <form
  form-delete-item
  action=""
  method="POST"
  data-path="/admin/accounts/delete">
  @csrf
  @method('DELETE')</form>

@endsection