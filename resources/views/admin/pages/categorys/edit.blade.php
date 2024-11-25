@extends('admin.layouts.default')

@section('content')
  @include('admin.mixins.alert', ['type' => session('type'), 'message' => session('message'), 'time' => 3000])

  <h1 class="mb-4">Sửa danh mục</h1>

  <form action="/admin/categorys/edit/{{ $categorys[0]->Id_DM }}" id="form-create-product" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH') 

    <div class="form-group">
      <label for="title">Tiêu đề</label>
      <input 
        type="text"
        class="form-control"
        id="title"
        name="Name"
        value="{{ $categorys[0]->Name }}"
        required>
    </div>

    <div class="form-group">
      <button
        type="submit"
        class="btn btn-primary"
      >Cập nhật</button>
    </div>
  </form>
@endsection