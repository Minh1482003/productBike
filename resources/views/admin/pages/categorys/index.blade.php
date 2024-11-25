@extends('admin.layouts.default')

@section('content')
  <h2>Danh mục</h2>
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-right"><a class="btn btn-outline-success" 
          href="/admin/categorys/create"> + Thêm mới</a></div>

        <table class="table table-hover table-sm">
          <thead>
            <tr>
              <th><input type="checkbox" name="checkall"></th>
              <th>STT</th>
              <th>Tên danh mục</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categorys as $index => $item)
              <tr>
                <td>
                  <input type="checkbox" name="id" value= "{{ $item->Id_DM }}">
                </td>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->Name }}</td>

                <td>
                  <a class="btn btn-warning btn-sm mr-1"
                    href="/admin/categorys/edit/{{ $item->Id_DM }}"><i class="bi bi-pencil-square text-light"></i></a>

                  <button class="btn  btn-sm btn-danger"
                    button-delete data-id="{{ $item->Id_DM }}"><i class="bi bi-trash text-light"></i></button>
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
    data-path="/admin/categorys/delete">
    @csrf
    @method('DELETE')</form>

@endsection