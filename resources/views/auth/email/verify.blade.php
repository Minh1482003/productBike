<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            background: #007bff;
            color: #fff;
            padding: 5px 0;
            border-radius: 5px 5px 0 0;
        }

        .container p {
            margin: 10px 0;
            font-size: 16px;
        }

 
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Bike Shop xác thực tài khoản:</h2>
        </div>
        <p>{!! $name !!}</p>
    </div>  
</body>
</html>
