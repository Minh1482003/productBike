<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <title>Document</title>
</head>
<body>
  
  @include('admin.partials.header')

  <div class="body">
    @include('admin.partials.sider')

    <div class="main">
      @yield('content')
    </div>
  </div> 


  <!-- Place the first <script> tag in your HTML's <head> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

  <!-- script -->
  <script src="{{ asset('admin/js/script.js') }}"></script>
  <script src="{{ asset('admin/js/tinymce.js') }}"></script>
  <!--End script -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>