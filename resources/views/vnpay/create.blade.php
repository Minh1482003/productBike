<form action="{{ route('vnpay.create') }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Số tiền">
    <select name="bank_code">
        <option value="">Chọn ngân hàng</option>
        <option value="VNPAYQR">VNPAYQR</option>
        <option value="VNBANK">VNBANK</option>
        <!-- Các ngân hàng khác -->
    </select>
    <button type="submit">Thanh toán</button>
</form>