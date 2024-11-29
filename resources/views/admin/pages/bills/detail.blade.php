@extends('admin.layouts.default')
@include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])
@section('content')

<div class="card mb-3">
  <div class="card-header">
    <div class="my-2">
      <span class="fw-bold">Tên khách hàng:</span>
      <span class="ml-1">{{ $billDetails[0]->NameUser }}</span>
    </div>
    <div class="my-2">
      <span class="fw-bold">Mã hóa đơn:</span>
      <span class="ml-1">{{ $billDetails[0]->Id_HD }}</span>
    </div>
    <div class="my-2">
      <span class="fw-bold">Trạng thái đơn hàng:</span>
      <span class="ml-1">{{ $billDetails[0]->Status }}</span>
    </div>
    <div class="my-2">
      <span class="fw-bold">Ngày đăt hàng:</span>
      <span class="ml-1">{{ $billDetails[0]->Oder_date }}</span>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <table class="table table-hover table-sm" checkbox-multi>
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Thanh tiền</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($billDetails as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->Id_SP }}</td>
              <td>{{ $item->NameProduct }}</td>
              <td><img src="{{ $item->Image }}" style="width: 60px"></td>
              <td>{{ $item->Quantity }}</td>
              <td>{{ number_format($item->Price, 0, ',', '.') . ' VND' }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
      <div class="row">
        <span class="col-8 fw-bold">Tổng tiền:</span>
        <span class="col-3 text-end ml-5">{{ number_format($item->Total_price, 0, ',', '.') . ' VND' }}</span>
      </div>
    </div>
  </div>
  </div>
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