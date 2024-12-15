@extends('client.layouts.default')

@section('content')
<div class="container mt-5">
    <!-- Alert thông báo thành công -->
    <div class="alert alert-success p-4 rounded shadow-sm">
        <h2 class="text-center">Đặt hàng thành công!</h2>
        <div class="row mt-4">
            <div class="col-md-6">
                <p><strong>Mã đơn hàng:</strong> <span class="text-uppercase">{{ $orderId }}</span></p>
                <p><strong>Số tiền đã đặt cọc:</strong> <span class="text-success">{{ number_format($amount, 0, ',', '.') }} VND</span></p>
            </div>
            <div class="col-md-6">
                <p><strong>Cảm ơn bạn đã mua hàng.</strong></p>
                <p>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất. Vui lòng kiểm tra email để biết thêm thông tin.</p>
            </div>
        </div>
    </div>

    <!-- Nút quay lại trang chủ -->
    <div class="text-center mt-4">
        <a href="{{ route('home.index') }}" class="btn btn-primary btn-lg">Quay lại trang chủ</a>
    </div>
</div>
@endsection
