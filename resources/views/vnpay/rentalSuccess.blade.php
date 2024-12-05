@extends('client.layouts.default')

@section('content')
<div class="container">
    <!-- Alert thông báo thành công -->
    <div class="alert alert-success mt-5">
        <h2 class="text-center">Đặt thuê xe thành công!</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mã đơn hàng:</strong> {{ $idBill }}</p>
                <p><strong>Số tiền thanh toán:</strong> {{ number_format($ToltalPriceRent, 0, ',', '.') }} VND</p>
                <p><strong>Thời gian bắt đầu thuê:</strong> {{ $Rental_start }}</p>
                <p><strong>Thời gian kết thúc thuê:</strong> {{ $Rental_expectedEnd }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Thời hạn thuê:</strong> {{ $Rental_term }}</p>
                <p>Vui lòng đến nhận xe ít nhất <strong>30 phút trước khi đến giờ bắt đầu thuê xe</strong> để làm thủ tục xác nhận danh tính.</p>
            </div>
        </div>
    </div>

    <!-- Nút quay lại trang chủ -->
    <div class="text-center">
        <a href="{{ route('home.index') }}" class="btn btn-primary btn-lg mt-4">Quay lại trang chủ</a>
    </div>
</div>
@endsection
