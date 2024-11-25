@extends('admin.layouts.default')
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
@section('content')

  <!-- form search -->
  <div class="row">
    <h2 class="col-8">Sản phẩm</h2>
    @include('admin.mixins.search', ['keyword' => $keyword])
  </div>
  <!--End form search -->
  <div class="card mb-3">
    <div class="card-header">Bộ lọc và Sắp xếp</div>
    <div class="card-body">
      <div class="row">
      <div class="col-9">
          @foreach ($filterStatus as $index => $item)
            <button
              class="btn btn-sm ml-1 btn-outline-success {{ $item['class'] }}"
              button-status="{{ $item['status'] }}"
            >{{ $item['name'] }}</button>
          @endforeach
        </div>
        @include('admin.mixins.sort')
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-right"><a class="btn btn-outline-success" 
          href="/admin/products/create"> + Thêm mới</a></div>

        <table class="table table-hover table-sm" checkbox-multim>
          @include('admin.mixins.form-change-multi', ['action' => '/admin/products/change-multi'])
          <thead>
            <tr>
              <th><input type="checkbox" name="checkall"></th>
              <th>STT</th>
              <th>Hình ảnh</th>
              <th class='col-3'>Tên sản phẩm</th>
              <th class='col-1' >Hình thức</th>
              <th>Thuê theo giờ</th>
              <th>Thuê theo ngày</th>
              <th>Vị trí</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $index => $item)
              <tr>
                <td>
                  <input type="checkbox" name="id" value= "{{ $item->Id_SP }}">
                </td>
                <td>{{ $index + 1 }}</td>
                <td>
                  <img src="{{ $item->Image }}" width="60px" height="auto">
                </td>
                <td>{{ $item->Name }}</td>
                <td>
                  @if($item->Buy_or_rent == 'buy') Cho mua
                  @elseif($item->Buy_or_rent == 'rent') Cho thuê
                  @else Cho phép mua và thuê
                  @endif
                </td>
                <td>{{ number_format($item->Price_Hour, 0, ',', '.') . ' VND' }}</td>
                <td>{{ number_format($item->Price_Day, 0, ',', '.') . ' VND' }}</td>
                <td>
                  <input class="text-center" type="number" style="width:50px" min="1" 
                    value="{{ $item->Position }}"
                    name="position">
                </td>
                <td>
                  @if($item->Status == "active")
                    <a class="badge badge-success"
                      data-id="{{ $item->Id_SP }}" data-status="{{ $item->Status }}"
                      button-change-status> Hoạt động</a>
                  @else 
                    <a class="badge badge-danger"
                      data-id="{{ $item->Id_SP }}" data-status="{{ $item->Status }}"
                      button-change-status> Dừng hoạt động</a>
                  @endif
                </td>
                <td>
                  <a class="btn btn-secondary btn-sm mr-1"
                    href="/admin/products/detail/{{ $item->Id_SP }}"><i class="bi bi-eye"></i></a>

                  <a class="btn btn-warning btn-sm mr-1"
                    href="/admin/products/edit/{{ $item->Id_SP }}"><i class="bi bi-pencil-square text-light"></i></a>

                  <button class="btn  btn-sm btn-danger"
                    button-delete data-id="{{ $item->Id_SP }}"><i class="bi bi-trash text-light"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
      
      </div>
    </div>
    </div>
  </div>

  <div class="row">
    <div class="col-10">@include('admin.mixins.pagination', ['pagination' => $pagination])</div>
    <div class="col-2">@include('admin.mixins.quantity')</div>
  </div>

  <!-- Form change-status -->
   <form
    form-change-status
    action=""
    method="POST"
    data-path="/admin/products/change-status">
    @csrf
    @method('PATCH')</form>

    <form
    form-delete-item
    action=""
    method="POST"
    data-path="/admin/products/delete">
    @csrf
    @method('DELETE')</form>

@endsection