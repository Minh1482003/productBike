<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nhập Mã OTP</title>
  <!-- Thêm Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .otp-container {
      max-width: 400px;
      margin: 50px auto;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .otp-input input {
      width: 50px;
      height: 50px;
      text-align: center;
      font-size: 18px;
      margin: 0 5px;
      border: 1px solid #ced4da;
      border-radius: 5px;
    }
    .otp-input input:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
  </style>
</head>
<body class="bg-light">
<div class="otp-container">
  <h3 class="text-center mb-3">Xác Thực đã được gửi tới OTP</h3>
  <p class="text-center text-muted">Nhập mã OTP gồm 6 chữ số được gửi đến Email, <b>{{ $Email }}</b> của bạn.</p>
  <form action="{{ route('sendOtpPost.Verify') }}" method="POST">
    @csrf

    <div class="otp-input d-flex justify-content-center mb-3">
      <input type="hidden" name="Email" value="{{ $Email }}">
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
      <input type="text" name="otp[]" maxlength="1" class="form-control" required>
    </div>
      <button type="submit" class="btn btn-primary w-100">Xác Thực</button>
  </form>
  <p class="text-center text-muted mt-3">Không nhận được mã? <a href="#" class="text-primary">Gửi lại mã</a>
  </p>
</div>

<script>

  const inputs = document.querySelectorAll('.otp-input input');
  inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });
    input.addEventListener('keydown', (e) => {
        if (e.key === "Backspace" && index > 0 && input.value === "") {
            inputs[index - 1].focus();
        }
    });
  });
</script>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
