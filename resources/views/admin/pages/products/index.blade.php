@extends('admin.layouts.default')

@section('content')
  <!-- <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-6"></div>
      </div>
    </div>
  </div> -->

  <table class="table table-hover table-sm">
    <thead>
      <tr>
        <th><input type="checkbox" name="checkall"></th>
        <th>STT</th>
        <th>Hình ảnh</th>
        <th>Giá</th>
        <th>Vị trí</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
@endsection