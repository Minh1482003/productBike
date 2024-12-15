@extends('admin.layouts.default')
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
@section('content')

  <div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-right"><a class="btn btn-outline-success" 
          href="/admin/products/create"> + Thêm mới</a></div>

        <table class="table table-hover table-sm" checkbox-multi>
          <thead>
            <tr>
              <th><input type="checkbox" name="checkall"></th>
              <th>STT</th>
              <th>Mã hóa đơn</th>
              <th class="col-2">Tên khách hàng</th>
              <th class="col-2">Ngày đặt hàng</th>
              <th>Loại hóa đơn</th>
              <th>Trạng thái</th>
              <th>Tổng tiền(VND)</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bills as $index => $item)
              <tr>
                <td>
                  <input type="checkbox" name="id" value= "{{ $item->Id_HD }}">
                </td>
                <td class="fw-bold">{{ $index + 1 }}</td>
                <td>{{ $item->Id_HD }}</td>
                <td>{{ $item->Name }}</td>
                <td>{{ $item->Oder_date }}</td>
                <td class="fw-bold">
                  @if($item->Type_bill == 'buy') Mua xe
                  @elseif($item->Type_bill == 'rent') Thuê xe
                  @else Cho phép mua và thuê
                  @endif
                </td>
                <td>{{ $item->Status }}</td>
                <td>{{ number_format($item->Total_price, 0, ',', '.') }}</td>
          
                <td class="btn-change">
                  <a class="mx-2"
                    href="/admin/bills/detail/{{ $item->Id_HD }}"><i class="bi bi-eye"></i></a>

                  <a class="mx-2"
                    href="/admin/bills/edit/{{ $item->Id_HD }}"><i class="bi bi-pencil-square"></i></a>

                  <button class="btn"
                    button-delete data-id="{{ $item->Id_HD }}"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
      </div>
    </div>
    </div>
  </div>

  <!-- form search -->
  
  <!--End form search -->
  <div class="row">
    <div class="col-10">@include('admin.mixins.pagination', ['pagination' => $pagination])</div>
    <div class="col-2">@include('admin.mixins.quantity')</div>
  </div>

  <!-- Form change-status -->
   <form
    form-change-status
    action=""
    method="POST"
    data-path="/admin/bills/change-status">
    @csrf
    @method('PATCH')</form>

    <form
    form-delete-item
    action=""
    method="POST"
    data-path="/admin/bills/delete">
    @csrf
    @method('DELETE')</form>

@endsection