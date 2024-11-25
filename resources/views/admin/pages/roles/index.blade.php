@extends('admin.layouts.default')

@section('content')
  <h2>Nhóm quyền</h2>
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-right"><a class="btn btn-outline-success" 
          href="/admin/roles/create"> + Thêm mới</a></div>

        <table class="table table-hover table-sm">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên quyền</th>
              <th>Mô tả quyền</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->Name }}</td>
                <td>{{ $item->Description }}</td>
                <td>
                  <a class="btn btn-warning btn-sm mr-1"
                    href="/admin/roles/edit/{{ $item->Id_role }}" >Sửa</a>
                  <button class="btn btn-danger btn-sm ml-1"
                    button-delete data-id="{{ $item->Id_role }}" >Xóa</button>
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
    form-delete-item
    action=""
    method="POST"
    data-path="/admin/roles/delete">
    @csrf
    @method('DELETE')</form>

@endsection