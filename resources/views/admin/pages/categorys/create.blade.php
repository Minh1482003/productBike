@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Thêm mới danh mục</h1>

  <form action="/admin/categorys/create" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="title">Tiêu đề</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        required>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn btn-primary"
      >Tạo mới</button>
    </div>
  </form>
@endsection