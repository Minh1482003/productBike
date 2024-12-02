@extends('client/layouts/default')

@section('content')
<div class="container">
    <div class="alert alert-success">
        <h2>Thanh toán thành công!</h2>
        <p>Mã đơn hàng: <strong>{{ $orderId }}</strong></p>
        <p>Số tiền thanh toán: <strong>{{ number_format($amount, 0, ',', '.') }} VND</strong></p>
        <p>Cảm ơn bạn đã mua hàng. Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
@endsection
